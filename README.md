# Splitit: Group and Personal Finance Tracker

**Splitit** is a web-based financial management application designed to handle both personal expenses and group expense splitting seamlessly. Built using a robust PHP backend and a dynamic JavaScript/SASS frontend, it allows users to track individual spending habits, generate comprehensive periodic reports, and manage shared group tabs efficiently.

---

## 🚀 Key Features

### 👤 Personal Expense Management
* **Add & Edit Expenses:** Record daily transactional data with categories and timestamps.
* **Smart Dashboard:** Live visualizations tracking personal monthly limits and wallet balances.
* **Dynamic Reporting:** Generate detailed expense statements broken down day-wise, month-wise, or year-wise.

### 👥 Group Expense Splitting
* **Create & Manage Groups:** Establish shared circles for roommates, trips, or events.
* **Smart Splitting Engine:** Input bills and allocate shares dynamically among group members.
* **Dues Ledger:** View transparent breakdowns of pending balances and recorded settlements.

---

## 🛠️ Tech Stack

* **Backend:** PHP, Hack (v0.5%)
* **Frontend:** JavaScript (60.4%), HTML (16.8%), CSS/SCSS/SASS (9.9%)
* **Database:** MySQL / MariaDB (SQL relational schema)

---

## 📁 Repository Structure

```text
├── assets/                 # Third-party styling libraries and static fonts
├── css/                    # Compiled production stylesheets
├── sass/                   # Modular SASS codebases defining the UI layer
├── js/                     # Component scripts managing client-side events
├── images/                 # Graphical assets, icons, and illustrations
├── uploads/                # User profile photos and invoice attachment directory
├── includes/               # Reusable modular code blocks (headers, navigation, footers)
│
├── config.php              # Global environment configuration and MySQL connection initialization
├── index.php               # Public gateway / platform welcome page
├── login.php               # User identification and credentials verification page
├── register.php            # New profile generation system
├── logout.php              # Session destruction controller
│
├── dashboard.php           # Unified personal overview panel
├── add-expense.php         # Personal expense ledger processing
├── manage-expense.php      # Directory for modifying or deleting personal expense history
│
├── create-group.php        # Group profile initiation engine
├── group_dashboard.php    # Aggregated overview panel for team expenses
├── manage-group.php        # Member lists and administrative control panel
├── split_expense.php       # Transaction split distribution logic
├── pay_expense.php         # Payment processing and reconciliation engine
├── pending_dues.php        # Balance logs tracking un-settled debts
│
├── expense-reports.php     # Report configuration and date range filters
├── expense-datewise-reports-detailed.php   # Detailed date-specific metrics generator
├── expense-monthwise-reports-detailed.php  # Detailed monthly aggregations
└── detsdb (11).sql         # Database foundational architecture dump
```

---

## 💻 Installation & Local Setup

### 1. Prerequisites
Ensure you have a local web server environment installed, such as [XAMPP](https://apachefriends.org) or [WampServer](https://wampserver.com).

### 2. Clone the Repository
```bash
git clone https://github.com
cd Splitit-Group-And-Personal-Finance_Tracker
```

### 3. Deploy Assets
Move the project folder into your local server's public directory (e.g., `C:/xampp/htdocs/` for XAMPP).

### 4. Database Initialization
1. Launch **phpMyAdmin** through your browser (`http://localhost/phpmyadmin`).
2. Create a new database named `detsdb`.
3. Select the `detsdb` database, click on the **Import** tab, and upload the latest schema file: `detsdb (11).sql`.

### 5. System Configuration
Open `config.php` and verify that the database credentials match your local MySQL configuration:
```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Input your local database password if applicable
define('DB_NAME', 'detsdb');
```

### 6. Run the Application
Open your web browser and navigate to:
```text
http://localhost/Splitit-Group-And-Personal-Finance_Tracker/index.php
```

---

## 🔒 Security Features Implemented
* Session-based user verification to protect dashboard entry.
* Secure routing patterns using explicit `logout.php` and password updates via `change-password.php`.
