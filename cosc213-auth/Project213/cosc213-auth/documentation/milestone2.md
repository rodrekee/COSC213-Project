
---

# 🟩 **documentation/milestone2.md**

```md
# Milestone 2 – Registration & Login  
COSC 213 – PHP Web Development Project  

---

## ✔ Overview
Milestone 2 implements the first functional part of the authentication system:

- User registration  
- User login  

Security best practices such as password hashing and prepared statements were applied.

---

## ✔ Implemented Features

### 1. User Registration (`register.php`)
The registration system includes:
- First name, family name, email, password, confirm password  
- Address and phone (optional)
- Full form validation  
- Duplicate email prevention
- Secure password storage using `password_hash()`
- Error reporting for invalid fields  
- Success message on completion

### 2. User Login (`login.php`)
The login system includes:
- Email + password authentication  
- Password verification using `password_verify()`
- Secure session creation
- Redirect to `profile.php` after success
- Validation of incorrect credentials

### 3. UI Enhancements
Both pages include:
- Modern dark UI  
- Enhanced spacing  
- Custom button styling  
- Animated input focus effects  
- Card-based layout  

---

## ✔ Security Features
- All database operations use prepared statements  
- Passwords are never stored in plain text  
- Sessions are validated before accessing protected pages  

---

## ✔ Files Added / Modified in Milestone 2
- `register.php`  
- `login.php`  
- Updated `assets/style.css`  
- `/documentation/milestone2.md`

---

## ✔ Status
**Milestone 2 complete.**  
User creation and authentication are fully functional.
