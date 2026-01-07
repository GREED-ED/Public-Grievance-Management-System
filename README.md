# Public Grievance Management System (PGMS)

A modern, web-based platform designed for citizens of Nepal to submit, track, and manage grievances with government departments. This system aims to improve transparency, accountability, and citizen engagement in governance.

---

## 🌟 Key Features

- **🌍 Full Multilingual Support**: Seamlessly switch between **English** and **Nepali** across the entire application.
- **🔐 Secure Authentication**: Citizen registration and login system with persistent language preferences.
- **📝 Grievance Submission**: Easy-to-use form for reporting issues, including category selection, location details, and file attachments (images/PDFs).
- **📊 Citizen Dashboard**: Personal dashboard for users to track the real-time status of their submitted grievances.
- **🛠 Admin Management**: Specialized dashboard for administrators to review grievances, update status (Pending, In Progress, Resolved, Rejected), and manage records.
- **📱 Responsive Design**: Built with a "mobile-first" approach using Tailwind CSS, ensuring a premium experience on all devices.
- **🔔 Real-time Feedback**: Interactive elements and localized alerts for a better user experience.

---

## 🛠 Tech Stack

- **Frontend**: HTML5, Vanilla CSS, Tailwind CSS (via CDN)
- **Icons**: Google Material Symbols
- **Typography**: Public Sans, Noto Sans (for Nepali support)
- **Backend**: PHP 8.x
- **Database**: MySQL / MariaDB

---

## 📂 Project Structure

```text
├── includes/           # Reusable components (Navbar, Language Logic)
├── lang/               # Translation files (en.php, np.php)
├── uploads/            # Directory for user-submitted attachments
├── admin-dashboard.php # Administrator portal
├── user-dashboard.php  # Citizen portal
├── form.php            # Grievance submission form
├── db_connect.php      # PDO database connection
├── database.sql        # Database schema and initial data
└── ... (other pages)
```

---

## 🚀 Getting Started

### Prerequisites
- A local server environment (MAMP, XAMPP, WAMP, or Local PHP/MySQL).
- PHP 7.4 or higher recommended.
- MySQL 5.7 or higher.

### Step 1: Database Setup
1. Start your MySQL Server.
2. Create a database named `grievance_db`.
3. Import the `database.sql` file:
   ```bash
   mysql -u root -p grievance_db < database.sql
   ```

### Step 2: Configuration
Update your database credentials in `db_connect.php`:
```php
$host = 'localhost';
$dbname = 'grievance_db';
$username = 'root';
$password = ''; // Set your password (often 'root' on MAMP)
```

### Step 3: Launch
Navigate to the project directory and start the local server:
```bash
php -S localhost:8000
```
Visit `http://localhost:8000` in your browser.

---

## 👤 Admin Access
To access the admin dashboard:
1. Register a normal account via the UI.
2. Manually change the `role` in the `users` table to `admin`:
   ```sql
   UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
   ```

---
© 2024 Government of Nepal. All rights reserved.

