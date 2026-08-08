# Architecture Standards

## Architecture Style

Use a **hybrid feature-based architecture**.

Follow Laravel's standard directory structure, but group related files by feature/domain where appropriate.

Do **not** use a separate `app/Features` directory or full Domain-Driven Design architecture.

Example:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── Organization/
│   │   │   ├── Employee/
│   │   │   └── Leave/
│   │   ├── Employee/
│   │   └── ...
│   │
│   ├── Requests/
│   │   ├── Admin/
│   │   │   ├── Organization/
│   │   │   ├── Employee/
│   │   │   └── Leave/
│   │   └── ...
│   │
│   └── Resources/
│       ├── Admin/
│       ├── Employee/
│       └── ...
│
├── Models/
├── Policies/
├── Services/
└── ...
```

## Feature Organization

Group related Controllers, Requests, Resources, and Services by feature.

Example:

```text
Controllers/Leave/
Requests/Leave/
Resources/Leave/
Services/Leave/
```

Keep Models in `app/Models` and Policies in `app/Policies` unless the existing project uses another convention.

## Responsibilities

* **Routes** → routing and middleware.
* **Controllers** → request orchestration; keep thin.
* **Form Requests** → validation and request authorization.
* **Policies** → authorization.
* **Services** → business logic.
* **Models** → data, relationships, and Eloquent behavior.
* **Resources** → API response transformation.

## Rules

* Use only the layers that are necessary.
* Do not create unnecessary Services, Repositories, DTOs, Interfaces, or other abstractions.
* Follow existing project patterns before creating new structures.
* Keep feature-specific logic within its feature.
* Do not duplicate business logic.
* Do not refactor unrelated code.
* Prefer simple, readable Laravel code over over-engineering.

## Request Flow

Follow this architecture for API endpoints:

API Route
↓
Controller
↓
Form Request
↓
Policy (when authorization is required)
↓
Service (when business logic is complex, reusabl    e, or should not live in the controller)
↓
Model / Repository / Database
↓
Controller
↓
API Resource (when the endpoint returns an API representation)
↓
Response
