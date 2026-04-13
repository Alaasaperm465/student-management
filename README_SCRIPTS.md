# Laravel Blade Template Update Scripts
## دليل الاستخدام الشامل

تم إنشاء 3 scripts لتحديث ملفات Blade templates تلقائياً:

---

## 📋 الملفات المُنشأة

### 1. `update_blade_templates.py` - Python Script
**النظام المدعوم:** Windows, Linux, macOS  
**المتطلبات:** Python 3.6+

#### الاستخدام الأساسي:
```bash
python update_blade_templates.py
```

#### الخيارات المتقدمة:
```python
# في أعلى الـ script:
PROJECT_PATH = r"c:\xampp\htdocs\studentManagement"
DRY_RUN = False  # Set to True للمعاينة بدون تعديل
```

#### مميزات Python Script:
✅ معالجة قوية للأخطاء  
✅ رسائل تفصيلية وواضحة  
✅ دعم الترميز UTF-8 كاملاً  
✅ سهولة التوسع والتعديل  

---

### 2. `update_blade_templates.ps1` - PowerShell Script
**النظام المدعوم:** Windows  
**المتطلبات:** PowerShell 5.1+

#### الاستخدام الأساسي:
```powershell
.\update_blade_templates.ps1 -ProjectPath "c:\xampp\htdocs\studentManagement"
```

#### مع Dry Run:
```powershell
.\update_blade_templates.ps1 -ProjectPath "c:\xampp\htdocs\studentManagement" -DryRun $true
```

#### ملاحظات مهمة:
- قد تحتاج لتنفيذ: `Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser`
- الـ script يعرض ألوان جميلة للمخرجات
- معالجة كاملة للأحرف الخاصة والعربية

---

### 3. `update_blade_templates.sh` - Bash Script
**النظام المدعوم:** Linux, macOS  
**المتطلبات:** Bash 4.0+, sed, grep

#### الاستخدام الأساسي:
```bash
bash update_blade_templates.sh /var/www/studentManagement
```

#### الاستخدام الافتراضي (المجلد الحالي):
```bash
bash update_blade_templates.sh
```

---

## 🔄 ما يفعله الـ Script؟

### المهام المنفذة تلقائياً:

1. **البحث عن الملفات:**
   - يبحث عن جميع ملفات `*.blade.php` في مجلد views
   - يحدد الملفات التي تستخدم `@extends('layout.header')`

2. **استخراج المعلومات:**
   - استخراج عنوان الصفحة من `@section('title')`
   - استخراج محتوى الصفحة الرئيسي
   - الحفاظ على جميع المنطق والتحكم

3. **تحديث البنية:**
   ```blade
   @extends('layout')              {{-- تغيير من layout.header إلى layout --}}
   @section('title', 'Page Title') {{-- إضافة title section --}}
   @section('content')             {{-- wrap في content section --}}
   <div class="container mt-4">    {{-- إضافة container --}}
       <div class="page-header">   {{-- إضافة page header --}}
   ```

4. **تحديث الـ Icons:**
   - `bi bi-pencil` → `fas fa-edit`
   - `bi bi-trash` → `fas fa-trash-alt`
   - `bi bi-plus` → `fas fa-plus`
   - `bi bi-eye` → `fas fa-eye`
   - وغيرها...

5. **تحديث الأزرار:**
   - إضافة `btn btn-primary` للأزرار التي تفتقدها
   - ضمان التوافق مع Bootstrap

---

## 📊 مثال على التحويل

### قبل التحديث:
```blade
@extends('layout.header')

@section('title', 'قائمة الطلاب')

<table class="table">
    <tr>
        <td>الاسم</td>
        <td>
            <button type="submit">
                <i class="bi bi-pencil"></i> تعديل
            </button>
        </td>
    </tr>
</table>
```

### بعد التحديث:
```blade
@extends('layout')

@section('title', 'قائمة الطلاب')

@section('content')
<div class="container mt-4">
    {{-- Page Header --}}
    <div class="page-header mb-4">
        <h1 class="page-title">قائمة الطلاب</h1>
        <hr>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
        <table class="table">
            <tr>
                <td>الاسم</td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> تعديل
                    </button>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection
```

---

## 🛠️ التخصيص والتوسع

### إضافة أيقونات جديدة:

**Python:**
```python
self.icon_mapping = {
    r'bi\s+bi-new-icon': 'fas fa-new-icon',
    # أضف أكثر هنا...
}
```

**PowerShell:**
```powershell
$IconMappings = @{
    'bi\s+bi-new-icon' = 'fas fa-new-icon'
    # أضف أكثر هنا...
}
```

### تخصيص قالب الصفحة:

تعديل دالة `generate_new_template()` أو `New-BladeTemplate` مباشرة في الـ script

---

## ⚠️ نصائح مهمة

### قبل التشغيل:
1. ✅ **عمل Backup** للملفات قبل تشغيل الـ script
   ```bash
   # Windows
   xcopy resources\views resources\views.backup /E /I /Y
   
   # Linux/macOS
   cp -r resources/views resources/views.backup
   ```

2. ✅ التحقق من أن جميع الملفات `.blade.php` بصيغة UTF-8

3. ✅ التأكد من وجود مجلد `resources/views` بالكامل

### بعد التشغيل:
1. ✅ تفعيل الموقع والتحقق من الصفحات
2. ✅ اختبار جميع النماذج والأزرار
3. ✅ التحقق من عرض الأيقونات بشكل صحيح
4. ✅ اختبار على متصفحات مختلفة

---

## 🐛 معالجة الأخطاء

### إذا حدث خطأ:

**Python:**
```
❌ Failed to update resources/views/students/index.blade.php: ...
```

**PowerShell:**
```
❌ Failed: index.blade.php - ...
```

**Bash:**
```
❌ Failed: index.blade.php
```

تحقق من:
- صلاحيات الملفات (permissions)
- ترميز الملف (يجب أن يكون UTF-8)
- عدم وجود أخطاء صيغة في Blade syntax

---

## 📝 المتطلبات الإضافية

للتأكد من أن الـ Layout الموحد يعمل بشكل صحيح:

### تأكد من وجود:
```blade
{{-- resources/views/layout.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    {{-- Font Awesome icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @yield('content')
    {{-- JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

---

## 💡 أمثلة الاستخدام الشامل

### السيناريو 1: تشغيل سريع (Python)
```bash
cd c:\xampp\htdocs\studentManagement
python update_blade_templates.py
```

### السيناريو 2: معاينة بدون تعديل (PowerShell)
```powershell
cd c:\xampp\htdocs\studentManagement
.\update_blade_templates.ps1 -DryRun $true
```

### السيناريو 3: تشغيل مع Backup (Bash)
```bash
cd /var/www/studentManagement
cp -r resources/views resources/views.backup
bash update_blade_templates.sh
```

---

## ✅ قائمة التحقق النهائية

- [ ] عمل backup للملفات
- [ ] اختيار الـ script المناسب لنظام التشغيل
- [ ] تشغيل الـ script
- [ ] التحقق من رسائل النجاح
- [ ] اختبار الموقع في المتصفح
- [ ] التحقق من جميع الأيقونات
- [ ] اختبار جميع النماذج والأزرار
- [ ] حذف الـ backup إذا كان كل شيء بخير

---

## 📞 للمساعدة

إذا واجهت مشاكل:
1. تحقق من رسالة الخطأ المفصلة
2. تأكد من صيغة الملفات (UTF-8)
3. تحقق من صلاحيات الملفات
4. جرب تشغيل الـ script من جديد بعد حل المشكلة

---

**آخر تحديث:** 2026-04-13  
**الإصدار:** 1.0
