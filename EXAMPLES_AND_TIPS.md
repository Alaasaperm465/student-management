# أمثلة عملية وحالات الاستخدام

## المحتويات
- [أمثلة الملفات قبل وبعد](#أمثلة-الملفات-قبل-وبعد)
- [حالات استخدام شاملة](#حالات-استخدام-شاملة)
- [نصائح وحيل مفيدة](#نصائح-وحيل-مفيدة)

---

## أمثلة الملفات قبل وبعد

### مثال 1: صفحة قائمة الطلاب

#### ❌ قبل التحديث
```blade
@extends('layout.header')

@section('title', 'قائمة الطلاب')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3>جميع الطلاب</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> تعديل
                            </a>
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> عرض
                            </a>
                            <form method="POST" action="{{ route('students.destroy', $student->id) }}" style="display:inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                    <i class="bi bi-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
```

#### ✅ بعد التحديث
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>جميع الطلاب</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>الرقم</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> عرض
                                    </a>
                                    <form method="POST" action="{{ route('students.destroy', $student->id) }}" style="display:inline;">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

### مثال 2: نموذج إنشاء مادة دراسية

#### ❌ قبل التحديث
```blade
@extends('layout.header')

@section('title')
تحديث الفصل الدراسي
@endsection

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h2>تحديث الفصل الدراسي</h2>
                
                <div class="form-group">
                    <label for="name">اسم الفصل</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ $batch->name }}" required>
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="course_id">المادة الدراسية</label>
                    <select class="form-control @error('course_id') is-invalid @enderror" 
                            id="course_id" name="course_id" required>
                        <option value="">-- اختر المادة --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="start_date">تاريخ البداية</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                           id="start_date" name="start_date" value="{{ $batch->start_date }}" required>
                    @error('start_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> حفظ التعديلات
                    </button>
                    <a href="{{ route('batches.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> رجوع
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
```

#### ✅ بعد التحديث
```blade
@extends('layout')

@section('title', 'تحديث الفصل الدراسي')

@section('content')
<div class="container mt-4">
    {{-- Page Header --}}
    <div class="page-header mb-4">
        <h1 class="page-title">تحديث الفصل الدراسي</h1>
        <hr>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="name">اسم الفصل</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ $batch->name }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="course_id">المادة الدراسية</label>
                        <select class="form-control @error('course_id') is-invalid @enderror" 
                                id="course_id" name="course_id" required>
                            <option value="">-- اختر المادة --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="start_date">تاريخ البداية</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                               id="start_date" name="start_date" value="{{ $batch->start_date }}" required>
                        @error('start_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> حفظ التعديلات
                        </button>
                        <a href="{{ route('batches.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## حالات استخدام شاملة

### حالة 1: تحديث كل المشروع

```bash
# Step 1: إنشاء backup
cp -r c:\xampp\htdocs\studentManagement\resources\views c:\xampp\htdocs\studentManagement\resources\views.backup

# Step 2: تشغيل Python script
cd c:\xampp\htdocs\studentManagement
python update_blade_templates.py

# Step 3: التحقق
# فتح الموقع واختبار الصفحات المختلفة

# Step 4: إذا حدث خطأ، الاستعادة
cp -r c:\xampp\htdocs\studentManagement\resources\views.backup c:\xampp\htdocs\studentManagement\resources\views
```

### حالة 2: تحديث ملف واحد فقط

يمكنك تعديل السكريبت لمعالجة ملف واحد:

```python
# في نهاية السكريبت:
if __name__ == "__main__":
    updater = BladeTemplateUpdater(PROJECT_PATH)
    # لملف واحد:
    success, msg = updater.process_file(Path(PROJECT_PATH) / "resources/views/students/index.blade.php")
    print(msg)
```

### حالة 3: تحديث مجموعة معينة من الملفات

```python
# تعديل الـ run method:
def run_selective(self, file_patterns):
    """معالجة ملفات محددة فقط"""
    for pattern in file_patterns:
        matching_files = list(self.views_path.glob(pattern))
        for file in matching_files:
            success, msg = self.process_file(file)
            print(msg)

# الاستخدام:
updater.run_selective([
    "students/*.blade.php",
    "teachers/*.blade.php"
])
```

---

## نصائح وحيل مفيدة

### ✅ نصيحة 1: معاينة التغييرات

```python
# تعديل السكريبت لإظهار الفرق:
def preview_changes(self, file_path):
    """عرض الفروقات قبل التحديث"""
    with open(file_path, 'r') as f:
        original = f.read()
    
    # معالجة
    new = self.process_and_generate(original)
    
    # عرض الفرق
    import difflib
    diff = difflib.unified_diff(
        original.splitlines(),
        new.splitlines(),
        lineterm=''
    )
    print('\n'.join(diff))
```

### ✅ نصيحة 2: إضافة تسجيل مفصل

```python
import logging

logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('blade_update.log'),
        logging.StreamHandler()
    ]
)

logger = logging.getLogger(__name__)
logger.info(f"Starting update of {file}")
```

### ✅ نصيحة 3: التحقق من الصيغة البلاد

```python
def validate_blade_syntax(content):
    """التحقق من أن الـ Blade صحيح"""
    validators = [
        (r'@if\s*\(', r'@endif'),  # التحقق من @if/@endif
        (r'@foreach\s*\(', r'@endforeach'),  # التحقق من @foreach/@endforeach
        (r'@section\s*\(', r'@endsection'),  # التحقق من @section/@endsection
    ]
    
    for start, end in validators:
        open_count = len(re.findall(start, content))
        close_count = len(re.findall(end, content))
        if open_count != close_count:
            return False, f"Unmatched {start}"
    
    return True, "Valid"
```

### ✅ نصيحة 4: التعامل مع الأخطاء الشائعة

```python
# معالجة الأخطاء الشائعة
common_issues = {
    'bi bi-archive': 'fas fa-archive',
    'bi bi-activity': 'fas fa-heartbeat',
    'bi bi-bootstrap-fill': 'fas fa-cube',
}

# إضافتها للـ mapping الأساسي
self.icon_mapping.update(common_issues)
```

### ✅ نصيحة 5: توليد تقرير شامل

```python
def generate_report(self):
    """توليد تقرير HTML للمحدثات"""
    report = f"""
    <html>
    <head><title>تقرير التحديثات</title></head>
    <body>
        <h1>تقرير تحديث Blade Templates</h1>
        <p>الملفات المحدثة: {len(self.updated_files)}</p>
        <p>الملفات الفاشلة: {len(self.failed_files)}</p>
        <ul>
        {''.join(f'<li>{f}</li>' for f in self.updated_files)}
        </ul>
    </body>
    </html>
    """
    with open('update_report.html', 'w') as f:
        f.write(report)
```

---

## أسئلة شائعة

### س: ماذا لو كان لدي custom layout مختلف؟
**ج:** عدّل `generate_new_template()` أو `New-BladeTemplate` لتطابق هيكل custom layout

### س: كيف أتعامل مع ملفات غير متوافقة؟
**ج:** استخدم `try-except` و skip الملفات غير المتوافقة مع تسجيل رسالة خطأ

### س: هل يمكن تشغيل الـ script على فترات منتظمة؟
**ج:** نعم، استخدم Cron Job (Linux) أو Task Scheduler (Windows)

### س: كيف أعكس التغييرات إذا حدث خطأ؟
**ج:** لديك backup الملفات الأصلية، استعد استخدام `git checkout` أو استعادة الـ backup

---

**نصيحة ذهبية:** 🌟
> اختبر الـ Script أولاً على عينة صغيرة من الملفات (2-3 ملفات) قبل تشغيله على المشروع كاملاً

---

**آخر تحديث:** 2026-04-13
