# نظام الأدوار والصلاحيات - Role & Permission System

## 📋 الملخص

تم إضافة نظام أدوار وصلاحيات متقدم للموقع يوفر:
- ✅ نوعا مستخدمين: **Admin** و **User**
- ✅ واجهات مختلفة لكل نوع مستخدم
- ✅ صلاحيات مختلفة لكل دور
- ✅ داشبورد متقدم للادمن

---

## 🎯 أنواع المستخدمين

### 1. Admin (المسؤول)
**الصلاحيات:**
- ✅ الوصول إلى لوحة تحكم (Dashboard)
- ✅ إدارة الطلاب (Add, Edit, Delete, View)
- ✅ إدارة المعلمين (Add, Edit, Delete, View)
- ✅ إدارة الدورات (Add, Edit, Delete, View)
- ✅ إدارة الفئات (Add, Edit, Delete, View)
- ✅ إدارة التسجيلات (Add, Edit, Delete, View)
- ✅ إدارة الدفعات (Add, Edit, Delete, View)
- ✅ عرض الإحصائيات والتقارير

**رابط الوصول:**
```
/admin/dashboard - لوحة التحكم
/admin/students - إدارة الطلاب
/admin/teachers - إدارة المعلمين
/admin/courses - إدارة الدورات
/admin/batches - إدارة الفئات
/admin/enrollments - إدارة التسجيلات
/admin/payments - إدارة الدفعات
```

### 2. User (المستخدم العادي / الطالب)
**الصلاحيات:**
- ✅ عرض الدورات المتاحة
- ✅ التسجيل في الدورات
- ✅ عرض التسجيلات الخاصة به
- ✅ عرض ملفه الشخصي

**رابط الوصول:**
```
/user/courses - الدورات المتاحة
/user/enrollments - تسجيلاتي
```

---

## 🗄️ قاعدة البيانات

### إضافة حقل `role` إلى جدول `users`

**Migration File:**
```php
database/migrations/2026_04_13_000000_add_role_to_users_table.php
```

**الحقل المضاف:**
```php
$table->enum('role', ['user', 'admin'])->default('user')->after('password');
```

**القيم الممكنة:**
- `user` - مستخدم عادي (افتراضي للمستخدمين الجدد)
- `admin` - مسؤول النظام

---

## 🔒 Middleware - الحماية

### 1. IsAdmin Middleware
```php
app/Http/Middleware/IsAdmin.php
```
**الوظيفة:** التحقق من أن المستخدم من نوع Admin

### 2. IsUser Middleware
```php
app/Http/Middleware/IsUser.php
```
**الوظيفة:** التحقق من أن المستخدم من نوع User

**الاستخدام في Routes:**
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes
});

Route::middleware(['auth', 'user'])->group(function () {
    // User routes
});
```

---

## 🗂️ الملفات الجديدة

### Controllers
```
app/Http/Controllers/DashboardController.php - لوحة تحكم الادمن
```

### Middleware
```
app/Http/Middleware/IsAdmin.php - التحقق من Admin
app/Http/Middleware/IsUser.php - التحقق من User
```

### Views
```
resources/views/admin/dashboard.blade.php - لوحة تحكم الادمن
resources/views/user/courses.blade.php - صفحة الدورات للمستخدم
resources/views/user/enrollments.blade.php - صفحة التسجيلات للمستخدم
```

### Migrations
```
database/migrations/2026_04_13_000000_add_role_to_users_table.php
```

---

## 📊 لوحة التحكم - Admin Dashboard

**الموقع:**
```
/admin/dashboard
```

**المزايا:**
- 📈 إحصائيات شاملة للنظام:
  - عدد الطلاب
  - عدد المعلمين
  - عدد الدورات
  - عدد الفئات
  - عدد التسجيلات
  - عدد الدفعات
  - إجمالي الإيرادات
  
- 📋 جدول أحدث الدفعات (آخر 5)
- 📝 جدول أحدث التسجيلات (آخر 5)
- 🔗 روابط سريعة للإدارة

**Screenshots:**
```
┌─────────────────────────────────────────┐
│  Admin Dashboard                        │
├─────────────────────────────────────────┤
│ □ 150 Students   □ 25 Teachers         │
│ □ 18 Courses     □ 32 Batches          │
│ □ 456 Enrollments □ $12,450 Revenue    │
├─────────────────────────────────────────┤
│ Recent Payments          Recent Enrollments
│ ┌──────────────────┐    ┌────────────────┐
│ │ Payment #1       │    │ Enrollment #1  │
│ │ $99.99           │    │ Batch 5        │
│ └──────────────────┘    └────────────────┘
└─────────────────────────────────────────┘
```

---

## 🔐 التسجيل والدخول

### عند التسجيل (Register)
```php
// يتم تعيين الدور تلقائياً كـ 'user'
'role' => 'user'
```

### عند الدخول (Login)
```php
// يتم التحقق من الدور وإعادة توجيه المستخدم لصفحته:
- Admin → /admin/dashboard
- User → /user/courses
```

### عند الخروج (Logout)
```php
// يتم تسجيل خروج المستخدم وحذف الجلسة
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```

---

## 🧭 تحديث الـ Navigation Bar

**الـ Navbar يتغير بناءً على الدور:**

### عندما يكون المستخدم Admin:
```
📊 Dashboard | 👥 Students | 👨‍🏫 Teachers | 📚 Courses | 📦 Batches | ✅ Enrollments | 💳 Payments | 👤 Profile
```

### عندما يكون المستخدم User:
```
📚 Available Courses | ✅ My Enrollments | 👤 Profile
```

### بدون تسجيل دخول:
```
🔑 Login
```

---

## ⚙️ كيفية الاستخدام

### للمسؤول (Admin):

1. **الدخول:**
   ```
   Email: admin@example.com
   Password: (كلمة المرور)
   Role: admin
   ```

2. **الوصول إلى لوحة التحكم:**
   ```
   URL: http://localhost/studentManagement/admin/dashboard
   ```

3. **إدارة الموارد:**
   ```
   - الطلاب: /admin/students
   - المعلمين: /admin/teachers
   - الدورات: /admin/courses
   - إلخ...
   ```

### للمستخدم العادي (User):

1. **التسجيل:**
   ```
   اضغط على "Register"
   أدخل البيانات
   سيتم تعيين الدور تلقائياً كـ "user"
   ```

2. **الدخول:**
   ```
   Email: user@example.com
   Password: (كلمة المرور)
   Role: user
   ```

3. **الوصول للدورات:**
   ```
   URL: http://localhost/studentManagement/user/courses
   ```

---

## 🚀 المميزات المستقبلية

### المرحلة القادمة:
- [ ] صفحة الملف الشخصي (Profile)
- [ ] تحديث بيانات الملف الشخصي
- [ ] إعدادات الحساب
- [ ] نظام الإشعارات
- [ ] نظام التقييمات (Rating System)
- [ ] شهادات إكمال الدورات
- [ ] نظام الرسائل (Messaging)

---

## 📝 ملخص التغييرات

### Files Modified:
1. ✅ `app/Models/User.php` - إضافة 'role' إلى fillable
2. ✅ `routes/web.php` - إضافة middleware و routes جديدة
3. ✅ `resources/views/layout.blade.php` - تحديث navbar

### Files Created:
1. ✅ `app/Http/Middleware/IsAdmin.php`
2. ✅ `app/Http/Middleware/IsUser.php`
3. ✅ `app/Http/Controllers/DashboardController.php`
4. ✅ `resources/views/admin/dashboard.blade.php`
5. ✅ `resources/views/user/courses.blade.php`
6. ✅ `resources/views/user/enrollments.blade.php`
7. ✅ `database/migrations/2026_04_13_000000_add_role_to_users_table.php`

---

## ✨ الخطوات التالية

### 1. تشغيل Migration:
```bash
php artisan migrate
```

### 2. إنشاء مستخدم Admin:
```bash
php artisan tinker
User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => Hash::make('password'), 'role' => 'admin'])
```

### 3. اختبار النظام:
- ✅ الدخول كـ Admin والوصول لـ Dashboard
- ✅ الدخول كـ User والوصول للدورات
- ✅ اختبار الخروج (Logout)

---

**النظام جاهز للاستخدام! 🎉**
