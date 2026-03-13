# 🚀 Portfolio App

A full-stack personal portfolio application built with **Laravel 12** and **Tailwind CSS**. Features a dark blue aesthetic, dynamic content management via an admin dashboard, and full authentication with single-admin access control.

---

## ✨ Features

- **Public Portfolio** — Showcase projects, skills, and contact info to visitors
- **Admin Dashboard** — Add, edit, and delete projects and skills via a secure panel
- **Single-Admin Access** — Only one designated email can access the dashboard
- **Dark Blue UI** — Custom black-blue design system with Playfair Display + DM Sans fonts
- **Fully Responsive** — Mobile-friendly nav with hamburger menu
- **Image Uploads** — Project thumbnails stored in Laravel's public disk
- **Contact Form** — Visitors can send messages directly from the site
- **Email Verification** — Built-in Laravel verification flow
- **Password Reset** — Full forgot/reset password flow

---

## 🛠 Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12 (PHP 8.4) |
| Frontend | Blade Templates + Tailwind CSS CDN |
| Database | MySQL |
| Auth | Laravel Breeze (customised) |
| Storage | Laravel public disk (local) |
| Fonts | Google Fonts (Playfair Display, DM Sans) |

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php          # Public home page
│   │   ├── SkillController.php         # Skills CRUD
│   │   ├── PortfolioController.php     # Projects CRUD + image upload
│   │   ├── ContactController.php       # Contact form
│   │   └── DashboardController.php     # Admin dashboard
│   └── Middleware/
│       └── AdminMiddleware.php         # Restricts dashboard to admin only
├── Models/
│   ├── User.php
│   ├── Skill.php
│   └── Portfolio.php
config/
└── admin.php                           # Admin email config
resources/views/
├── layouts/
│   └── app.blade.php                   # Master layout (nav + footer)
├── admin/
│   ├── dashboard.blade.php             # Admin dashboard
│   ├── skill-edit.blade.php            # Edit skill form
│   └── portfolio-edit.blade.php        # Edit project form
├── auth/
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   ├── confirm-password.blade.php
│   └── verify-email.blade.php
├── home.blade.php                      # Hero + services + featured projects
├── skills.blade.php                    # Skills grid with filter tabs
├── portfolio.blade.php                 # Projects grid with filter tabs
└── contact.blade.php                   # Contact form
routes/
└── web.php                             # All application routes
```

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/my-portfolio-app.git
cd my-portfolio-app
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install && npm run build
```

### 4. Set up environment

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure `.env`

```env
APP_NAME="Portfolio"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my-portfolio-app
DB_USERNAME=root
DB_PASSWORD=

# Admin — only this email can access the dashboard
ADMIN_EMAIL=your@email.com

# Owner name shown in hero section (when not logged in)
APP_OWNER_NAME="Your Name"

# Mail (use 'log' for local dev — check storage/logs/laravel.log)
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@yourportfolio.com
MAIL_FROM_NAME="Portfolio"
```

### 6. Run migrations

```bash
php artisan migrate
```

### 7. Create storage symlink (for image uploads)

```bash
php artisan storage:link
```

### 8. Start the development server

```bash
php artisan serve
```

Visit **http://127.0.0.1:8000**

---

## 🔐 Admin Access

Only one admin account can access the dashboard. To set it up:

1. Add your email to `.env`:
   ```env
   ADMIN_EMAIL=your@email.com
   ```

2. Register an account at `/register` using that exact email.

3. Log in at `/login` — you'll be redirected to `/dashboard`.

> Any other account that tries to log in will be immediately logged out and shown an "unauthorised" error.

### Register the middleware alias

In `bootstrap/app.php`, add inside `withMiddleware`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

---

## 🗄 Database Schema

### `skills` table

| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| name | varchar | Skill name |
| level | varchar | Beginner / Intermediate / Advanced / Expert |
| category | varchar | e.g. Frontend, Backend, DevOps |
| years_exp | tinyint | Years of experience |
| created_at | timestamp | |
| updated_at | timestamp | |

### `portfolios` table

| Column | Type | Notes |
|---|---|---|
| id | bigint | Primary key |
| title | varchar | Project title |
| description | text | Project description |
| link | varchar | Live URL |
| github | varchar | GitHub URL |
| category | varchar | Web App / UI-UX / API / Mobile |
| tech_stack | varchar | Comma-separated e.g. "Laravel, Vue, MySQL" |
| image | varchar | Path in storage/app/public/portfolio/ |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 🛣 Routes

### Public

| Method | URI | Description |
|---|---|---|
| GET | `/` | Home page |
| GET | `/skills` | Skills page |
| GET | `/portfolio` | Portfolio page |
| GET | `/contact` | Contact form |
| POST | `/contact` | Submit contact form |

### Auth

| Method | URI | Description |
|---|---|---|
| GET | `/login` | Login page |
| GET | `/register` | Register page |
| GET | `/forgot-password` | Forgot password |
| POST | `/forgot-password` | Send reset link |
| GET | `/reset-password/{token}` | Reset password form |
| POST | `/reset-password` | Submit new password |

### Admin (requires `auth` + `admin` middleware)

| Method | URI | Description |
|---|---|---|
| GET | `/dashboard` | Admin dashboard |
| POST | `/skills` | Add new skill |
| GET | `/skills/{id}/edit` | Edit skill form |
| PUT | `/skills/{id}` | Update skill |
| DELETE | `/skills/{id}` | Delete skill |
| POST | `/portfolio` | Add new project |
| GET | `/portfolio/{id}/edit` | Edit project form |
| PUT | `/portfolio/{id}` | Update project |
| DELETE | `/portfolio/{id}` | Delete project |

---

## 📧 Contact Form

The contact form validates and stores messages. To also send emails, configure your mail driver in `.env` and update `ContactController::store()`:

```php
// Uncomment after configuring MAIL_* in .env
Mail::to(config('mail.from.address'))->send(new ContactMail($validated));
```

---

## 🖼 Image Uploads

Project images are stored at `storage/app/public/portfolio/` and served via the symlink at `public/storage/`. Make sure to run:

```bash
php artisan storage:link
```

Max upload size is **2MB** (jpg, jpeg, png, webp).

---

## 🧹 Useful Commands

```bash
# Clear all caches
php artisan optimize:clear

# Re-run migrations fresh
php artisan migrate:fresh

# Create a new migration
php artisan make:migration add_column_to_table --table=table_name

# Run specific migration
php artisan migrate
```

---

## 📸 Pages Overview

| Page | Description |
|---|---|
| **Home** | Hero with typewriter effect, services, featured projects, testimonials |
| **Skills** | Filterable skill cards with animated progress bars |
| **Portfolio** | Filterable project cards with Live Demo + GitHub links |
| **Contact** | Contact form with validation + contact info sidebar |
| **Dashboard** | Admin panel to manage projects and skills |

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

<div align="center">
  Built with ❤️ using <strong>Laravel</strong> &amp; <strong>Tailwind CSS</strong>
</div>
