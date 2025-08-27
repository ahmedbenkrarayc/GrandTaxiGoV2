# GrandTaxiGo

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-11-red)](https://laravel.com/)

GrandTaxiGo is an intercity taxi booking platform connecting passengers and drivers. Passengers can reserve rides, view history, and leave reviews, while drivers manage availability and accept bookings. The platform includes admin tools, real-time notifications, secure payments, and interactive maps for a seamless experience.

---

## Features

### User Authentication

* Register with personal information and mandatory profile photo
* Login via credentials or **Google/Facebook** (Laravel Socialite)
* Manage profile and personal data

### Booking & Trip Management

* Passengers book rides with pickup and drop-off details
* Cancel bookings before departure
* View ride history
* Filter drivers by location and availability
* Drivers accept or decline bookings
* Automated cancellation of unconfirmed bookings
* Intelligent driver availability management

### Reviews & Ratings

* Passengers rate and comment on drivers
* Drivers rate and comment on passengers
* Ratings displayed on user profiles

### Payments

* Secure online payments via **Stripe**

### Admin Dashboard

* Manage users (drivers and passengers)
* Track trips and bookings with statistics (completed, canceled rides, revenue)
* Supervise driver availability

### Real-Time Features

* Notifications on booking updates
* QR code for confirmed rides
* Real-time updates powered by **Laravel Reverb**
* Instant messaging between drivers and passengers
* Interactive map with live driver locations (Leaflet.js)

### Security & Performance

* PostgreSQL database for robustness and scalability
* Strict data validation to ensure integrity
* Caching for better performance
* SEO-friendly URLs using slugs
* Flash messages for enhanced UX

---

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/ahmedbenkrarayc/GrandTaxiGoV2.git
   ```
2. Install dependencies:

   ```bash
   composer install
   npm install
   npm run build
   ```
3. Copy `.env.example` to `.env` and configure your environment variables.
4. Generate application key:

   ```bash
   php artisan key:generate
   ```
5. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```
6. Start the local server:

   ```bash
   php artisan serve
   ```

---

## Usage

* Access the platform at `http://localhost:8000`.
* Register as a passenger or driver.
* Admins can log in to the dashboard to manage users and trips.
* Explore interactive maps, book rides, and manage notifications in real time.

---

## Technologies Used

* **Backend:** Laravel PHP Framework (v11)
* **Frontend:** Blade templates, JavaScript, Leaflet.js, Tailwindcss
* **Database:** PostgreSQL
* **Real-Time:** Laravel Reverb
* **Payments:** Stripe
* **Authentication:** Laravel Socialite (Google/Facebook)

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
