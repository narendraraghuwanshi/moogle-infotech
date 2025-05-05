# Real Estate Management System

A full-stack application for managing real estate properties using Laravel and React.

## Project Structure

```
real-estate-api/     # Laravel backend
real-estate-frontend/ # React frontend
```

## Installation

### Backend (Laravel)

1. Navigate to backend directory:
   ```bash
   cd real-estate-api
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy environment file and configure:
   ```bash
   cp .env.example .env
   ```
   Update the following in `.env`:
   ```
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   The API will be available at `http://127.0.0.1:8001/api`

### Frontend (React)

1. Navigate to frontend directory:
   ```bash
   cd real-estate-frontend
   ```

2. Install Node.js dependencies:
   ```bash
   npm install
   ```

3. Start the React development server:
   ```bash
   npm start
   ```
   The frontend will be available at `http://localhost:3000`

## Testing

### Backend Tests

1. Run all Laravel tests:
   ```bash
   php artisan test
   ```

2. Run specific test file:
   ```bash
   php artisan test tests/Feature/RealEstateTest.php
   ```

### Frontend Tests

1. Run React tests:
   ```bash
   cd real-estate-frontend
   npm test
   ```

2. Run tests in watch mode:
   ```bash
   npm test -- --watch
   ```

## Development Setup

### Environment Variables

1. Backend (.env):
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=real_estate
   DB_USERNAME=root
   DB_PASSWORD=
   ```

2. Frontend (no .env needed, configuration in src/config.js):
   ```
   API_URL=http://127.0.0.1:8001/api
   ```

### Running in Development

1. Start backend server:
   ```bash
   cd real-estate-api
   php artisan serve
   ```

2. In a new terminal, start frontend:
   ```bash
   cd real-estate-frontend
   npm start
   ```

3. Access the application:
   - Frontend: http://localhost:3000
   - API: http://127.0.0.1:8001/api

## API Documentation

### Base URL
- Development: `http://127.0.0.1:8001/api`
- Production: `https://real-estate-api.test/api`

### Endpoints

#### Properties
- `GET /real-estates` - List all properties
- `GET /real-estates/{id}` - Get specific property
- `POST /real-estates` - Create new property
- `PUT /real-estates/{id}` - Update property
- `DELETE /real-estates/{id}` - Delete property

## Troubleshooting

### Common Issues

1. Database connection error:
   - Verify database credentials in .env
   - Ensure MySQL server is running
   - Run migrations: `php artisan migrate`

2. CORS issues:
   - Ensure CORS middleware is properly configured
   - Check browser console for CORS errors

3. API token errors:
   - Verify API token in frontend configuration
   - Check token validation in backend middleware

## License

This project is licensed under the MIT License - see the LICENSE file for details.# moogle
# moogle
# moogle
