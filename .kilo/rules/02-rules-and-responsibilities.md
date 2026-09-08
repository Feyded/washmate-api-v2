# Rules and Responsibilities

## Migration

- Specify the table in constrained() only when Laravel cannot infer it from the foreign key name.

## Routes

- Follow RESTful API principles.
- Use route model binding whenever possible.
- Use API Resource routes whenever possible.
- Route names use dot notation.
- Do not expose `destroy` routes, as resource deletion is not supported.

## Controllers

- Controllers must remain thin and should only orchestrate the request flow.
- Receive validated data from Form Requests.
- Use laravel standard request()->user() to retrieve the currently authenticated user.
- Call the appropriate Service when business logic requires it.
- Do not implement a `destroy` method.
- Must return a consistent API response containing message, data, and an explicitly defined HTTP status code using Symfony Response constants.

## Form Requests

- Form Requests are responsible only for handling and validating incoming HTTP request data.
- Do not put business logic, database operations, data persistence, calculations, or transformations unrelated to validation in Form Requests.
- Do not call Services, Repositories, Models, or external APIs from Form Requests.
- Controllers or Services should handle business logic after the request has been validated.
- Use Rule import from validation/rule;
- Use descriptive FormRequest class names based on the action being validated, such as `StoreUserRequest` and `UpdateUserRequest`.
- Keep Form Requests focused and simple.

## Services

- Services contain business/application logic that is complex, reusable, transactional, or does not belong in a Controller or Model.
- Must throw appropriate exceptions when an operation fails and must not return HTTP or error responses.
- Keep Controllers thin; move complex business logic into Services.
- Service methods must use descriptive camelCase names based on what the method actually does.
- Avoid vague method names such as `handle()`, `process()`, `execute()`, or `run()` unless their meaning is clear from the context.
- A Service should focus on a specific business/domain responsibility.
- Should be independent of HTTP/request-specific concerns.
