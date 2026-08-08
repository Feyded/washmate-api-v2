
# Guidelines for Code Structure, Responsibilities and Flow

## Routes

Follow RESTful API principles.

Rules:
- Use route model binding whenever possible.
- Keep route definitions focused on routing concerns only.
- Use API Resource routes whenever possible.
- Route names use dot notation.
- Group routes by domain.
- Use auth:sanctum for protected routes.

Example:

```php
Route::apiResource('users', UserController::class);

Route::middleware('auth:sanctum')->group(function () {
});
```

## Controllers

Controllers must remain thin and should only orchestrate the request flow.

Responsibilities:

- Receive the request.
- Receive validated data from Form Requests.
- Perform authorization when appropriate.
- Call the appropriate Service when business logic requires it.
- Return the appropriate API Resource or HTTP response.

Do not:

- Validate request data directly in controllers.
- Implement business logic in controllers.
- Perform complex database operations directly in controllers.
- Duplicate logic that belongs in a Service.

Ex.

```php
public function update(UpdateCompanyRequest $request, Company $company)
	{
		$company->update($request->validated());

		return response()->json([
			'message' => 'Company updated successfully.',
			'data' => $company,
		]);
	}
```

## Form Requests

Use Form Requests for endpoints that accept user input requiring validation,
authorization, or non-trivial validation rules.

Prefer Form Requests over inline validation in controllers.

Do not create a Form Request solely to satisfy an arbitrary field-count rule.

Ex.

```php
<?php

namespace App\Http\Requests\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $company = $this->route('company');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies', 'name')->ignore($company),
            ],
            'acronym' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies', 'acronym')->ignore($company),
            ],
            'status' => [
                'required',
                Rule::in(['Active', 'Inactive'])
            ],
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a valid string.',
            'name.max' => 'The company name may not be greater than 255 characters.',
            'name.unique' => 'A company with this name already exists.',

            'acronym.required' => 'The company acronym is required.',
            'acronym.string' => 'The company acronym must be a valid string.',
            'acronym.max' => 'The company acronym may not be greater than 50 characters.',
            'acronym.unique' => 'A company with this acronym already exists.',

            'status.required' => 'The company status is required.',
            'status.in' => 'The company status must be either Active or Inactive.',

            'latitude.numeric' => 'The latitude must be a valid number.',
            'latitude.between' => 'The latitude must be between -90 and 90.',

            'longitude.numeric' => 'The longitude must be a valid number.',
            'longitude.between' => 'The longitude must be between -180 and 180.',
        ];
    }
}
```

Do not place business logic inside controllers and use route binding always.



## Services

Services contain business/application logic that is complex, reusable,
transactional, or should not live in a Controller or Model.

Use a Service when:

- An operation contains multiple business rules.
- An operation touches multiple models.
- A transaction is required.
- Logic is reused by multiple entry points.
- The operation represents a meaningful business action.
- Keeping the logic in the Controller would make it difficult to maintain.

Do not create a Service merely to wrap a simple Eloquent operation.

Service methods should use action-based names such as:

- create()
- update()
- delete()
- approve()
- reject()
- assign()
- calculate()
- generate()
- import()

Ex.

```php
namespace App\Services;

use App\Models\Overtime;
use Illuminate\Support\Facades\DB;
use Exception;

class OvertimeService
{
    public function create(int $userId, array $data): Overtime
    {
        $hours = $data['hours'];

        if ($hours < 1) {
            throw new Exception('Overtime must be at least 1 hour.');
        }

        if ($hours > 4) {
            throw new Exception('Overtime cannot exceed 4 hours.');
        }

        $exists = Overtime::where('user_id', $userId)
            ->whereDate('date', $data['date'])
            ->exists();

        if ($exists) {
            throw new Exception(
                'An overtime request already exists for this date.'
            );
        }

        return DB::transaction(function () use ($userId, $data) {
            return Overtime::create([
                'user_id' => $userId,
                'date' => $data['date'],
                'hours' => $data['hours'],
                'reason' => $data['reason'],
                'status' => 'Pending',
            ]);
        });
    }
}
```

Use singular names for services.



## Resources

## API Resources

Use API Resources when returning models or structured data from API endpoints,
especially for public APIs and responses that are consumed by frontend or
external clients.

Resources must explicitly define the fields exposed by the API.

Do not return Eloquent models directly when doing so could expose internal,
sensitive, or implementation-specific fields.

Use different Resources when different consumers require different response
structures.

Ex.

```php
<?php

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            "descriptors" => $this->descriptors,
            "user" => UserResource::make($this->whenLoaded('user'))
        ];
    }
}

```



## Policies

Use Policies for authorization decisions involving models or resources.

Authentication should be handled by Laravel Sanctum and route middleware.

Use Policies when access depends on:

- The authenticated user's identity.
- Ownership of a resource.
- User roles or permissions.
- The state of the resource.
- Relationships between the user and resource.

Do not use Policies merely because a route requires authentication.

Use `auth:sanctum` for authentication and Policies for authorization.
```php
<?php

namespace App\Policies\Employee;

use App\Models\EmployeeOvertime;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OvertimePolicy
{
    public function update(User $user, EmployeeOvertime $overtime)
    {
        return $user->id === $overtime->user_id
            ? Response::allow()
            : Response::deny('You do not own this overtime record.');
    }
}

```
## Repositories

Do not introduce Repository classes by default.

Use Eloquent models and query scopes for normal database operations.

Introduce a Repository only when there is a clear architectural requirement,
such as:

- Multiple data sources.
- Complex persistence abstraction.
- A repository is already established by the existing project pattern.

Do not create repositories merely to wrap Eloquent methods.

## Models

Always cast when the data type is boolean and add the relationship

Ex.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'balance',
        'used',
        'earned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
}


```

## Migration

Rules

- Use plural snake_case.
- Use modern Laravel conventions
- Use idiomatic Laravel

Ex.

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overtime_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date');

            $table->decimal('hours', 4, 2);

            $table->text('reason');

            $table->string('status')
                ->default('pending');

            $table->timestamp('approved_at')
                ->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overtime_requests');
    }
};
```
## API Responses

Use a consistent JSON response structure.

Successful single-resource response:
```json
{
    "data": {...}
}
```

Successful collection response:
```json
{
    "data": [...]
}
```

Successful operation with a message:

```json
{
    "message": "Company updated successfully.",
    "data": {...}
}
```
