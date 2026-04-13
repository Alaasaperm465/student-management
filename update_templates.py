#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
تحديث جميع ملفات Blade لاستخدام layout موحد
Script يقوم بتحديث جميع ملفات .blade.php التي تستخدم @extends('layout.header')
ليستخدموا @extends('layout') بدلاً من ذلك
"""

import os
import re
from pathlib import Path

def main():
    views_path = Path('resources/views')
    
    if not views_path.exists():
        print("❌ مسار views غير موجود!")
        return
    
    print("\n" + "="*50)
    print("🔄 تحديث Blade Templates")
    print("="*50 + "\n")
    
    updated_files = 0
    
    # البحث عن جميع ملفات .blade.php
    for blade_file in views_path.rglob('*.blade.php'):
        try:
            with open(blade_file, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # البحث عن @extends('layout.header')
            if "layout.header" in content:
                print(f"✏️  تحديث: {blade_file.relative_to('.')}")
                
                # استبدال @extends('layout.header') بـ @extends('layout')
                updated_content = re.sub(
                    r"@extends\(['\"]layout\.header['\"]\)",
                    "@extends('layout')",
                    content
                )
                
                with open(blade_file, 'w', encoding='utf-8') as f:
                    f.write(updated_content)
                
                updated_files += 1
        
        except Exception as e:
            print(f"❌ خطأ في {blade_file}: {e}")
    
    print("\n" + "="*50)
    print(f"✅ تم تحديث {updated_files} ملف بنجاح!")
    print("="*50 + "\n")

if __name__ == '__main__':
    main()
