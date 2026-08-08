# Architecture

The project uses a **Hybrid Feature-Based Architecture**.

## Rules

* Organize code by **feature/functionality**.
* Do **not** use Domain-Driven Design (DDD).
* Do not introduce `Domain`, `Entities`, `Aggregates`, `ValueObjects`, `Repositories`, or `DomainServices`.
* Follow Laravel conventions where appropriate.
* Keep related functionality grouped by feature.

## Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       └── Organization/
│   │           ├── CompanyController.php
│   │           ├── DepartmentController.php
│   │           └── DepartmentPositionController.php
│   │
│   ├── Requests/
│   │   └── Admin/
│   │       └── Organization/
│   │
│   └── Resources/
│       └── Admin/
│           └── Organization/
│
├── Models/
│   ├── Company.php
│   ├── Department.php
│   └── DepartmentPosition.php
│
├── Policies/
│   ├── CompanyPolicy.php
│   ├── DepartmentPolicy.php
│   └── DepartmentPositionPolicy.php
│
└── Services/
    └── Admin/
        └── Organization/
            ├── CompanyService.php
            ├── DepartmentService.php
            └── DepartmentPositionService.php
```

## Laravel Locations

* **Models** → `app/Models`
* **Policies** → `app/Policies`
* **Controllers** → `app/Http/Controllers/{Feature}`
* **Requests** → `app/Http/Requests/{Feature}`
* **Resources** → `app/Http/Resources/{Feature}`
* **Services** → `app/Services/{Feature}`

## Policies

Policies stay in Laravel's standard

## Important

The project is **Hybrid Feature-Based**, not DDD.

When adding new code, follow the existing feature structure and Laravel conventions. Do not introduce unnecessary architectural layers or abstractions.
