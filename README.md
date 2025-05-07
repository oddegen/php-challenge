# Simple gRPC Application

## Project Structure

- /frontend: React TypeScript frontend built with Vite
- /frontend/\_\_tests\_\_: tests for the frontend
- /backend: PHP backend with gRPC
- /backend/tests: tests for the backend
- /proto: Protocol buffer definitions shared between frontend and backend

## To run

```sh
docker compose up
```

Open your browser and navigate to http://localhost:3000

## Test

### Backend

```sh
cd backend
composer install
composer run test
```

### Frontend

```sh
cd frontend
npm install
npm run test
```
