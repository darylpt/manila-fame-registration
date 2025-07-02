# Manila FAME Registration System (SPA)

A multi-step user registration application for the Manila FAME event, built as a single-page application using **Laravel (API)** and **Vue.js (Frontend)**. This project collects detailed participant and company information across 3 steps with proper validation and file uploads.

---

## 🛠️ Tech Stack

- **Back-End**: Laravel 12 (API)
- **Front-End**: Vue 3 with Vite
- **Styling**: Bootstrap 5
- **Database**: MySQL
- **File Uploads**: Stored via Laravel's Storage system (`public/brochures`)

---

## 🚀 Features

- 3-step registration form (Account → Company → Summary)
- State persistence between steps using Vue reactive state
- Real-time and server-side validation
- File upload support (brochure)
- REST API built in Laravel using Form Requests & database transactions
- `GET /api/countries` endpoint for country dropdown

---

## ⚙️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/darylpt/manila-fame-registration.git
cd manila-fame-registration
```

### 2. Set Up Laravel Backend

```bash
cd manila-fame-api

# Install dependencies
composer install

# Copy environment config
cp .env.example .env

# Set your DB credentials in .env
# Then generate the app key
php artisan key:generate

# Run database migrations
php artisan migrate

# Create storage symlink
php artisan storage:link

# Start Laravel server
php artisan serve
```

Or if using Laravel Sail:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan storage:link
```

### 3. Set Up Vue Frontend

```bash
cd manila-fame-frontend

# Install dependencies
npm install

# Start dev server
npm run dev
```

Vue frontend will be accessible at: [http://localhost:5174](http://localhost:5174)

---

## 🌐 API Endpoints

| Method | Endpoint            | Description                          |
|--------|---------------------|--------------------------------------|
| POST   | `/api/register`     | Submit multi-step registration       |
| GET    | `/api/countries`    | List of countries for dropdown       |

---

## 📝 Notes

- File uploads (e.g., brochure) are saved under `storage/app/public/brochures`
- Vue and Laravel run separately — CORS is configured to allow frontend access
- Form validation is handled on both frontend (basic checks) and backend (FormRequest + error response mapping)

---

## 🧪 Testing the API

Use Postman to send a `multipart/form-data` request to:

```
POST http://localhost/api/register
```

Include:
- All form fields from Step 1 & 2
- File input: `brochure_file` (optional)

---

## 📁 Folder Structure

```
manila-fame-registration/
├── api/              # Laravel backend (routes/api.php, controllers, models)
└── frontend/         # Vue.js SPA (Step1.vue, Step2.vue, Summary.vue, etc.)
```

---

## 👥 Authors

- Center for International Trade Expositions and Missions (CITEM)
- Developer: Daryl P. Thomas

---

## ✅ License

This project is proprietary and intended for internal use at CITEM.
