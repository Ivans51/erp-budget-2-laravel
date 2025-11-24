# Domain-Driven Design Guidelines

## Overview

This project follows Domain-Driven Design (DDD) principles with a clear separation between HTTP/Presentation layer and Domain layer.

## Project Structure

### Domain Layer (`app/Domain/`)
Contains business logic organized by business domains:

```
app/Domain/
├── Finance/           # Financial business domain
│   ├── Models/        # Domain models
│   ├── Actions/       # Business actions/use cases
│   ├── DataTransferObjects/ # DTOs
│   └── Enums/         # Domain enums
└── Org/               # Organization business domain
    ├── Models/        # Domain models (e.g., User.php)
    ├── Actions/       # Business actions/use cases
    ├── DataTransferObjects/ # DTOs
    └── Enums/         # Domain enums
```

### HTTP Layer (`app/Http/`)
Contains HTTP-specific concerns:

```
app/Http/
├── Controllers/       # HTTP controllers
│   └── V1/           # API versioning
│       └── Auth/     # Authentication controllers
├── Resources/         # JSON response formatters
│   └── V1/           # Versioned resources
├── Middleware/        # HTTP middleware
└── Requests/          # HTTP request validation
```

## Guidelines

### 1. Domain Layer Separation
- **Models**: Place only domain models in `Domain/DomainName/Models/`
- **Business Logic**: Keep domain business rules in `Domain/DomainName/Actions/`
- **Data Transfer**: Use DTOs for data transformation between layers
- **Enums**: Define domain-specific enumerations in `Domain/DomainName/Enums/`

### 2. HTTP Layer Concerns
- **Controllers**: Handle HTTP concerns only, delegate business logic to domain layer
- **Resources**: Format domain data for JSON responses
- **Validation**: Use Laravel form requests for HTTP validation
- **Middleware**: Handle cross-cutting HTTP concerns
- **Response Handling**: Always use `Response::success()` for successful responses and `Response::error()` for errors. Never use `response()->json()` directly.

### 3. Layer Interaction
- **From HTTP to Domain**: Controllers should call domain actions/services
- **Domain Independence**: Domain layer should not depend on HTTP layer
- **Data Flow**: HTTP → Controller → Domain Action → Domain Model → Resource → JSON

### 4. Import Guidelines
- **HTTP Layer imports**: Use `use App\Http\Resources\V1\UserResource;`
- **Domain Layer imports**: Use `use App\Domain\Org\Models\User;`
- **No circular dependencies**: HTTP layer can import domain, but not vice versa

### 5. API Versioning
- Controllers: `app/Http/Controllers/V1/`, `app/Http/Controllers/V2/`, etc.
- Resources: `app/Http/Resources/V1/`, `app/Http/Resources/V2/`, etc.
- Routes: `/api/v1/`, `/api/v2/`, etc.

## Example: Proper Domain-Driven Architecture

```php
// HTTP Controller (app/Http/Controllers/V1/Auth/LoginController.php)
namespace App\Http\Controllers\V1\Auth;

use App\Http\Resources\V1\UserResource;     // HTTP layer
use App\Domain\Org\Models\User;             // Domain layer
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        // HTTP validation
        $request->validate([...]);
        
        // Domain interaction
        $user = User::where('email', $request->email)->first();
        
        // HTTP response formatting using custom Response macros
        return Response::success([
            'user' => new UserResource($user)
        ], 'Login successful');
    }
}
```

## Benefits
- **Maintainability**: Clear separation of concerns
- **Testability**: Domain logic can be tested independently
- **Scalability**: Easy to add new domains or versions
- **Flexibility**: HTTP layer can change without affecting business logic
