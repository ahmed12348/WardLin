# Technical Assessment - Project README

## Overview

This project focuses on developing API routes for an admin panel to manage companies, employees, users, and notes. Each task is detailed with corresponding implementation steps to achieve the desired functionality.

## Tasks Breakdown

### 1. Database Setup

- **Migrations**: Database schemas created using Laravel migrations for companies, employees, users, and notes tables.
- **Database Seeding**: Initial data seeding, including the first user, for testing and admin setup.

### 2. Authentication and Security

- **Auth Middleware**: Implementation of Laravel's auth middleware for user-related routes to ensure authentication is required.
- **Single-Device Login**: Logic applied to allow login from only one device, enhancing user account security.
- **Rate Limiting**: Limiting login attempts to 5 per minute to prevent potential brute force attacks.

### 3. CRUD Functionality

- **Companies, Employees, and Users**: CRUD functionalities for managing companies, employees, and users via API routes.

### 4. Additional Implementations

- **Image Storage**: Secure image storage in the `storage/app/public` directory with symbolic link creation for accessibility.
- **Model Accessor**: `getFullnameAttribute` implemented in the Employee model to combine first and last names.
- **Request Validation**: Custom Request classes ensure proper validation for incoming requests.
- **Email Notifications**: Notification triggers when a user updates their password, enhancing security.
- **Repository Pattern**: Repository pattern implemented for the Company entity, separating business and data access logic.
- **SMS Notifications (Channel)**: Custom channel creation for SMS notifications, focusing on structure.
- **Activity Logging**: Implemented logging to track changes in employee records.
- **Unit Testing**: PHPUnit tests to ensure repository class functionality for Companies, covering CRUD operations.

## Usage

Refer to the project's codebase for detailed step-by-step instructions to use the API routes and features provided. Follow the guidelines in the respective code comments for a clear understanding of each task's implementation.
