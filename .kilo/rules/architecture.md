# Laravel API Development Standards

## Project Overview

This project is built using:

- Laravel 10.10
- PHP 8.1+
- Laravel Sanctum (Authentication)
- Spatie Laravel Permission (Roles & Permissions)
- Laravel Socialite (OAuth Authentication)
- PhpSpreadsheet (Excel Exports)
- DomPDF (PDF Generation)
- MySQL Database

The goal is to maintain a clean, scalable, secure, and production-ready
API architecture that is easy to maintain and extend.

All generated code should follow existing project patterns before
introducing new implementations.

---

# Architecture Rules

## General Principles

- Follow SOLID principles.
- Follow DRY (Don't Repeat Yourself).
- Follow KISS (Keep It Simple).
- Prefer readability over clever code.
- Prefer maintainability over premature optimization.
- Avoid unnecessary abstractions.
- Production-ready code only.
- Use a hybrid architecture with feature-based organization.
- Organize code by domain/feature before technical layer.


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

Controllers must remain thin

Rules:

- Receive requests
- Validate requests
- Call services
- Return API responses

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

## Form Request

Always use a Form Request for validation when request body containes three or more fields.

Rules:

- Validate only the request
- Return human readable messages on error

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

Handles all the business logic and return the data to controller
Service methods should use action-based naming

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

Always use resource especially when the api is public to hide essential data.

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

Use policy especially when the route is only for authenticated user

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

## AI Code Generation Rules

- Follow Laravel 10 conventions.
- Use Form Requests.
- Use API Resources.
- Use Services.
- Use Policies.
- Use Dependency Injection.
- Use Transactions where needed.
- Generate production-ready code only.
