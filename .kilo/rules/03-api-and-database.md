# Guidelines for Database and API Response 

Do not expose internal exception messages in production responses.

Use appropriate HTTP status codes:

- 200 for successful retrieval/update.
- 201 for successful creation.
- 204 for successful deletion when no response body is required.
- 401 for unauthenticated requests.
- 403 for unauthorized requests.
- 404 for resources that do not exist.
- 422 for validation failures.

## Database and Eloquent

- Prefer Eloquent over raw SQL for normal CRUD operations.
- Use query scopes for reusable query constraints.
- Use eager loading to prevent N+1 queries.
- Do not access relationships repeatedly inside loops when eager loading is possible.
- Use `select()` when retrieving large datasets and only a subset of columns is required.
- Use pagination for potentially large collections.
- Use database transactions for operations that modify multiple related records.
- Do not place database queries in API Resources.
- Avoid unnecessary queries inside loops.


