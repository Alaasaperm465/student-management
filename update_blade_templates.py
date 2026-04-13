#!/usr/bin/env python3
"""
Laravel Blade Template Update Script
=====================================
This script automates the migration of Blade templates from 'layout.header' to unified 'layout'
with standardized structure, including Font Awesome icons replacement.

Requirements:
    - Python 3.6+
    - The base layout file should exist at: resources/views/layout.blade.php
"""

import os
import re
import sys
from pathlib import Path
from typing import List, Tuple, Dict

class BladeTemplateUpdater:
    """Update Blade templates to use unified layout structure"""
    
    def __init__(self, base_path: str):
        """Initialize the updater with project base path"""
        self.base_path = Path(base_path)
        self.views_path = self.base_path / "resources" / "views"
        self.blade_files: List[Path] = []
        self.updated_files: List[str] = []
        self.failed_files: List[Tuple[str, str]] = []
        
        # Bootstrap Icons to Font Awesome mapping
        self.icon_mapping = {
            r'bi\s+bi-pencil(?:-[\w-]+)?': 'fas fa-edit',
            r'bi\s+bi-trash(?:-[\w-]+)?': 'fas fa-trash-alt',
            r'bi\s+bi-plus(?:-[\w-]+)?': 'fas fa-plus',
            r'bi\s+bi-eye(?:-[\w-]+)?': 'fas fa-eye',
            r'bi\s+bi-check(?:-[\w-]+)?': 'fas fa-check',
            r'bi\s+bi-x(?:-[\w-]+)?': 'fas fa-times',
            r'bi\s+bi-download(?:-[\w-]+)?': 'fas fa-download',
            r'bi\s+bi-printer(?:-[\w-]+)?': 'fas fa-print',
            r'bi\s+bi-arrow-left(?:-[\w-]+)?': 'fas fa-arrow-left',
            r'bi\s+bi-search(?:-[\w-]+)?': 'fas fa-search',
            r'bi\s+bi-filter(?:-[\w-]+)?': 'fas fa-filter',
            r'bi\s+bi-list': 'fas fa-list',
            r'bi\s+bi-grid': 'fas fa-th',
            r'bi\s+bi-gear(?:-[\w-]+)?': 'fas fa-cog',
            r'bi\s+bi-house(?:-[\w-]+)?': 'fas fa-home',
            r'bi\s+bi-question-circle(?:-[\w-]+)?': 'fas fa-question-circle',
            r'bi\s+bi-info-circle(?:-[\w-]+)?': 'fas fa-info-circle',
            r'bi\s+bi-exclamation-triangle(?:-[\w-]+)?': 'fas fa-exclamation-triangle',
            r'bi\s+bi-check-circle(?:-[\w-]+)?': 'fas fa-check-circle',
            r'bi\s+bi-times-circle(?:-[\w-]+)?': 'fas fa-times-circle',
        }
    
    def find_blade_files(self) -> List[Path]:
        """Find all .blade.php files in views directory"""
        if not self.views_path.exists():
            print(f"❌ Views directory not found: {self.views_path}")
            return []
        
        self.blade_files = list(self.views_path.rglob("*.blade.php"))
        return self.blade_files
    
    def find_old_layout_files(self) -> List[Path]:
        """Filter files that use old layout.header extend"""
        old_layout_files = []
        
        for file in self.blade_files:
            try:
                with open(file, 'r', encoding='utf-8') as f:
                    content = f.read()
                    if "@extends('layout.header')" in content or '@extends("layout.header")' in content:
                        old_layout_files.append(file)
            except Exception as e:
                print(f"⚠️  Error reading {file}: {e}")
        
        return old_layout_files
    
    def extract_page_title(self, content: str) -> str:
        """Extract page title from @section('title') or guess from filename"""
        title_match = re.search(r"@section\s*\(\s*['\"]title['\"]\s*\)\s*(.*?)\s*@endsection", 
                               content, re.DOTALL | re.IGNORECASE)
        if title_match:
            return title_match.group(1).strip()
        return "Page"
    
    def extract_page_content(self, content: str) -> str:
        """Extract main content (non-header/title sections)"""
        # Remove old extends and sections
        content = re.sub(r"@extends\s*\(\s*['\"]layout\.header['\"]\s*\)", "", content)
        
        # Remove title section if exists
        content = re.sub(r"@section\s*\(\s*['\"]title['\"]\s*\).*?@endsection", 
                        "", content, flags=re.DOTALL | re.IGNORECASE)
        
        return content.strip()
    
    def replace_bootstrap_icons(self, content: str) -> str:
        """Replace Bootstrap Icons with Font Awesome icons"""
        for bs_pattern, fa_class in self.icon_mapping.items():
            # Match both class="..." and class='...' formats
            content = re.sub(
                f'class="([^"]*){bs_pattern}([^"]*)?"',
                f'class="\\1{fa_class}\\2"',
                content,
                flags=re.IGNORECASE
            )
            content = re.sub(
                f"class='([^']*){bs_pattern}([^']*)'",
                f"class='\\1{fa_class}\\2'",
                content,
                flags=re.IGNORECASE
            )
            
            # Also handle standalone class attributes
            content = re.sub(
                f'class="{bs_pattern}"',
                f'class="{fa_class}"',
                content,
                flags=re.IGNORECASE
            )
            content = re.sub(
                f"class='{bs_pattern}'",
                f"class='{fa_class}'",
                content,
                flags=re.IGNORECASE
            )
        
        return content
    
    def update_button_styles(self, content: str) -> str:
        """Ensure buttons follow Bootstrap standardization"""
        # Ensure all buttons have proper classes
        content = re.sub(
            r'<button\s+([^>]*?)class="([^"]*)"',
            lambda m: f'<button {m.group(1)}class="btn {m.group(2)}"' 
                     if 'btn' not in m.group(2) else f'<button {m.group(1)}class="{m.group(2)}"',
            content,
            flags=re.IGNORECASE
        )
        
        # Add btn-primary to action buttons if not already styled
        content = re.sub(
            r'<button\s+type="submit"',
            '<button type="submit" class="btn btn-primary"',
            content,
            flags=re.IGNORECASE
        )
        
        return content
    
    def generate_new_template(self, page_title: str, page_content: str) -> str:
        """Generate new template with unified layout"""
        # Clean up content
        page_content = page_content.strip()
        
        # Ensure proper indentation
        lines = page_content.split('\n')
        cleaned_lines = [line.rstrip() for line in lines if line.strip()]
        page_content = '\n'.join(cleaned_lines)
        
        template = f"""@extends('layout')

@section('title', '{page_title}')

@section('content')
<div class="container mt-4">
    {{-- Page Header --}}
    <div class="page-header mb-4">
        <h1 class="page-title">{page_title}</h1>
        <hr>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
{self._indent_content(page_content, 8)}
    </div>
</div>
@endsection
"""
        return template
    
    def _indent_content(self, content: str, spaces: int = 8) -> str:
        """Indent content by specified number of spaces"""
        indent = ' ' * spaces
        lines = content.split('\n')
        return '\n'.join(indent + line if line.strip() else '' for line in lines)
    
    def process_file(self, file_path: Path) -> Tuple[bool, str]:
        """Process a single Blade file"""
        try:
            # Read original content
            with open(file_path, 'r', encoding='utf-8') as f:
                original_content = f.read()
            
            # Extract page title
            page_title = self.extract_page_title(original_content)
            
            # Extract page content
            page_content = self.extract_page_content(original_content)
            
            # Replace Bootstrap icons with Font Awesome
            page_content = self.replace_bootstrap_icons(page_content)
            
            # Update button styles
            page_content = self.update_button_styles(page_content)
            
            # Generate new template
            new_template = self.generate_new_template(page_title, page_content)
            
            # Write updated content
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(new_template)
            
            return True, f"✅ Updated: {file_path.relative_to(self.base_path)}"
        
        except Exception as e:
            error_msg = f"❌ Failed to update {file_path}: {str(e)}"
            return False, error_msg
    
    def run(self, dry_run: bool = False) -> None:
        """Run the update process"""
        print("=" * 70)
        print("Laravel Blade Template Updater")
        print("=" * 70)
        print(f"Project path: {self.base_path}")
        print(f"Views path: {self.views_path}\n")
        
        # Step 1: Find all Blade files
        print("📋 Searching for Blade template files...")
        self.find_blade_files()
        print(f"   Found {len(self.blade_files)} Blade files\n")
        
        # Step 2: Find files using old layout
        print("🔍 Finding files using old layout.header...")
        old_layout_files = self.find_old_layout_files()
        
        if not old_layout_files:
            print("   ✓ No files found using layout.header")
            print("   All templates already use the new layout!")
            return
        
        print(f"   Found {len(old_layout_files)} files to update:\n")
        
        for file in old_layout_files:
            print(f"      - {file.relative_to(self.base_path)}")
        
        print(f"\n{'[DRY RUN MODE]' if dry_run else '[LIVE MODE]'} Processing files...\n")
        
        # Step 3: Process each file
        for file in old_layout_files:
            success, message = self.process_file(file)
            print(message)
            
            if success:
                self.updated_files.append(str(file.relative_to(self.base_path)))
            else:
                self.failed_files.append((str(file.relative_to(self.base_path)), message))
        
        # Summary
        print("\n" + "=" * 70)
        print("SUMMARY")
        print("=" * 70)
        print(f"✅ Successfully updated: {len(self.updated_files)} files")
        print(f"❌ Failed: {len(self.failed_files)} files")
        
        if self.failed_files:
            print("\nFailed files:")
            for file, error in self.failed_files:
                print(f"  - {file}: {error}")
        
        print("\n✨ Update process completed!")
        print("=" * 70)


def main():
    """Main entry point"""
    # Configuration
    PROJECT_PATH = r"c:\xampp\htdocs\studentManagement"
    DRY_RUN = False  # Set to True to preview changes without modifying files
    
    # Validate project path
    if not os.path.exists(PROJECT_PATH):
        print(f"❌ Error: Project path not found: {PROJECT_PATH}")
        sys.exit(1)
    
    # Create updater instance
    updater = BladeTemplateUpdater(PROJECT_PATH)
    
    # Run the update process
    updater.run(dry_run=DRY_RUN)


if __name__ == "__main__":
    main()
