# Todo App API

A Laravel-based RESTful API for managing todo tasks with user authentication (OAuth2 via Passport).

---

## Features

- User registration and login (with validation)
- OAuth2 authentication using Laravel Passport
- CRUD operations for todos (per user)
- Pagination for todo lists
- API responses in JSON format

---

## Requirements

- PHP >= 8.1
- Composer
- Database: MySQL

---

## Setup

### 1. Clone the repository

```sh
git clone https://github.com/Hagar-Elbakry/Todo-App-Api.git
cd todo-app-api
```

### 2. Install dependencies

```sh
composer install
```

### 3. Environment configuration

Copy `.env.example` to `.env` and update as needed:

```sh
cp .env.example .env
```

Set your database credentials and other environment variables in `.env`.

### 4. Generate application key

```sh
php artisan key:generate
```

### 5. Run migrations

```sh
php artisan migrate
```

## 6. Install Passport

```sh
php artisan passport:install
```

This command will generate encryption keys and create the necessary clients for OAuth2.

**To create a Password Grant Client (required for issuing and refreshing tokens), run:**

```sh
php artisan passport:client --password
```

You will be prompted to provide a name for the client. After creation, copy the generated client ID and secret and add them to your `.env` file:

```
CLIENT_ID=...
CLIENT_SECRET=...
```

> **Note:**  
> We create a Password Grant Client specifically to support issuing access tokens and refresh tokens for user authentication.

## 7.Running the Application

Start the application using a proper web server (such as Apache, Nginx, or Laravel Valet).  
**Do not use `php artisan serve` for API testing**, as it may cause issues with authentication and token handling.

---

## API Endpoints

### Authentication

- `POST /api/auth/register` — Register a new user
- `POST /api/auth/login` — Login and receive access token and refresh token
- `POST /api/auth/refresh-token` — Refresh Token
- `POST /api/auth/logout` — Logout user

### Todos

- `GET /api/auth/todos` — List all todos (paginated)
- `POST /api/auth/todos` — Create a new todo
- `GET /api/auth/todos/{id}` — Get a specific todo
- `PUT /api/auth/todos/{id}` — Update a todo
- `DELETE /api/auth/todos/{id}` — Delete a todo

All todo endpoints, refresh token and logout endpoints require a valid Bearer token.

---

## Project Structure

- `app/Http/Controllers` — API controllers ([AuthController](app/Http/Controllers/Auth/AuthController.php), [TodoController](app/Http/Controllers/TodoController.php))
- `app/Http/Requests` — Form request validation ([AuthLogin](app/Http/Requests/AuthLogin.php), [AuthRegister](app/Http/Requests/AuthRegister.php), [TodoRequest](app/Http/Requests/TodoRequest.php))
- `app/Models` — Eloquent models ([User](app/Models/User.php), [Todo](app/Models/Todo.php))
- `app/Services` — Business logic ([AuthService](app/Services/AuthService.php), [TodoService](app/Serviecs/TodoService.php))
- `app/Repositories` — Data access ([AuthRepository](app/Repositories/AuthRepository.php), [TodoRepository](app/Repositories/TodoRepository.php))
- `database/migrations` — Database schema
- `routes/api.php` — API routes
- `config/` — Configuration files

