# Construction Management System

A comprehensive PHP and MySQL-based web application developed to streamline construction project operations, employee coordination, and project tracking within construction companies. The system centralizes project management activities, improves communication between teams, and enhances accountability through automated tracking and reporting.

The system also integrates an AI-powered chatbot that provides intelligent assistance and real-time user support for navigation, project inquiries, and general construction-related questions.

## Features
### Project Management
Create, update, and manage construction projects.
Monitor project progress and completion status.
Track ongoing and completed projects.
### Employee Management
Add and manage employees and staff information.
Assign workers to specific projects and divisions.
Manage positions and employee roles.
### Team & Division Management
Organize projects into divisions and partitions.
Manage project teams efficiently.
Improve coordination among departments.
### Progress Tracking
Monitor project timelines and completion percentages.
Generate project progress updates in real time.
Reduce delays through centralized tracking.
Attendance Management
Record employee attendance.
Maintain attendance history and staff records.
### AI Chatbot Support
Provide intelligent assistance to users.
Answer construction-related questions.
Assist users in navigating the system.
Retrieve selected information from the database for quick support.
### Security & Authentication
Secure login and role-based access control.
Restrict access based on user privileges.
### Reporting
Generate reports for projects, employees, and progress tracking.
Improve transparency and accountability.

### Technologies
PHP – Backend development
MySQL – Database management
HTML/CSS – Frontend structure and styling
JavaScript – Client-side functionality
XAMPP – Local server environment
phpMyAdmin – Database administration

### Installation
Clone the Repository
git clone https://github.com/yourusername/construction-management-system.git
Move Project to XAMPP htdocs

Move the project folder into:

C:\xampp\htdocs\

Example:

C:\xampp\htdocs\construction_pms
Start XAMPP

Open XAMPP Control Panel and start:

Apache
MySQL
Database Setup
Create Database
Open phpMyAdmin:
http://localhost/phpmyadmin
Create a new database:
construction_pms_db
Import Database
Select the database.
Click Import.
Choose the provided .sql file.
Click Go.
Configure Database Connection

Open the configuration file and update database credentials:

$host = "localhost";
$username = "root";
$password = "";
$database = "construction_pms_db";
Running The Application

Open browser and run:

http://localhost/construction_pms/

If required:

http://localhost/construction_pms/admin/
#### Default Login Credentials
Username: admin
Password: admin
System Modules
Authentication Module
Secure login system
Role-based access
Project Module
Project creation and tracking
Project updates and monitoring
Employee Module
Employee registration and management
Attendance tracking
Team Management Module
Team assignment and coordination
Reporting Module
Automated reports and project summaries
AI Chatbot Module
Intelligent support assistant
Construction-related assistance
Database-aware responses
### Example Chatbot Questions
How many projects are currently ongoing?
How many employees are registered?
What is a construction foundation?
Explain the purpose of concrete in construction.

## Project Structure
construction-management-system/
│
├── admin/                     # Admin dashboard and system modules
├── assets/                    # CSS, JavaScript, and images
├── chatbot/                   # AI chatbot files
├── database/                  # Database SQL file
├── includes/                  # Configuration and reusable components
├── employee/                  # Employee management module
├── project/                   # Project management module
├── reports/                   # Reporting module
├── index.php                  # Main entry file
├── login.php                  # Login page
├── config.php                 # Database configuration
├── README.md                  # Project documentation

## Future Enhancements
Cloud deployment for remote accessibility
Mobile application integration
Real-time notifications and alerts
Advanced AI chatbot intelligence
Data analytics and predictive reporting

## Supporting Documents
1. Project Proposal - https://docs.google.com/document/d/1ho8KQ0WDwcaefQDWtjXHvHE6lQiyNQFwbFGwUq9e4vM/edit?usp=sharing
2. System Requirement Specification - https://docs.google.com/document/d/1kAeWub1_iXD_B98osUpFNs7KLGrXmp__-5UuhPUGpoQ/edit?usp=sharing
3. Software Design Specification - https://docs.google.com/document/d/1FuE62RQCWe_s6vqOyhMZtFap7Mc6siDDWFcNboIQhfM/edit?usp=sharing
4. Implementation plan document - https://docs.google.com/document/d/1gG4vwOGCuXeWPGtDAS7EyXO1eeScdbmUr2QuaWMYgrc/edit?usp=sharing
5. User Manual - https://docs.google.com/document/d/1ab9QBD7pyRUcwHlmwfc9bGanYUo_30qW1L3x4LmLBq0/edit?usp=sharing
6. Final Report Document - https://docs.google.com/document/d/1ab9QBD7pyRUcwHlmwfc9bGanYUo_30qW1L3x4LmLBq0/edit?usp=sharing

## Author
Created by Lynn Murugi Kibuthu
Email - lynnbilly376@gmail.com
