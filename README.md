# ASTAR Back-end Developer Technical Assessment

## Project Overview

Congratulations on being shortlisted for the Back-end role at ASTAR! This technical assessment is designed to evaluate your skills in database design, user authentication, API integration, and Laravel API development.

## Table of Contents

1. [Database Infrastructure](#database-infrastructure)
   - [Categories Table](#categories-table)
   - [Partitions Table](#partitions-table)
   - [Items Table](#items-table)

2. [User Authentication and Authorization](#user-authentication-and-authorization)

3. [API Integration and Database Management](#api-integration-and-database-management)

4. [CRUD Operations using Laravel API](#crud-operations-using-laravel-api)

## Database Infrastructure

### Categories Table

- **name_en:** English name of the category.
- **name_ar:** Arabic name of the category.

### Partitions Table

- **name_en:** English name of the partition.
- **name_ar:** Arabic name of the partition.
- **cat_id:** Foreign key referencing the Categories table.

### Items Table

- **name_en:** English name of the item.
- **name_ar:** Arabic name of the item.
- **cat_id:** Foreign key referencing the Categories table.
- **partition_id:** Foreign key referencing the Partitions table.

## User Authentication and Authorization

Implement strong user authentication and authorization mechanisms:

- **Users Table Fields:**
  - **name:** User's name.
  - **email:** User's email.
  - **password:** User's password.
  - **type:** User type (e.g., Admin or User).
  - **phone:** User's phone number.

Provide a separate access levels for users and administrators.

## API Integration and Database Management

For API Integration Used Sanctum

## CRUD Operations using Laravel API

Created endpoints for each table (Category, Partitions, Items) that support CRUD operations (Store, Show, Update, Delete) using Laravel API. 

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/BlackOps99/Technical-Assessment.git
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env` and configure your database connection.

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Migrate and seed the database:

   ```bash
   php artisan migrate --seed
   ```

6. Serve the application:

   ```bash
   php artisan serve
   ```

7. Access the application in your browser at `http://localhost:8000`.

## Additional Notes

There is a Postman collection available for each endpoint in this project.
