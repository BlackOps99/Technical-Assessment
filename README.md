# ASTAR Full Stack Developer Technical Assessment

## Project Overview

Congratulations on being shortlisted for the Full Stack Developer role at ASTAR! This technical assessment is designed to evaluate your skills in database design, user authentication, API integration, and Laravel API development.

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

Ensure the database design follows best practices for security and data integrity.

## User Authentication and Authorization

Implement strong user authentication and authorization mechanisms:

- **Users Table Fields:**
  - **name:** User's name.
  - **email:** User's email.
  - **password:** User's password.
  - **type:** User type (e.g., Admin or User).
  - **phone:** User's phone number.

Provide separate access levels for users and administrators. Ensure that only authorized users can access certain features or perform specific actions.

## API Integration and Database Management

Demonstrate your skills in API integration, database management, and relations processing. Showcase your ability to handle API requests effectively and efficiently.

## CRUD Operations using Laravel API

Create endpoints for each table (Category, Partitions, Items) that support CRUD operations (Create, Read, Update, Delete) using Laravel API. Ensure that access to the tables (Category, Partitions, Items) is restricted to authorized users with the "Admin" user type.

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/astar-fintech-project.git
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

- Please ensure to thoroughly comment your code for better understanding.
- Provide clear documentation on API endpoints and usage.

Good luck! We look forward to reviewing your work. If you have any questions or need clarification, feel free to reach out.

Best regards,
ASTAR Hiring Team