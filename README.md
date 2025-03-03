# E-Commerce API Integration

This API provides authentication for users and allows managing products securely with token-based authentication.

## Features
- User Registration & Login with Token Authentication
- Product Management (CRUD operations)
- Secure API requests using Laravel Sanctum tokens

## Technologies Used
- Laravel (Backend)
- Sanctum for API Authentication
- MySQL (Database)
- Postman for API testing

---

## Installation & Setup

1. Clone the repository
   ```sh
   git clone https://github.com/miki2144/Product_manage.git
   cd Product_manage
   ```

2. Install dependencies
   ```sh
   composer install
   ```

3. Set up the environment
   - Create a `.env` file by copying `.env.example`
   ```sh
   cp .env.example .env
   ```
   - Configure database credentials in `.env`

4. Generate application key
   ```sh
   php artisan key:generate
   ```

5. Run database migrations
   ```sh
   php artisan migrate
   ```


## Authentication with Sanctum
Every request to protected routes must include a Bearer Token in the Authorization header:
```sh
Authorization: Bearer {token}
```

---

## Testing the API
Use Postman or cURL to test the API:
```sh
curl -X GET "http://localhost:8000/api/products" -H "Authorization: Bearer {token}"
```

---

## License
This project is licensed under the MIT License.
#Contact
Email: mikidebesaw@gmail.com
GitHub: https://github.com/miki2144
