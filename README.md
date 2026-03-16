# Koperasi Simpan Pinjam (KSP) Modern

A comprehensive Savings and Loan Cooperative management system built with **Laravel 12**, **PHP 8.3**, and **Tailwind CSS 4.0**. This system features a premium, modern UI with glassmorphism elements and a robust double-entry bookkeeping engine.

## 🚀 Features

- **Modern Dashboard**: Visual overview of cooperative performance with high-end statistics cards.
- **Member Management**: Complete profile tracking for cooperative members.
- **Savings System**: Support for multiple saving types (Pokok, Wajib, Sukarela) with interest calculation.
- **Loan Management**: Full loan lifecycle from application and approval to disbursement and repayment.
- **Accounting Engine**: Integrated Double-Entry Bookkeeping (General Ledger) for financial integrity.
- **Secure Authentication**: Built-in modern login/logout system with route protection.

## 🛠 Tech Stack

- **Framework**: [Laravel 12](https://laravel.com)
- **Language**: PHP 8.3
- **Styling**: [Tailwind CSS](https://tailwindcss.com) (Modern Design)
- **Database**: MySQL
- **Assets**: Blade Components

## 📦 Installation

1. **Clone the repository**
   ```bash
   git clone git@github.com:hasanarofid/koperasi-simpan-pinjam.git
   cd koperasi-simpan-pinjam
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Update your `.env` with your MySQL database credentials.*

4. **Run Migrations & Seeds**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start Development Server**
   ```bash
   php artisan serve --port=8001
   ```

## 🔐 Credentials

- **Admin Login**: `admin@ksp.com`
- **Password**: `password`

## 👨‍💻 Developer Information

Developed by **hasanarofid**.
Visit my website: [hasanarofid.site](https://hasanarofid.site)

---
© 2026 KSP Modern. Built for financial excellence.
