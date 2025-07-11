# Video Rental System - Database Implementation

## Overview
This project implements a complete Video Rental System with database connectivity and full CRUD (Create, Read, Update, Delete) functionality. The system has been upgraded from session-based storage to MySQL database storage for persistent data management.

## Features Implemented

### 1. Database Connection
- **Database**: MySQL database named `cms`
- **Connection**: Configured in `database/config.php`
- **Table**: `videos` table with the following structure:
  ```sql
  CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    director VARCHAR(255),
    genre VARCHAR(255),
    release_year INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
  ```

### 2. CRUD Operations

#### Create (Add Video)
- **File**: `add.php`
- **Features**:
  - Form validation for required fields
  - Genre field added for better categorization
  - Success/error message handling
  - Automatic redirect to view page after successful addition

#### Read (View Videos)
- **Files**: `view.php`, `view_single.php`
- **Features**:
  - Display all videos in a responsive table
  - Search functionality across title, director, and genre
  - Video count display
  - Individual video detail view with complete information
  - Pagination-ready structure

#### Update (Edit Video)
- **File**: `edit.php`
- **Features**:
  - Pre-populated form with existing video data
  - All fields editable including the new genre field
  - Form validation
  - Success confirmation and redirect

#### Delete (Remove Video)
- **File**: `delete.php`
- **Features**:
  - Confirmation page before deletion
  - Display video details before deletion
  - Safe deletion with proper error handling
  - Success/error message feedback

### 3. Additional Features

#### Search Functionality
- Search across multiple fields (title, director, genre)
- Real-time search results
- Clear search option
- Search result count display

#### User Interface Improvements
- **AdminLTE Framework**: Modern, responsive design
- **Icons**: Font Awesome icons for better UX
- **Alerts**: Bootstrap-based success/error messages
- **Navigation**: Intuitive sidebar navigation
- **Responsive Design**: Mobile-friendly interface

#### Home Dashboard
- Welcome message and feature overview
- Total video count display
- Recent videos list
- Quick action buttons

## File Structure

```
videoRental/
├── index.php                 # Main application file with routing
├── functions.php             # Core application functions
├── database_functions.php    # Database-specific CRUD functions
├── add.php                   # Add new video form
├── edit.php                  # Edit video form
├── delete.php                # Delete video confirmation
├── view.php                  # List all videos with search
├── view_single.php           # Individual video details
├── menu.php                  # Navigation menu
├── database/
│   └── config.php           # Database connection configuration
└── README.md                # This documentation
```

## Database Setup Instructions

### Option 1: Automatic Setup (Recommended)
The database and table are automatically created when you first access the application, thanks to the setup code in `database/config.php`.

### Option 2: Manual Setup via phpMyAdmin
If you prefer to set up the database manually:

1. **Create Database**:
   ```sql
   CREATE DATABASE cms;
   ```

2. **Create Videos Table**:
   ```sql
   USE cms;
   CREATE TABLE videos (
     id INT AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(255) NOT NULL,
     director VARCHAR(255),
     genre VARCHAR(255),
     release_year INT,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

3. **Configure Database Connection**:
   Update `database/config.php` if needed:
   ```php
   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "cms";
   ```

## Installation & Setup

1. **Prerequisites**:
   - Apache web server
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - PHP MySQL extension

2. **Installation**:
   - Extract the project files to your web server directory
   - Ensure proper file permissions
   - Access the application via web browser

3. **First Run**:
   - The database and table will be created automatically
   - Start adding videos to test the functionality

## Testing the Application

The system has been thoroughly tested with the following scenarios:

1. **Create**: Successfully added "Inception" movie with all details
2. **Read**: Displayed video list and individual video details
3. **Update**: Modified genre from "Thriller" to "Sci-Fi Thriller"
4. **Delete**: Confirmation page displays correctly
5. **Search**: Successfully searches across all fields

## Security Features

- **SQL Injection Protection**: All database queries use proper escaping
- **Input Validation**: Required field validation on both client and server side
- **Error Handling**: Graceful error handling with user-friendly messages
- **Data Sanitization**: All output is properly escaped to prevent XSS

## Future Enhancements

Potential improvements for the system:
- User authentication and authorization
- Video rental tracking functionality
- Customer management
- Inventory management
- Reporting and analytics
- Image upload for movie posters
- Advanced search filters
- Pagination for large datasets

## Technical Notes

- **Framework**: Pure PHP with AdminLTE for UI
- **Database**: MySQL with mysqli extension
- **Architecture**: MVC-inspired structure with separation of concerns
- **Responsive**: Mobile-friendly design
- **Browser Compatibility**: Modern browsers supported

## Troubleshooting

### Common Issues:

1. **Database Connection Error**:
   - Check MySQL service is running
   - Verify database credentials in `config.php`
   - Ensure PHP MySQL extension is installed

2. **Permission Errors**:
   - Check file permissions on web directory
   - Ensure web server has read/write access

3. **Display Issues**:
   - Clear browser cache
   - Check for JavaScript errors in browser console

## Conclusion

The Video Rental System now features complete database integration with full CRUD functionality. The system provides a solid foundation for managing video collections with a modern, user-friendly interface and robust backend functionality.

