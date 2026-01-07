# Public Grievance Management System

A web-based platform for citizens to submit and track grievances with the Nepal Government.

## 🛠 Tech Stack
- **Frontend**: HTML, Tailwind CSS (via CDN)
- **Backend**: PHP
- **Database**: MySQL

## 🚀 How to Run

### Prerequisites
You need a local server environment with **PHP** and **MySQL**.
- **Mac**: MAMP, XAMPP, or Homebrew (PHP + MySQL).
- **Windows**: XAMPP or WAMP.
- **Linux**: LAMP stack.

### Step 1: Database Setup
1. Start your MySQL Server.
2. Create a new database named `grievance_db`.
3. Import the `database.sql` file provided in this project into that database.
   - You can use tools like **phpMyAdmin**, **MySQL Workbench**, or the command line:
     ```bash
     mysql -u root -p grievance_db < database.sql
     ```

### Step 2: Configure Connection
1. Open `db_connect.php`.
2. Update the credentials to match your local MySQL configuration:
   ```php
   $host = 'localhost';
   $dbname = 'grievance_db';
   $username = 'root'; // Change if different
   $password = '';     // Change if different (MAMP users often use 'root')
   ```

### Step 3: Start the Server
You can use PHP's built-in server for testing.
1. Open your terminal/command prompt.
2. Navigate to the project directory:
   ```bash
   cd /path/to/Public-Grievance-Management-System
   ```
3. Run the following command:
   ```bash
   php -S localhost:8000
   ```

### Step 4: Usage
1. Open your browser and go to: [http://localhost:8000](http://localhost:8000)
2. **Register**: Create a new citizen account.
3. **Login**: Log in to submit grievances.
4. **Admin Access**:
   - To access the admin dashboard, you need an account with the role `admin`.
   - You can manually update a registered user's role in the database:
     ```sql
     UPDATE users SET role = 'admin' WHERE email = 'your@email.com';
     ```
