#!/bin/bash
################################################################################
# Laravel Blade Template Update Script
################################################################################
# Description: Automate migration of Blade templates from 'layout.header' to 
#              unified 'layout' with standardized structure and Font Awesome icons
#
# Usage: bash update_blade_templates.sh [project_path]
#
# Example: bash update_blade_templates.sh /var/www/studentManagement
################################################################################

set -euo pipefail

# Configuration
PROJECT_PATH="${1:-.}"
VIEWS_PATH="$PROJECT_PATH/resources/views"
DRY_RUN=false

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
MAGENTA='\033[0;35m'
NC='\033[0m' # No Color

# ============================================================================
# FUNCTIONS
# ============================================================================

print_header() {
    echo -e "${MAGENTA}$(printf '%.0s=' {1..70})${NC}"
    echo -e "${MAGENTA}  $1${NC}"
    echo -e "${MAGENTA}$(printf '%.0s=' {1..70})${NC}"
}

print_success() {
    echo -e "${GREEN}$1${NC}"
}

print_error() {
    echo -e "${RED}$1${NC}"
}

print_info() {
    echo -e "${CYAN}$1${NC}"
}

print_warning() {
    echo -e "${YELLOW}$1${NC}"
}

# Extract page title from Blade content
get_file_title() {
    local content="$1"
    local title=$(echo "$content" | sed -n "/@section\s*(['\"]title['\"]\s*)/,/@endsection/p" | sed "1d;\$d" | head -1 | xargs)
    
    if [ -z "$title" ]; then
        title="Page"
    fi
    echo "$title"
}

# Extract page content (remove extends and title section)
get_page_content() {
    local content="$1"
    
    # Remove old extends
    content=$(echo "$content" | sed "/^@extends\s*(['\"]layout\.header['\"]\s*)/d")
    
    # Remove title section
    content=$(echo "$content" | sed "/@section\s*(['\"]title['\"]\s*)/,/@endsection/d")
    
    # Remove leading/trailing whitespace
    echo "$content" | sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//'
}

# Replace Bootstrap Icons with Font Awesome
replace_bootstrap_icons() {
    local content="$1"
    
    # Icon mapping
    declare -A icon_map=(
        ["bi\s\+bi-pencil\(\?:-\[\\w-\]\+\)\?"]="fas fa-edit"
        ["bi\s\+bi-trash\(\?:-\[\\w-\]\+\)\?"]="fas fa-trash-alt"
        ["bi\s\+bi-plus\(\?:-\[\\w-\]\+\)\?"]="fas fa-plus"
        ["bi\s\+bi-eye\(\?:-\[\\w-\]\+\)\?"]="fas fa-eye"
        ["bi\s\+bi-check\(\?:-\[\\w-\]\+\)\?"]="fas fa-check"
        ["bi\s\+bi-x\(\?:-\[\\w-\]\+\)\?"]="fas fa-times"
        ["bi\s\+bi-download\(\?:-\[\\w-\]\+\)\?"]="fas fa-download"
        ["bi\s\+bi-printer\(\?:-\[\\w-\]\+\)\?"]="fas fa-print"
        ["bi\s\+bi-arrow-left\(\?:-\[\\w-\]\+\)\?"]="fas fa-arrow-left"
        ["bi\s\+bi-search\(\?:-\[\\w-\]\+\)\?"]="fas fa-search"
        ["bi\s\+bi-filter\(\?:-\[\\w-\]\+\)\?"]="fas fa-filter"
        ["bi\s\+bi-list"]="fas fa-list"
        ["bi\s\+bi-grid"]="fas fa-th"
        ["bi\s\+bi-gear\(\?:-\[\\w-\]\+\)\?"]="fas fa-cog"
        ["bi\s\+bi-house\(\?:-\[\\w-\]\+\)\?"]="fas fa-home"
    )
    
    for pattern in "${!icon_map[@]}"; do
        local replacement="${icon_map[$pattern]}"
        content=$(echo "$content" | sed -E "s/class=\"([^\"]*)$pattern([^\"]*)\"/class=\"\1$replacement\2\"/g")
        content=$(echo "$content" | sed -E "s/class='([^']*)'$pattern([^']*)''/class='\1$replacement\2'/g")
    done
    
    echo "$content"
}

# Update button styles
update_button_styles() {
    local content="$1"
    
    # Add btn-primary to submit buttons
    content=$(echo "$content" | sed -E 's/<button\s+type="submit"/<button type="submit" class="btn btn-primary"/g')
    content=$(echo "$content" | sed -E "s/<button\s+type='submit'/<button type='submit' class='btn btn-primary'/g")
    
    echo "$content"
}

# Indent content
indent_content() {
    local content="$1"
    local spaces="${2:-8}"
    local indent=$(printf '%*s' "$spaces")
    
    echo "$content" | sed "s/^/$indent/g"
}

# Generate new Blade template
new_blade_template() {
    local title="$1"
    local content="$2"
    
    local indented_content=$(indent_content "$content" 8)
    
    cat << EOF
@extends('layout')

@section('title', '$title')

@section('content')
<div class="container mt-4">
    {{-- Page Header --}}
    <div class="page-header mb-4">
        <h1 class="page-title">$title</h1>
        <hr>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
$indented_content
    </div>
</div>
@endsection
EOF
}

# Update a single Blade file
update_blade_file() {
    local file_path="$1"
    
    {
        # Read original content
        local original_content=$(cat "$file_path")
        
        # Extract page title
        local page_title=$(get_file_title "$original_content")
        
        # Extract page content
        local page_content=$(get_page_content "$original_content")
        
        # Replace Bootstrap icons
        page_content=$(replace_bootstrap_icons "$page_content")
        
        # Update button styles
        page_content=$(update_button_styles "$page_content")
        
        # Generate new template
        local new_template=$(new_blade_template "$page_title" "$page_content")
        
        # Write updated content
        echo "$new_template" > "$file_path"
        
        print_success "✅ Updated: $(basename $file_path)"
        return 0
    } || {
        print_error "❌ Failed: $(basename $file_path)"
        return 1
    }
}

# ============================================================================
# MAIN SCRIPT
# ============================================================================

# Print header
print_header "Laravel Blade Template Updater"
echo ""
print_warning "Project path: $PROJECT_PATH"
print_warning "Views path: $VIEWS_PATH"
echo ""

# Validate project path
if [ ! -d "$PROJECT_PATH" ]; then
    print_error "❌ Error: Project path not found: $PROJECT_PATH"
    exit 1
fi

if [ ! -d "$VIEWS_PATH" ]; then
    print_error "❌ Error: Views directory not found: $VIEWS_PATH"
    exit 1
fi

# Step 1: Find all Blade files
print_info "📋 Searching for Blade template files..."
mapfile -t blade_files < <(find "$VIEWS_PATH" -name "*.blade.php" -type f)
print_success "   Found ${#blade_files[@]} Blade files"
echo ""

# Step 2: Find files using old layout
print_info "🔍 Finding files using old layout.header..."
old_layout_files=()

for file in "${blade_files[@]}"; do
    if grep -q "@extends(['\"]layout\.header['\"]\s*)" "$file" 2>/dev/null; then
        old_layout_files+=("$file")
    fi
done

if [ ${#old_layout_files[@]} -eq 0 ]; then
    print_success "   ✓ No files found using layout.header"
    print_success "   All templates already use the new layout!"
    exit 0
fi

print_success "   Found ${#old_layout_files[@]} files to update:"
echo ""
for file in "${old_layout_files[@]}"; do
    echo -e "      ${CYAN}- ${file#$VIEWS_PATH/}${NC}"
done

# Step 3: Process each file
echo ""
if [ "$DRY_RUN" = true ]; then
    print_info "[DRY RUN MODE] Processing files..."
else
    print_info "[LIVE MODE] Processing files..."
fi
echo ""

success_count=0
failure_count=0

for file in "${old_layout_files[@]}"; do
    if update_blade_file "$file"; then
        ((success_count++))
    else
        ((failure_count++))
    fi
done

# Summary
echo ""
print_header "SUMMARY"
print_success "✅ Successfully updated: $success_count files"
print_error "❌ Failed: $failure_count files"
echo ""
print_success "✨ Update process completed!"
print_header ""
