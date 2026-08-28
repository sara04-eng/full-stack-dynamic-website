# Task 26 – Full Stack Dynamic Website

## 📌 Project Overview

This project is **Task 26 in Full Stack Web Development**.

The goal of this task was to transform a static website template into a **fully dynamic full-stack website** based on the provided **PRD (Product Requirements Document)** and **PDD (Product Design Document)**.

The project includes:

* A dynamic frontend website.
* A dynamic PHP/MySQL backend.
* An administrator dashboard.
* CRUD operations for dynamic website content.
* Database integration.
* Responsive UI.
* Blog management.
* Comments management.
* Contact information management.
* Social links management.

---

## 🎯 Task Requirements

The task required developing a full-stack dynamic website using the provided website templates and following the provided PRD and PDD.

The main requirements included:

1. Study the provided PRD and PDD.
2. Develop the website based on the provided design.
3. Convert static website content into dynamic database-driven content.
4. Create an administrator dashboard.
5. Connect the website with the database.
6. Implement CRUD operations where required.
7. Test all website and dashboard sections.
8. Prepare a video showing the website and administrator dashboard.
9. Submit the completed source code.

---

## 🛠️ Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap
* Font Awesome

### Backend

* PHP
* PDO

### Database

* MySQL
* phpMyAdmin

### Development Environment

* XAMPP
* Apache
* MySQL
* Visual Studio Code

### Version Control

* Git
* GitHub

---

## 🏗️ Project Architecture

The project is divided into several main parts:

```text
Task 26/
│
├── admin/
│   ├── index.php
│   ├── about.php
│   ├── comments.php
│   ├── contact_messages.php
│   ├── contact_info.php
│   ├── post.php
│   ├── social_links.php
│   ├── blog_post_form.php
│   ├── blog_post_delete.php
│   ├── comment_form.php
│   ├── comment_delete.php
│   ├── social_link_form.php
│   └── social_link_delete.php
│
├── api/
│   └── ...
│
├── assets/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── ...
│
├── config.php
│
├── includes/
│   └── ...
│
├── index.php
├── about.php
├── contact.php
├── blog.php
├── post.php
└── ...
```

> The exact files may vary depending on the final project structure and the provided template.

---

# 🌐 Frontend Website

The original website template was converted into a dynamic PHP website.

Instead of keeping the website content hard-coded, the website retrieves dynamic information from the MySQL database.

The frontend was connected to the backend and database so that changes made through the administrator dashboard can be reflected on the website.

---

## 📄 Dynamic Website Sections

The website contains dynamic sections according to the PRD and PDD.

Examples include:

* Home
* About
* Blog
* Blog Posts
* Comments
* Contact
* Social Links
* Contact Information

The website was tested after connecting the dynamic content to the database.

---

# 🔐 Administrator Dashboard

An administrator dashboard was developed to manage the website content.

The dashboard provides access to the main dynamic sections of the website.

The administrator can view, add, edit, and delete content where required.

---

## 📊 Dashboard

The admin dashboard provides a central interface for managing the website.

The dashboard includes navigation to the different management sections.

---

# 📝 Blog Posts Management

The Blog Posts section allows the administrator to manage blog content.

### Available Operations

* Add Blog Post
* Edit Blog Post
* Delete Blog Post
* View Blog Posts

Each blog post contains information such as:

* ID
* Image
* Title
* Subtitle
* Blogger Name
* Publish Date
* Description

---

## ➕ Add / Edit Blog Post

The same form is used for both adding and editing blog posts.

File:

```text
admin/blog_post_form.php
```

The form detects whether an ID was provided.

### Add

```text
blog_post_form.php
```

Creates a new blog post.

### Edit

```text
blog_post_form.php?id=POST_ID
```

Loads the selected blog post and allows the administrator to update it.

---

## 🗑️ Delete Blog Post

Blog posts are deleted using:

```text
admin/blog_post_delete.php
```

The delete action receives the post ID and removes the corresponding record from the database.

---

# 💬 Comments Management

The Comments section allows the administrator to manage comments submitted to blog posts.

File:

```text
admin/comments.php
```

The comments section displays:

* Comment ID
* Related Blog
* Guest Name
* Comment
* Date
* Actions

---

## ➕ Add / Edit Comments

A dedicated form is used for adding and editing comments.

```text
admin/comment_form.php
```

The form supports:

* Creating a new comment.
* Editing an existing comment.

---

## 🗑️ Delete Comments

Comments are deleted using:

```text
admin/comment_delete.php
```

The administrator can delete a selected comment after confirmation.

---

# 🔗 Social Links Management

The Social Links section allows the administrator to manage the social media links displayed on the website.

File:

```text
admin/social_links.php
```

The section displays:

* ID
* Platform
* URL
* Actions

---

## ➕ Add / Edit Social Links

The same form handles both operations.

File:

```text
admin/social_link_form.php
```

### Add

```text
social_link_form.php
```

### Edit

```text
social_link_form.php?id=SOCIAL_LINK_ID
```

---

## 🗑️ Delete Social Links

Social links can be deleted using:

```text
admin/social_link_delete.php
```

A confirmation message is displayed before deletion.

---

# 📞 Contact Information Management

The Contact Information section manages the information displayed on the website.

File:

```text
admin/contact_info.php
```

The information includes:

* Phone
* Email
* Address

The administrator can update the existing contact information through the dashboard.

---

# ✉️ Contact Messages

The administrator can view messages submitted through the website's contact form.

File:

```text
admin/contact_messages.php
```

This allows the administrator to manage and review incoming contact messages.

---

# 🗄️ Database

The website is connected to a MySQL database.

The database stores the dynamic website content and administrator-managed data.

Main database entities include:

```text
blogs
comments
social_links
contact_info
contact_messages
```

The database is accessed from PHP using PDO.

---

# 🔌 Database Connection

The database connection is handled through:

```text
config.php
```

Example structure:

```php
include '../config.php';
```

The configuration file provides the PDO connection used by the frontend and administrator dashboard.

---

# 🔄 CRUD Operations

CRUD functionality was implemented for the required dynamic sections.

CRUD stands for:

* **Create** – Add new records.
* **Read** – Display records from the database.
* **Update** – Edit existing records.
* **Delete** – Remove records.

---

## CRUD Structure

### Blog Posts

```text
Create  → blog_post_form.php
Read    → post.php
Update  → blog_post_form.php?id=ID
Delete  → blog_post_delete.php?id=ID
```

### Comments

```text
Create  → comment_form.php
Read    → comments.php
Update  → comment_form.php?id=ID
Delete  → comment_delete.php?id=ID
```

### Social Links

```text
Create  → social_link_form.php
Read    → social_links.php
Update  → social_link_form.php?id=ID
Delete  → social_link_delete.php?id=ID
```

### Contact Information

```text
Read    → contact_info.php
Update  → contact_info.php
```

---

# 🔒 Security and Validation

Several basic security practices were used throughout the project.

### Prepared Statements

Database queries use PDO prepared statements to reduce the risk of SQL injection.

Example:

```php
$stmt = $pdo->prepare("
    DELETE FROM blogs
    WHERE id = ?
");

$stmt->execute([$id]);
```

### Output Escaping

Database values displayed in HTML are escaped using:

```php
htmlspecialchars()
```

Example:

```php
<?= htmlspecialchars($post['title']) ?>
```

### ID Validation

IDs received through URL parameters are checked before database operations.

Example:

```php
$id = isset($_GET['id']) && is_numeric($_GET['id'])
    ? (int) $_GET['id']
    : 0;
```

---

# 🎨 UI and Design

The project keeps the provided website template and follows the design requirements from the PDD.

Bootstrap was used for responsive layouts and admin dashboard components.

The administrator dashboard includes:

* Responsive tables
* Forms
* Action buttons
* Success messages
* Error messages
* Delete confirmation messages
* Navigation buttons
* Dashboard navigation

---

# 🧪 Testing

After implementing the dynamic functionality, the website and administrator dashboard were tested.

Testing included:

### Frontend

* Website pages loading correctly.
* Dynamic content displaying correctly.
* Blog posts displaying correctly.
* Contact information displaying correctly.
* Social links working correctly.
* Blog comments displaying correctly.
* Contact forms working correctly.

### Admin Dashboard

* Dashboard navigation.
* Viewing database records.
* Adding records.
* Editing records.
* Deleting records.
* Form validation.
* Success messages.
* Delete confirmation.
* Database updates.

---

# 🖥️ Local Setup

To run the project locally:

### 1. Install XAMPP

Install XAMPP and make sure Apache and MySQL are available.

### 2. Copy the Project

Place the project inside:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\Task 26\
```

### 3. Start XAMPP

Start:

```text
Apache
MySQL
```

### 4. Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Create the required database and import the project SQL database file if included.

### 5. Configure the Database

Update:

```text
config.php
```

with the correct:

* Database name
* Username
* Password
* Host

### 6. Run the Website

Open:

```text
http://localhost/Task%2026/
```

### 7. Open the Admin Dashboard

Open:

```text
http://localhost/Task%2026/admin/
```

---

# 📁 Important Files

| File                           | Purpose                        |
| ------------------------------ | ------------------------------ |
| `index.php`                    | Main website page              |
| `config.php`                   | Database connection            |
| `admin/index.php`              | Admin dashboard                |
| `admin/post.php`               | Blog posts management          |
| `admin/blog_post_form.php`     | Add/Edit blog posts            |
| `admin/blog_post_delete.php`   | Delete blog posts              |
| `admin/comments.php`           | Comments management            |
| `admin/comment_form.php`       | Add/Edit comments              |
| `admin/comment_delete.php`     | Delete comments                |
| `admin/social_links.php`       | Social links management        |
| `admin/social_link_form.php`   | Add/Edit social links          |
| `admin/social_link_delete.php` | Delete social links            |
| `admin/contact_info.php`       | Contact information management |
| `admin/contact_messages.php`   | Contact messages management    |

---

# 📚 Learning Outcomes

Through this task, I practiced and improved my skills in:

* Full Stack Web Development
* PHP
* MySQL
* PDO
* CRUD Operations
* Database Integration
* Dynamic PHP Websites
* Admin Dashboard Development
* Form Handling
* Data Validation
* SQL Queries
* Prepared Statements
* Responsive Web Design
* Git and GitHub
* Website Testing
* Following PRD and PDD requirements

---

# 🚀 Project Status

The project has been completed according to the provided task requirements.

### Completed

* ✅ PRD reviewed and implemented
* ✅ PDD design implemented
* ✅ Static website converted to dynamic PHP website
* ✅ MySQL database created
* ✅ Frontend connected to database
* ✅ Admin dashboard completed
* ✅ CRUD functionality implemented
* ✅ Blog Posts management
* ✅ Comments management
* ✅ Social Links management
* ✅ Contact Information management
* ✅ Contact Messages management
* ✅ Forms implemented
* ✅ Delete functionality implemented
* ✅ Website tested
* ✅ Admin dashboard tested
* ✅ Project prepared for GitHub submission
* ✅ Website and administrator demonstration video prepared

---

# 👩‍💻 Developer

**Sara Nabil Abdullah Abu Odeh**

Software Engineering Graduate
Web Developer | Front-End & back-End Developer | UI/UX Designer

GitHub:

https://github.com/sara04-eng

---

# 📌 Task

**Task 26 – Full Stack Web Development**

The project was developed as part of the Full Stack Web Development training tasks, focusing on converting a website template into a complete dynamic website with database integration and an administrator dashboard.
