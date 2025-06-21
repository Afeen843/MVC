# PHP MVC Framework

A lightweight, modern PHP MVC framework with clear separation of concerns, built-in routing, database abstraction, and middleware support.

## ✅ Features

- **MVC Architecture** – Clear separation of concerns (Models, Views, Controllers)
- **Composer Autoloading** – PSR-4 compliant class autoloading
- **Dynamic Router** – Supports RESTful routes, route parameters, and middleware
- **Database Layer** – Singleton PDO connection + fluent Query Builder
- **Templating Engine** – Dynamic views with reusable components
- **Middleware Support** – Pre/post request processing (e.g., auth, CSRF)
- **Environment Config** – Secure .env management for credentials
- **Session & Request Handling** – Built-in session management and HTTP request/response utilities

## 🚀 Quick Start

### Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your database
4. Start the development server: `php -S localhost:8000 -t public`

### Project Structure

```
mvc/
├── public/          # Web root directory
│   ├── index.php    # Entry point
│   └── assets/      # CSS, JS, images
├── src/
│   ├── Bootstrap/   # Core framework classes
│   ├── Controllers/ # Application controllers
│   ├── Models/      # Database models
│   ├── Middleware/  # Request middleware
│   └── Views/       # Template files
├── vendor/          # Composer dependencies
└── .env            # Environment configuration
```

## 📖 Documentation

### 1. Routing

The framework provides a powerful routing system with support for GET/POST methods, route parameters, and middleware.

#### Basic Routes

```php
// Simple closure route
$router->get('/', function() {
    View::render('home', ['title' => 'Welcome']);
});

// Controller route
$router->get('/users', [UserController::class, 'index']);

// POST route
$router->post('/users', [UserController::class, 'store']);
```

#### Route Parameters

```php
// Dynamic route with parameters
$router->get('/user/{id}', [UserController::class, 'show']);

// Multiple parameters
$router->get('/posts/{category}/{id}', [PostController::class, 'show']);
```

#### Route with Middleware

```php
// Single middleware
$router->get('/profile', [UserController::class, 'profile'], 'auth');

// Multiple middleware
$router->get('/admin', [AdminController::class, 'dashboard'], ['auth', 'admin']);
```

#### Complete Routing Example

```php
// In public/index.php
$router = new Router();

// Register middleware
$router->registerMiddleware([
    'auth' => AuthMiddleware::class,
    'admin' => AdminMiddleware::class,
    'csrf' => CsrfMiddleware::class,
]);

// Define routes
$router->get('/', function() {
    View::render('home', ['title' => 'Home']);
});

$router->get('/users', [UserController::class, 'index']);
$router->get('/user/{id}', [UserController::class, 'show'], 'auth');
$router->post('/user', [UserController::class, 'store'], ['auth', 'csrf']);
$router->put('/user/{id}', [UserController::class, 'update'], 'auth');
$router->delete('/user/{id}', [UserController::class, 'delete'], 'auth');

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
```

### 2. Query Builder

The framework includes a fluent Query Builder for easy database operations.

#### Basic Queries

```php
use App\Models\QueryBuilder;

// Select all records
$users = QueryBuilder::query()
    ->table('users')
    ->get();

// Select specific columns
$users = QueryBuilder::query()
    ->table('users')
    ->select(['id', 'name', 'email'])
    ->get();

// Get first record
$user = QueryBuilder::query()
    ->table('users')
    ->where('id', '=', 1)
    ->first();
```

#### Where Clauses

```php
// Simple where
$users = QueryBuilder::query()
    ->table('users')
    ->where('status', '=', 'active')
    ->get();

// Multiple where conditions
$users = QueryBuilder::query()
    ->table('users')
    ->where('age', '>', 18)
    ->where('status', '=', 'active')
    ->get();

// OR conditions
$users = QueryBuilder::query()
    ->table('users')
    ->where('role', '=', 'admin')
    ->whereOR('role', '=', 'moderator')
    ->get();
```

#### Ordering and Limiting

```php
// Order by
$users = QueryBuilder::query()
    ->table('users')
    ->orderBy('created_at', 'DESC')
    ->get();

// Limit and offset
$users = QueryBuilder::query()
    ->table('users')
    ->limit(10)
    ->offset(20)
    ->get();

// Combined
$users = QueryBuilder::query()
    ->table('users')
    ->where('status', '=', 'active')
    ->orderBy('name', 'ASC')
    ->limit(5)
    ->get();
```

#### Insert, Update, Delete

```php
// Insert
$userId = QueryBuilder::query()
    ->table('users')
    ->insert([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => password_hash('password', PASSWORD_DEFAULT)
    ]);

// Update
$affected = QueryBuilder::query()
    ->table('users')
    ->where('id', '=', 1)
    ->update([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com'
    ]);

// Delete
$deleted = QueryBuilder::query()
    ->table('users')
    ->where('id', '=', 1)
    ->delete();
```

#### Complete Query Example

```php
class UserModel extends BaseModel
{
    public function getActiveUsers($limit = 10)
    {
        return QueryBuilder::query()
            ->table('users')
            ->select(['id', 'name', 'email', 'created_at'])
            ->where('status', '=', 'active')
            ->where('email_verified', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get();
    }

    public function findUserById($id)
    {
        return QueryBuilder::query()
            ->table('users')
            ->where('id', '=', $id)
            ->first();
    }

    public function createUser($data)
    {
        return QueryBuilder::query()
            ->table('users')
            ->insert($data);
    }
}
```

### 3. Middleware

Middleware allows you to filter HTTP requests entering your application.

#### Creating Middleware

```php
// src/Middleware/AuthMiddleware.php
namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login or throw exception
            header('Location: /login');
            exit();
        }
        
        return $next($request);
    }
}
```

#### Admin Middleware Example

```php
// src/Middleware/AdminMiddleware.php
namespace App\Middleware;

class AdminMiddleware
{
    public function handle($request, \Closure $next)
    {
        if (!isset($_SESSION['user_id'])) {
            throw new \Exception('Unauthorized');
        }

        // Check if user is admin
        $user = QueryBuilder::query()
            ->table('users')
            ->where('id', '=', $_SESSION['user_id'])
            ->first();

        if ($user->role !== 'admin') {
            throw new \Exception('Forbidden');
        }

        return $next($request);
    }
}
```

#### CSRF Middleware Example

```php
// src/Middleware/CsrfMiddleware.php
namespace App\Middleware;

class CsrfMiddleware
{
    public function handle($request, \Closure $next)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            $sessionToken = $_SESSION['csrf_token'] ?? '';
            
            if (!hash_equals($sessionToken, $token)) {
                throw new \Exception('CSRF token mismatch');
            }
        }

        return $next($request);
    }
}
```

#### Registering Middleware

```php
// In public/index.php
$router->registerMiddleware([
    'auth' => AuthMiddleware::class,
    'admin' => AdminMiddleware::class,
    'csrf' => CsrfMiddleware::class,
    'throttle' => ThrottleMiddleware::class,
]);
```

### 4. Controllers

Controllers handle the application logic and coordinate between models and views.

#### Basic Controller

```php
// src/Controllers/UserController.php
namespace App\Controllers;

use App\Bootstrap\View;
use App\Models\QueryBuilder;

class UserController extends BaseController
{
    public function index()
    {
        $users = QueryBuilder::query()
            ->table('users')
            ->get();
            
        View::render('users/index', [
            'users' => $users,
            'title' => 'Users'
        ]);
    }

    public function show($id)
    {
        $user = QueryBuilder::query()
            ->table('users')
            ->where('id', '=', $id)
            ->first();
            
        if (!$user) {
            View::render('not_found');
            return;
        }
        
        View::render('users/show', [
            'user' => $user,
            'title' => $user->name
        ]);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => password_hash($this->request->input('password'), PASSWORD_DEFAULT)
        ];

        $userId = QueryBuilder::query()
            ->table('users')
            ->insert($data);

        $this->session->set('message', 'User created successfully');
        header('Location: /users');
    }
}
```

### 5. Views and Templates

The framework includes a simple templating system with layout support.

#### Basic View

```php
<!-- view/home.php -->
<?php include 'layout/header.php'; ?>

<div class="container">
    <h1><?= $title ?></h1>
    <p>Welcome to our MVC framework!</p>
</div>

<?php include 'layout/footer.php'; ?>
```

#### Layout Components

```php
<!-- view/layout/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'MVC Framework' ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <main class="container mt-4">
```

```php
<!-- view/layout/footer.php -->
    </main>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

#### Rendering Views

```php
// In controllers
View::render('home', ['title' => 'Welcome']);
View::render('users/index', ['users' => $users]);
View::render('not_found'); // For 404 pages
```

### 6. Session Management

```php
// In controllers
$this->session->set('user_id', $user->id);
$this->session->set('message', 'Login successful');

$userId = $this->session->get('user_id');
$message = $this->session->get('message');

$this->session->remove('message');
$this->session->destroy();
```

### 7. Request Handling

```php
// In controllers
$name = $this->request->input('name');
$email = $this->request->input('email');
$file = $this->request->file('avatar');

// Get all input
$data = $this->request->all();

// Check if request is POST
if ($this->request->isPost()) {
    // Handle POST request
}
```

### 8. Environment Configuration

Create a `.env` file in your project root:

```env
DB_DSN=mysql:host=localhost;dbname=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
APP_ENV=development
APP_DEBUG=true
```

## 🔧 Configuration

### Database Setup

1. Create your database
2. Update `.env` file with database credentials
3. The framework will automatically connect using PDO

### Apache Configuration

For production, configure your web server to point to the `public/` directory:

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/mvc/public
    ServerName yourdomain.com
    
    <Directory /var/www/mvc/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 📝 Examples

### Complete User Management System

```php
// Routes
$router->get('/users', [UserController::class, 'index']);
$router->get('/users/create', [UserController::class, 'create']);
$router->post('/users', [UserController::class, 'store'], 'csrf');
$router->get('/users/{id}', [UserController::class, 'show']);
$router->get('/users/{id}/edit', [UserController::class, 'edit'], 'auth');
$router->post('/users/{id}', [UserController::class, 'update'], ['auth', 'csrf']);
$router->post('/users/{id}/delete', [UserController::class, 'delete'], 'auth');

// Controller
class UserController extends BaseController
{
    public function index()
    {
        $users = QueryBuilder::query()
            ->table('users')
            ->orderBy('created_at', 'DESC')
            ->get();
            
        View::render('users/index', ['users' => $users]);
    }

    public function store()
    {
        $data = [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => password_hash($this->request->input('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $userId = QueryBuilder::query()
            ->table('users')
            ->insert($data);

        $this->session->set('message', 'User created successfully');
        header('Location: /users');
    }
}
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).
