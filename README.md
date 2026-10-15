# URL Shortener

A role-based URL shortening service built with **Laravel 12**, **Bootstrap 5**, and **DataTables**. Three roles — **SuperAdmin**, **Admin**, **Member** — each with scoped dashboards, company isolation, and searchable / exportable tables.

---

## Features

### 🔴 SuperAdmin
- Global counters: Companies, Admins, Members, Short URLs, Total Hits
- **Companies** — add (unique name) + list all
- **Invite** — send Admin / Member invites to any company with WhatsApp share link
- **Short URLs** — global view with search, sort, CSV / Excel export

### 🔵 Admin
- Scoped to their own company
- Counters: Admins, Members, Short URLs, Hits
- **Company** — list all users in own company
- **Invite** — add Admin / Member to own company (WhatsApp share)
- **Short URLs** — generate + list only own-company URLs

### 🟢 Member
- Scoped to themselves
- Counters: My URLs, Total Hits, Created Today, This Month
- **Short URLs** — generate + list only own URLs

### 🔐 Authentication & Authorization
- Email + password login with role-based redirection
- Toast notifications for success / error
- Custom `role` middleware for route protection
- Only **one SuperAdmin** allowed (model-level guard)

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Database | MySQL 5.7+ / 8.x |
| Frontend | Bootstrap 5.3 (CDN) |
| Tables | DataTables + Buttons (CSV / Excel export) |

---

## Requirements

- PHP **8.2+** with extensions: `openssl`, `pdo`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- Composer 2.x
- MySQL 5.7+ or 8.x

---

## Installation

```bash
git clone https://github.com/TheAkshayJangid/url-shortener.git
cd url-shortener
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=SuperAdminSeeder
php artisan serve

Open http://127.0.0.1:8000 and log in with:

Role	Email	Password
SuperAdmin	superadmin@example.com	password
