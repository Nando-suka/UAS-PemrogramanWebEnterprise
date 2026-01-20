<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">Sleepy Dashboard</h1>

<p align="center">
  A responsive web-based dashboard application built with <strong>Laravel</strong>, designed for monitoring reports, journals, and user data in a clean and modern UI.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red" />
  <img src="https://img.shields.io/badge/PHP-8.x-blue" />
  <img src="https://img.shields.io/badge/Status-Development-yellow" />
  <img src="https://img.shields.io/badge/License-MIT-green" />
</p>

---

## 📌 Overview

**Sleepy Dashboard** is a web dashboard system developed as part of an academic and personal project.  
The application focuses on **data visualization, report management, and journal tracking**, with a strong emphasis on **UI consistency and responsive design**.

The system uses **Laravel Blade templates**, custom CSS, and JavaScript to deliver a smooth dashboard experience across desktop and mobile devices.

---

## ✨ Key Features

- 🔐 Authentication system (Login, Register, Password Reset)
- 📊 Dashboard with reports and statistics
- 📝 Journal management (Daily, Weekly, Monthly)
- 👥 User database management
- 📱 Fully responsive layout (Desktop & Mobile)
- 📂 Modular Blade layout (Header, Sidebar, Content)
- 🎨 Consistent card-based UI design
- 📈 Chart-ready structure (Chart.js compatible)

---

## 🛠 Tech Stack

| Layer | Technology |
|------|-----------|
| Backend | Laravel 10 |
| Frontend | Blade Template, HTML5, CSS3 |
| Styling | Custom CSS + Bootstrap Grid |
| JavaScript | Vanilla JS |
| Database | MySQL |
| Auth | Laravel Authentication |
| Version Control | Git & GitHub |

---

## 📁 Project Structure

resources/
├── views/
│ ├── layouts/
│ │ ├── app.blade.php
│ │ └── dashboard.blade.php
│ ├── partials/
│ │ ├── header.blade.php
│ │ └── sidebar.blade.php
│ ├── dashboard/
│ ├── jurnal/
│ ├── report/
│ └── auth/
├── css/
│ ├── app.css
│ └── sidebar.css
├── js/
│ ├── app.js
│ └── sidebar-toggle.js


---

## 🚀 Installation & Setup

Follow these steps to run the project locally:

```bash
# Clone repository
git clone https://github.com/your-username/sleepy-dashboard.git

# Enter project directory
cd sleepy-dashboard

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database migration
php artisan migrate

# Run server
php artisan serve

📱 Responsive Design

This project is designed with mobile-first considerations, supporting resolutions such as:

    Desktop (≥ 1200px)

    Tablet (768px – 1199px)

    Mobile (≤ 576px, tested on 412×915)

Key responsive behaviors:

    Off-canvas sidebar on mobile

    Adaptive dashboard grid

    Scalable cards and charts

    Fixed header with overlay-safe sidebar

🎯 Project Goals

    Practice Laravel Blade architecture

    Implement clean dashboard UI

    Understand responsive layout challenges

    Apply separation of concerns (layout, components, pages)

    Prepare a portfolio-ready Laravel project

🤝 Contributing

This project is currently developed for learning purposes.
Suggestions, feedback, and improvements are welcome.

Steps:

    Fork the repository

    Create a feature branch

    Commit your changes

    Open a Pull Request

🔐 Security

If you discover a security issue, please report it responsibly.
Do not open public issues for security vulnerabilities.
📄 License

This project is open-sourced under the MIT License.

Laravel itself is also licensed under the MIT License.
See the LICENSE
file for details.
🙏 Acknowledgements

    Laravel Framework