# Milestone 1 – Project Setup  
COSC 213 – PHP Web Development Project  
Group Members:  
- Rodrigo Marini  
- (Partner 2 Name)  
- (Partner 3 Name)

---

## ✔ Overview
Milestone 1 focused on setting up the project environment, configuring the database, and establishing the initial application structure.

This milestone established the foundation for all future work.

---

## ✔ Implemented Features

### 1. Docker Environment
A complete Docker environment was created using:
- PHP 8 + Apache container  
- MySQL container  
- Dockerfile and docker-compose.yml  

`docker-compose.yml` defines two services:  
- `web` (PHP/Apache)  
- `db` (MySQL)

### 2. Database Setup
A MySQL database named **cosc213** was created.

Table implemented:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    family_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    phone VARCHAR(50)
);
