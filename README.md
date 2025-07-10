# 🎨 Art Gallery – Online Artwork Selling Platform

The **Art Gallery** project is a full-featured web platform for selling, uploading, and managing artworks. It offers separate portals for **admins**, **sellers**, and **customers**, enabling a streamlined experience for digital art commerce.

---

## 🌟 Features

### 🛒 Frontend (Customer)
- Browse and view artworks by category
- Add items to cart and proceed to checkout
- View single product details
- Responsive design with modern UI

### 🧑‍🎨 Seller Dashboard
- Seller login and authentication
- Upload and manage artworks
- View invoices and orders
- Track sales and customer requests

### 🧑‍💼 Admin Panel
- Manage users and sellers
- Approve or reject artwork submissions
- View all artworks and categories
- Manage orders and platform settings

---

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3 (Custom & Bootstrap), JavaScript
- **Backend**: PHP (Core PHP, no frameworks)
- **Database**: MySQL (artwork.sql & swiss_collection.sql)
- **Assets**: Font Awesome, SVGs, custom icons
- **Server**: Apache via XAMPP (recommended)

---

## 📁 Folder Structure

```plaintext
├── adminView/              # Admin dashboard views
├── sellerView/             # Seller dashboard views
├── assets/                 # CSS, JS, and image files
├── controller/             # PHP scripts for DB actions
├── include/                # Header, footer, sidebar, etc.
├── DB/                     # SQL dump files
├── uploads/                # Uploaded artwork images
├── index.php               # Homepage
├── checkout.php            # Checkout process
├── login.php               # User login
├── admin-login.php         # Admin login
└── config/dbconnect.php    # DB connection settings
