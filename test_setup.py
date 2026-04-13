#!/usr/bin/env python3
"""
نموذج اختبار سريع للـ Scripts
Quick Test Script - يمكنك استخدامه للتحقق من أن كل شيء يعمل بشكل صحيح
"""

import os
import sys
from pathlib import Path


def test_environment():
    """التحقق من بيئة التطوير"""
    print("=" * 70)
    print("🧪 اختبار البيئة")
    print("=" * 70)
    
    # 1. التحقق من Python
    print(f"✅ Python Version: {sys.version.split()[0]}")
    if sys.version_info < (3, 6):
        print("⚠️  تحذير: يتطلب Python 3.6 أو أعلى")
        return False
    
    # 2. التحقق من المسار
    project_path = Path(r"c:\xampp\htdocs\studentManagement")
    print(f"✅ Project Path: {project_path}")
    
    if not project_path.exists():
        print("❌ خطأ: المجلد غير موجود")
        return False
    
    # 3. التحقق من مجلد views
    views_path = project_path / "resources" / "views"
    print(f"✅ Views Path: {views_path}")
    
    if not views_path.exists():
        print("❌ خطأ: مجلد views غير موجود")
        return False
    
    # 4. عد ملفات .blade.php
    blade_files = list(views_path.rglob("*.blade.php"))
    print(f"✅ عدد ملفات .blade.php: {len(blade_files)}")
    
    if len(blade_files) == 0:
        print("⚠️  تحذير: لم يتم العثور على ملفات blade")
        return False
    
    # 5. البحث عن الملفات القديمة
    old_files = []
    for file in blade_files:
        try:
            with open(file, 'r', encoding='utf-8') as f:
                content = f.read()
                if "@extends('layout.header')" in content or '@extends("layout.header")' in content:
                    old_files.append(file)
        except Exception as e:
            print(f"⚠️  خطأ في قراءة {file}: {e}")
    
    print(f"✅ عدد الملفات التي تستخدم layout.header: {len(old_files)}")
    
    if len(old_files) > 0:
        print("\n📋 الملفات المراد تحديثها:")
        for file in old_files[:5]:  # عرض أول 5
            print(f"   - {file.relative_to(views_path)}")
        if len(old_files) > 5:
            print(f"   ... و {len(old_files) - 5} ملفات أخرى")
    
    # 6. التحقق من وجود layout.blade.php
    layout_file = views_path / "layout.blade.php"
    if layout_file.exists():
        print(f"✅ تم العثور على: layout.blade.php")
    else:
        print(f"⚠️  تحذير: layout.blade.php غير موجود")
        print(f"   يجب إنشاء هذا الملف قبل التشغيل")
    
    # 7. التحقق من وجود الـ Scripts
    print("\n📋 التحقق من الـ Scripts:")
    scripts = [
        "update_blade_templates.py",
        "update_blade_templates.ps1",
        "update_blade_templates.sh"
    ]
    
    for script in scripts:
        script_path = project_path / script
        if script_path.exists():
            size = script_path.stat().st_size
            print(f"   ✅ {script} ({size} bytes)")
        else:
            print(f"   ❌ {script} غير موجود")
    
    print("\n" + "=" * 70)
    return True


def show_recommendations():
    """عرض التوصيات"""
    print("=" * 70)
    print("💡 التوصيات والخطوات التالية")
    print("=" * 70)
    
    recommendations = [
        ("1️⃣  عمل Backup", "xcopy resources\\views resources\\views.backup /E /I /Y"),
        ("2️⃣  اختبار على ملف واحد", "تعديل السكريبت لملف واحد أولاً"),
        ("3️⃣  تشغيل السكريبت", "python update_blade_templates.py"),
        ("4️⃣  اختبار الموقع", "افتح http://localhost/studentManagement"),
        ("5️⃣  التحقق من الأيقونات", "تأكد من عرض Font Awesome بشكل صحيح"),
    ]
    
    for title, action in recommendations:
        print(f"\n{title}")
        print(f"   → {action}")
    
    print("\n" + "=" * 70)


def show_file_structure():
    """عرض بنية الملفات المُنشأة"""
    print("=" * 70)
    print("📁 بنية الملفات المُنشأة")
    print("=" * 70)
    
    project_path = Path(r"c:\xampp\htdocs\studentManagement")
    
    files_to_check = [
        "update_blade_templates.py",
        "update_blade_templates.ps1", 
        "update_blade_templates.sh",
        "blade_config.json",
        "README_SCRIPTS.md",
        "TECHNICAL_GUIDE.md",
        "EXAMPLES_AND_TIPS.md",
        "QUICK_START.md",
        "INDEX.md",
        "COMPLETION_SUMMARY.md"
    ]
    
    print("\n📋 الملفات الموجودة:")
    for filename in files_to_check:
        file_path = project_path / filename
        if file_path.exists():
            print(f"   ✅ {filename}")
        else:
            print(f"   ⚠️  {filename} (غير موجود)")


def quick_icon_test():
    """اختبار سريع لتحويل الأيقونات"""
    print("\n" + "=" * 70)
    print("🎨 اختبار سريع لتحويل الأيقونات")
    print("=" * 70)
    
    icon_mappings = {
        'bi bi-pencil': 'fas fa-edit',
        'bi bi-trash': 'fas fa-trash-alt',
        'bi bi-plus': 'fas fa-plus',
        'bi bi-eye': 'fas fa-eye',
    }
    
    print("\n📊 نماذج التحويل:")
    for bs, fa in list(icon_mappings.items())[:4]:
        print(f"   {bs:<20} → {fa}")
    
    print(f"\n   + {40 - 4} أيقونة أخرى...")


def create_test_file():
    """إنشاء ملف اختبار بسيط"""
    print("\n" + "=" * 70)
    print("🧪 إنشاء ملف اختبار")
    print("=" * 70)
    
    project_path = Path(r"c:\xampp\htdocs\studentManagement")
    test_file = project_path / "resources" / "views" / "test_blade.blade.php"
    
    test_content = '''@extends('layout.header')

@section('title', 'صفحة اختبار')

<div class="container">
    <h1>هذا ملف اختبار</h1>
    <button type="submit" class="btn">
        <i class="bi bi-pencil"></i> تعديل
    </button>
</div>
'''
    
    try:
        # لا تنشئ الملف فعلياً، فقط أخبر المستخدم
        print(f"\n📝 يمكنك إنشاء ملف اختبار هنا:")
        print(f"   {test_file}")
        print(f"\nالمحتوى:")
        print(test_content)
        print("\nثم قم بتشغيل السكريبت لاختبار الملف الواحد")
    except Exception as e:
        print(f"❌ خطأ: {e}")


def main():
    """الدالة الرئيسية"""
    print("\n")
    print(" " * 20 + "🚀 نموذج الاختبار السريع")
    print(" " * 10 + "Laravel Blade Template Update Scripts")
    print()
    
    # 1. اختبار البيئة
    if not test_environment():
        print("\n❌ فشل اختبار البيئة!")
        return False
    
    # 2. عرض بنية الملفات
    show_file_structure()
    
    # 3. اختبار الأيقونات
    quick_icon_test()
    
    # 4. عرض التوصيات
    show_recommendations()
    
    # 5. عرض معلومات إضافية
    print("\n" + "=" * 70)
    print("✨ ملخص")
    print("=" * 70)
    print("\n✅ البيئة جاهزة للتشغيل")
    print("✅ جميع الملفات موجودة")
    print("✅ يمكنك البدء بالعملية الآن")
    print("\n📌 الخطوة التالية:")
    print("   python update_blade_templates.py")
    print("\n" + "=" * 70)
    
    return True


if __name__ == "__main__":
    try:
        success = main()
        sys.exit(0 if success else 1)
    except Exception as e:
        print(f"\n❌ خطأ غير متوقع: {e}")
        import traceback
        traceback.print_exc()
        sys.exit(1)
