# Milestone 3 – Profile & Logout  
COSC 213 – PHP Web Development Project  

---

## ✔ Overview
Milestone 3 adds the final components required for a complete authentication system:

- Protected profile page  
- Logout functionality  

All profile data is displayed from the database, and session management ensures security.

---

## ✔ Implemented Features

### 1. Profile Page (`profile.php`)
Features:
- Requires user to be logged in  
- Redirects to login if no session exists  
- Fetches user data from the database securely  
- Displays:
  - First name  
  - Family name  
  - Email  
  - Address  
  - Phone  
- Fully integrated UI theme  
- Modern card layout and responsive table  

### 2. Logout (`logout.php`)
Features:
- Secure session destruction
- Unsets all session variables  
- Redirects the user to the login page  

### 3. Security Improvements
- Prevents unauthorized access  
- Forces logout if user ID is invalid or deleted  

---

## ✔ UI Styling
- Improved spacing between elements  
- Enhanced button appearance  
- Glass-style cards and dark theme  
- Profile table styling  

---

## ✔ Files Added / Modified in Milestone 3
- `profile.php`  
- `logout.php` (final version)  
- Updated `assets/style.css`  
- `/documentation/milestone3.md`

---

## ✔ Status
**Milestone 3 complete.**  
The core user authentication system is fully functional and secure.
