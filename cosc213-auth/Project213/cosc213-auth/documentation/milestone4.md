# Milestone 4 – Admin Feature
COSC 213 – PHP Web Development Project

---

##✔ Overview
Milestone 4 adds an admin feature to control which email addresses are allowed to register. Only users whose emails appear in the approved list can create accounts, enhancing system security.

##✔ Implemented Features

##1. Admin Panel (admin.php)
Features:
 - Accessible only to admin after login
 - Upload CSV files containing approved email addresses
 - Uploaded emails are stored in approved_emails.txt
 - Provides confirmation message upon successful upload

##2. Admin Credentials (admin_credentials.php)
Features:
 - Predefined admin credentials:
 - Username: admin
 - Password: admin123 
 - Admin login integrated with the same CSS as other pages

##3. Registration Page (register.php)
Features:
 - During registration, the system checks if the user’s email exists in          approved_emails.txt
 - Users whose emails are not in the approved list cannot register
 - Passwords are securely hashed before storing in the database
 - Maintains consistent UI theme with modern card layout

##✔ Security Improvements
 - Admin panel is protected via session management
 - Users cannot bypass email approval check
 - Passwords are hashed with password_hash() for secure storage

##✔ UI Styling
 - Admin panel uses same CSS as other pages for consistency
 - Feedback messages styled consistently with registration and login pages
 - Buttons, cards, and forms match modern responsive design

##✔ Files Added / Modified in Milestone 4
 - admin.php – Admin CSV upload panel
 - admin_credentials.php – Predefined admin credentials
 - register.php – Updated to validate approved emails
 - approved_emails.txt – Stores uploaded approved emails

---

##✔ Status
**Milestone 4 complete.**
The system now supports admin-controlled registration, ensuring only approved users can create accounts, while keeping consistent styling with other pages.