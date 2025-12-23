# 🚀 Unified Deployment Guide - Kagzi InfoTech

## ✅ Project Successfully Merged!

**Frontend (JobAway) + Admin Panel (kagzi-admin) = ONE Unified Application**

---

## 📁 Project Structure

```
kagzi-admin/ (Unified Project)
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Frontend/          ← Frontend controllers
│   │       │   ├── HomeController.php
│   │       │   ├── ProductController.php
│   │       │   ├── CheckoutController.php
│   │       │   ├── PayPalPaymentController.php
│   │       │   └── CashfreePaymentController.php
│   │       ├── ProductController.php   ← Admin product controller
│   │       ├── DashboardController.php
│   │       └── LoginController.php
│   ├── Services/
│   │   ├── Payment/               ← Payment gateway services
│   │   │   ├── CashfreeService.php
│   │   │   ├── PayPalService.php
│   │   │   └── StripeService.php
│   │   └── ProductImageSync.php
│   └── Models/
│       ├── User.php (is_admin field)
│       ├── Product.php
│       └── Purchase.php
├── resources/
│   └── views/
│       ├── frontend/              ← Frontend website views
│       │   ├── home/
│       │   ├── products/
│       │   ├── checkout/
│       │   ├── payment/
│       │   └── layouts/
│       ├── products/              ← Admin product views
│       ├── dashboard.blade.php
│       └── layouts/
│           ├── admin.blade.php    ← Admin layout
│           └── sidebar.blade.php
├── public/
│   ├── assets/                    ← Frontend assets (CSS, JS, images)
│   ├── storage → ../storage/app/public
│   └── Kagziinfotech.png
└── routes/
    ├── web.php                    ← Unified routes
    └── api.php                    ← API routes
```

---

## 🌐 URL Structure

### **Frontend (Public Website)**
```
http://yourdomain.com/                    → Home page
http://yourdomain.com/about               → About page
http://yourdomain.com/contact             → Contact page
http://yourdomain.com/products            → Product listing
http://yourdomain.com/products/{slug}     → Product details
http://yourdomain.com/checkout            → Checkout page
http://yourdomain.com/payment/success     → Payment success
http://yourdomain.com/payment/failure     → Payment failure
```

### **Admin Panel**
```
http://yourdomain.com/admin/login         → Admin login
http://yourdomain.com/admin/dashboard     → Admin dashboard
http://yourdomain.com/admin/products      → Manage products
http://yourdomain.com/admin/payments      → Payment gateways
http://yourdomain.com/admin/subscription  → Subscriptions
http://yourdomain.com/admin/contacts      → Contact messages
http://yourdomain.com/admin/sales         → Sales reports
```

---

## 🔑 Authentication System

### **Shared User Table**
- Same `users` table for both admin and regular users
- `is_admin` field determines access level

### **Login Logic**
```php
if ($user->is_admin) {
    redirect('/admin/dashboard');  // Admin users
} else {
    redirect('/');                  // Regular users
}
```

### **Access Control**
- **Admin Panel**: Protected by `auth` and `admin` middleware
- **Frontend**: Public access (no auth required for browsing)
- **Checkout**: Requires user login (regular users)

---

## 🎨 Navigation Features

### **Admin Sidebar**
✅ Added "View Website" link
- Opens frontend in new tab
- Located at bottom of sidebar with external link icon

### **Frontend Header**
✅ Added "Admin Panel" button (shows only for logged-in admins)
- Purple button in header
- Direct access to admin dashboard

---

## 💳 Payment Gateways (Unified)

### **Active Gateways**
1. **PayPal**
   - Service: `App\Services\Payment\PayPalService`
   - Controller: `App\Http\Controllers\Frontend\PayPalPaymentController`
   - Routes: `/payment/paypal/*`

2. **Cashfree**
   - Service: `App\Services\Payment\CashfreeService`
   - Controller: `App\Http\Controllers\Frontend\CashfreePaymentController`
   - Routes: `/payment/cashfree/*`

### **Configuration**
All payment credentials in `.env`:
```env
# PayPal
PAYPAL_CLIENT_ID=your_client_id
PAYPAL_SECRET=your_secret
PAYPAL_MODE=sandbox  # or live

# Cashfree
CASHFREE_APP_ID=your_app_id
CASHFREE_SECRET_KEY=your_secret
CASHFREE_ENV=TEST  # or PROD
```

---

## 📊 Database Configuration

### **Single Database**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kagzi_shared
DB_USERNAME=root
DB_PASSWORD=
```

### **Shared Tables**
- `users` - Both admin and frontend users
- `products` - Product catalog
- `pricings` - Pricing plans
- `purchases` - Customer purchases
- `subscriptions` - Active subscriptions
- `payment_gateways` - Gateway configuration
- `contacts` - Contact form submissions

---

## 🚀 Deployment Steps

### **Local Development**
```bash
cd d:/Xampp/htdocs/Kagzi/kagzi-admin

# Install dependencies (if needed)
composer install

# Create storage symlink
php artisan storage:link

# Clear all caches
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Optimize for production
php artisan optimize

# Run migrations
php artisan migrate

# Start server
php artisan serve --port=8000
```

### **Live Server Deployment**

#### 1. Upload Files
```bash
# Upload entire kagzi-admin folder to server
# Do NOT upload JobAway folder anymore
```

#### 2. Set Permissions
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod -R 775 public/storage
```

#### 3. Create Storage Symlink
```bash
php artisan storage:link
```

#### 4. Update .env
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_DATABASE=kagzi_live
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

# Update payment gateway credentials
PAYPAL_MODE=live
CASHFREE_ENV=PROD
```

#### 5. Clear Caches
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize
```

#### 6. Run Migrations
```bash
php artisan migrate --force
```

#### 7. Point Domain
- Set document root to: `/public`
- Ensure `.htaccess` exists in `/public`

---

## ✨ Key Features

### ✅ Unified Benefits
1. **Single Codebase** - Easier maintenance
2. **Single Database** - No data sync issues
3. **Single Deployment** - Deploy once for both
4. **Shared Authentication** - One user system
5. **Shared Storage** - Images accessible by both
6. **Consistent Branding** - Purple theme throughout

### ✅ Admin Features
- Full product management (CRUD)
- Payment gateway configuration
- Subscription tracking
- Contact message management
- Sales reports and analytics
- Direct frontend access via sidebar link

### ✅ Frontend Features
- Product browsing and details
- Checkout with multiple payment options
- Order tracking
- Contact form
- Admin panel access for logged-in admins

---

## 🔧 Route Names Reference

### **Frontend Routes**
```php
route('home')                           // Home page
route('about')                          // About page
route('frontend.products.showcase')     // Product listing
route('frontend.products.show', $slug)  // Product details
route('checkout')                       // Checkout page
route('payment.success')                // Payment success
route('payment.failure')                // Payment failure
route('contact.store')                  // Contact form submission
```

### **Admin Routes**
```php
route('dashboard')                      // Admin dashboard
route('products.index')                 // Product list
route('add-product')                    // Add product
route('products.edit', $id)             // Edit product
route('subscription.index')             // Subscriptions
route('contacts.index')                 // Contact messages
route('sales.dashboard')                // Sales reports
route('logout')                         // Logout
```

---

## 🐛 Troubleshooting

### **Routes Not Working**
```bash
php artisan route:clear
php artisan optimize
```

### **Views Not Found**
```bash
php artisan view:clear
```

### **Images Not Showing**
```bash
php artisan storage:link
# Check public/storage symlink exists
```

### **500 Error on Live**
```bash
# Check file permissions
chmod -R 775 storage bootstrap/cache

# Check .env configuration
# Enable debug temporarily
APP_DEBUG=true

# Check logs
tail -f storage/logs/laravel.log
```

---

## 📝 Important Notes

### **DO NOT USE JobAway Folder Anymore**
- All frontend code is now in `kagzi-admin/app/Http/Controllers/Frontend`
- All frontend views are in `kagzi-admin/resources/views/frontend`
- JobAway folder can be archived/deleted

### **Route Priority**
- Frontend routes are loaded first (/, /products, etc.)
- Admin routes are prefixed with `/admin`
- API routes are prefixed with `/api/v1`

### **Authentication**
- Admin login: `/admin/login`
- Regular users can browse frontend without login
- Checkout requires authentication

---

## ✅ Deployment Checklist

- [ ] Upload kagzi-admin folder to server
- [ ] Set file permissions (775 for storage and cache)
- [ ] Create storage symlink
- [ ] Update .env with production credentials
- [ ] Run migrations
- [ ] Clear all caches
- [ ] Test frontend homepage
- [ ] Test admin login
- [ ] Test product browsing
- [ ] Test checkout flow
- [ ] Test payment gateways
- [ ] Verify images load correctly
- [ ] Test admin → frontend navigation
- [ ] Test email notifications

---

## 🎯 Success Criteria

✅ Frontend accessible at `/`
✅ Admin panel accessible at `/admin`
✅ Single database for both
✅ Shared authentication working
✅ Payment gateways functional
✅ Product sync working
✅ Admin can view frontend
✅ No API route conflicts
✅ All caches cleared
✅ Storage symlink working

---

**🎉 Your unified application is ready for deployment!**

For support, contact: developer@kagziinfotech.com
