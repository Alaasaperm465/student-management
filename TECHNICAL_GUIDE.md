# دليل فني متقدم لـ Blade Template Update Scripts

## محتويات الدليل
- [البنية المعمارية للـ Scripts](#البنية-المعمارية)
- [آلية عمل كل Script](#آلية-عمل-الـ-scripts)
- [معالجة الأخطاء والاستثناءات](#معالجة-الأخطاء)
- [التكامل مع CI/CD](#التكامل-مع-cicd)
- [الأداء والتحسينات](#الأداء-والتحسينات)

---

## البنية المعمارية

### معمارية Python Script
```
update_blade_templates.py
│
├── Class: BladeTemplateUpdater
│   ├── __init__(base_path)           → تهيئة المسارات والإعدادات
│   ├── find_blade_files()            → البحث عن جميع الـ .blade.php
│   ├── find_old_layout_files()       → تحديد الملفات القديمة
│   ├── extract_page_title()          → استخراج العنوان
│   ├── extract_page_content()        → استخراج المحتوى
│   ├── replace_bootstrap_icons()     → تحويل الأيقونات
│   ├── update_button_styles()        → تحديث الأزرار
│   ├── generate_new_template()       → إنشاء القالب الجديد
│   └── process_file()                → معالجة ملف واحد
│
└── main()                             → نقطة الدخول الرئيسية
```

### معمارية PowerShell Script
```
update_blade_templates.ps1
│
├── Configuration Variables
│   ├── $ProjectPath
│   ├── $ViewsPath
│   └── $IconMappings (Hashtable)
│
├── Helper Functions
│   ├── Write-Header()
│   ├── Write-Success()
│   ├── Get-FileTitle()
│   ├── Get-PageContent()
│   ├── Replace-BootstrapIcons()
│   ├── Update-ButtonStyles()
│   ├── Indent-Content()
│   ├── New-BladeTemplate()
│   └── Update-BladeFile()
│
└── Main Logic
    ├── Validation
    ├── File Discovery
    ├── Processing Loop
    └── Summary Report
```

---

## آلية عمل الـ Scripts

### المرحلة الأولى: البحث والاكتشاف

```python
# Python: استخدام pathlib للبحث المتقدم
blade_files = list(self.views_path.rglob("*.blade.php"))
```

```powershell
# PowerShell: البحث المتكرر
$bladeFiles = Get-ChildItem -Path $ViewsPath -Filter "*.blade.php" -Recurse
```

```bash
# Bash: استخدام find
find "$VIEWS_PATH" -name "*.blade.php" -type f
```

### المرحلة الثانية: التحقق من الملفات القديمة

**البحث عن النمط:**
```
@extends('layout.header')
@extends("layout.header")
```

**التطبيق:**
```python
if "@extends('layout.header')" in content or '@extends("layout.header")' in content:
    old_layout_files.append(file)
```

### المرحلة الثالثة: استخراج المعلومات

#### استخراج العنوان:
```regex
@section\s*\(\s*['\"]title['\"]\s*\)\s*(.*?)\s*@endsection
```

#### استخراج المحتوى:
- حذف `@extends('layout.header')`
- حذف `@section('title') ... @endsection`
- الحفاظ على كل محتوى آخر

### المرحلة الرابعة: تحويل الأيقونات

**مثال من التحويل:**
```
البحث:  class="bi bi-pencil"
الاستبدال: class="fas fa-edit"
```

**التطبيق المتقدم:**
```python
# معالجة عدة صيغ
content = re.sub(
    f'class="([^"]*){pattern}([^"]*)"',
    f'class="\\1{replacement}\\2"',
    content
)
```

---

## معالجة الأخطاء

### مستويات الأخطاء

| المستوى | الوصف | الإجراء |
|-------|-------|--------|
| CRITICAL | فشل عام في النظام | إيقاف التنفيذ |
| ERROR | فشل معالجة ملف واحد | تخطي الملف وغيره |
| WARNING | مشكلة في ترميز أو صيغة | تسجيل وحذر |
| INFO | عملية عادية | تسجيل فقط |

### أمثلة معالجة الأخطاء

#### Python:
```python
try:
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
except UnicodeDecodeError:
    return False, f"❌ File encoding error: {file_path}"
except IOError as e:
    return False, f"❌ Cannot read file: {e}"
```

#### PowerShell:
```powershell
try {
    $content = Get-Content -Path $file -Raw -Encoding UTF8
}
catch [System.IO.FileNotFoundException] {
    return @{ Success = $false; Message = "File not found" }
}
catch [System.IO.IOException] {
    return @{ Success = $false; Message = "Cannot access file" }
}
```

---

## التكامل مع CI/CD

### مثال: GitHub Actions

```yaml
name: Update Blade Templates

on:
  workflow_dispatch:
  schedule:
    - cron: '0 2 * * *'  # يومياً الساعة 2 صباحاً

jobs:
  update-templates:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      
      - name: Set up Python
        uses: actions/setup-python@v2
        with:
          python-version: '3.9'
      
      - name: Run update script
        run: |
          python update_blade_templates.py
      
      - name: Commit changes
        run: |
          git config --global user.email "bot@example.com"
          git config --global user.name "Update Bot"
          git add resources/views/
          git commit -m "Auto: Update Blade templates" || echo "No changes"
          git push
```

### مثال: Jenkins Pipeline

```groovy
pipeline {
    agent any
    
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        
        stage('Update Templates') {
            steps {
                sh '''
                    python3 update_blade_templates.py
                '''
            }
        }
        
        stage('Test') {
            steps {
                sh '''
                    php artisan blade:check
                    vendor/bin/phpunit tests/
                '''
            }
        }
        
        stage('Commit') {
            steps {
                sh '''
                    git add resources/views/
                    git commit -m "Auto: Update Blade templates" || true
                    git push
                '''
            }
        }
    }
}
```

---

## الأداء والتحسينات

### تحليل الأداء

#### حجم المشروع | الملفات | الوقت المتوقع | الذاكرة
|:--------:|:-------:|:----------:|:-----:|
| صغير | < 50 | < 1 ثانية | < 50 MB |
| متوسط | 50-200 | 1-5 ثواني | 50-200 MB |
| كبير | > 200 | 5-30 ثانية | 200+ MB |

### نصائح التحسين

#### 1. المعالجة المتوازية (Python):
```python
from concurrent.futures import ThreadPoolExecutor

def process_files_parallel(self, files, max_workers=4):
    with ThreadPoolExecutor(max_workers=max_workers) as executor:
        results = list(executor.map(self.process_file, files))
    return results
```

#### 2. التخزين المؤقت (Caching):
```python
@functools.lru_cache(maxsize=128)
def extract_page_title(self, content: str) -> str:
    # الاستخراج المخزن مؤقتاً
    pass
```

#### 3. المعالجة الدفعية (Batching):
```python
batch_size = 10
for i in range(0, len(files), batch_size):
    batch = files[i:i+batch_size]
    process_batch(batch)
```

---

## مراقبة وتسجيل العمليات

### نموذج Logging متقدم

```python
import logging

# إعداد Logger
logger = logging.getLogger(__name__)
handler = logging.FileHandler('blade_update.log')
formatter = logging.Formatter(
    '[%(asctime)s] %(levelname)s: %(message)s'
)
handler.setFormatter(formatter)
logger.addHandler(handler)

# الاستخدام
logger.info(f"Processing file: {file}")
logger.error(f"Failed to process: {file}")
```

### نموذج تقرير JSON

```json
{
  "timestamp": "2026-04-13T14:30:00Z",
  "statistics": {
    "total_files": 42,
    "successful": 40,
    "failed": 2,
    "duration_seconds": 5.23
  },
  "updated_files": [
    "resources/views/students/index.blade.php",
    "resources/views/teachers/show.blade.php"
  ],
  "failed_files": [
    {
      "file": "resources/views/invalid.blade.php",
      "error": "Invalid UTF-8 encoding"
    }
  ]
}
```

---

## الاختبار والتحقق

### اختبار الوحدة (Unit Tests)

```python
import unittest

class TestBladeUpdater(unittest.TestCase):
    
    def setUp(self):
        self.updater = BladeTemplateUpdater('./test_project')
    
    def test_find_blade_files(self):
        files = self.updater.find_blade_files()
        self.assertGreater(len(files), 0)
    
    def test_icon_replacement(self):
        content = '<i class="bi bi-pencil"></i>'
        result = self.updater.replace_bootstrap_icons(content)
        self.assertIn('fas fa-edit', result)
    
    def test_title_extraction(self):
        content = "@section('title')Test Title@endsection"
        title = self.updater.extract_page_title(content)
        self.assertEqual(title, "Test Title")
```

---

## استكشاف الأخطاء

### مشاكل شائعة وحلولها

| المشكلة | السبب | الحل |
|--------|------|------|
| No files found | المسار خاطئ | تحقق من المسار المطلق |
| Unicode error | ترميز خاطئ | تحويل الملفات إلى UTF-8 |
| Icon not showing | CDN بطيء | استخدم Font Awesome محليًا |
| Script hangs | ملف كبير جداً | زد timeout القيمة |

---

## الخلاصة والممارسات الأفضل

✅ **افعل:**
- استخدم backup دائماً
- اختبر على عينة صغيرة أولاً
- احفظ سجل العمليات
- استخدم version control
- وثق أي تخصيصات

❌ **لا تفعل:**
- لا تشغل بدون backup
- لا تعدل الملفات يدويًا أثناء التنفيذ
- لا تتجاهل رسائل الأخطاء
- لا تستخدم نسخة قديمة من الـ script
- لا تنسى اختبار في development أولاً

---

**آخر تحديث:** 2026-04-13
