#!/bin/pwsh
<#
.SYNOPSIS
    Laravel Blade Template Update Script
.DESCRIPTION
    PowerShell script to automate migration of Blade templates from 'layout.header' to unified 'layout'
    with standardized structure and Font Awesome icons replacement.

.PARAMETER ProjectPath
    Base path of the Laravel project (default: current directory)

.PARAMETER DryRun
    Preview changes without modifying files (default: $false)

.EXAMPLE
    .\update_blade_templates.ps1 -ProjectPath "c:\xampp\htdocs\studentManagement"
    .\update_blade_templates.ps1 -DryRun $true

.NOTES
    Requires PowerShell 5.1 or higher
#>

param(
    [string]$ProjectPath = (Get-Location),
    [bool]$DryRun = $false
)

# Configuration
$ViewsPath = Join-Path $ProjectPath "resources" "views"

# Bootstrap Icons to Font Awesome mapping
$IconMappings = @{
    'bi\s+bi-pencil(?:-[\w-]+)?' = 'fas fa-edit'
    'bi\s+bi-trash(?:-[\w-]+)?' = 'fas fa-trash-alt'
    'bi\s+bi-plus(?:-[\w-]+)?' = 'fas fa-plus'
    'bi\s+bi-eye(?:-[\w-]+)?' = 'fas fa-eye'
    'bi\s+bi-check(?:-[\w-]+)?' = 'fas fa-check'
    'bi\s+bi-x(?:-[\w-]+)?' = 'fas fa-times'
    'bi\s+bi-download(?:-[\w-]+)?' = 'fas fa-download'
    'bi\s+bi-printer(?:-[\w-]+)?' = 'fas fa-print'
    'bi\s+bi-arrow-left(?:-[\w-]+)?' = 'fas fa-arrow-left'
    'bi\s+bi-search(?:-[\w-]+)?' = 'fas fa-search'
    'bi\s+bi-filter(?:-[\w-]+)?' = 'fas fa-filter'
    'bi\s+bi-list' = 'fas fa-list'
    'bi\s+bi-grid' = 'fas fa-th'
    'bi\s+bi-gear(?:-[\w-]+)?' = 'fas fa-cog'
    'bi\s+bi-house(?:-[\w-]+)?' = 'fas fa-home'
}

# Colors for output
$Colors = @{
    Success = 'Green'
    Error = 'Red'
    Warning = 'Yellow'
    Info = 'Cyan'
    Header = 'Magenta'
}

# ============================================================================
# FUNCTIONS
# ============================================================================

function Write-Header {
    param([string]$Text)
    Write-Host $Text -ForegroundColor $Colors.Header -BackgroundColor Black
}

function Write-Success {
    param([string]$Text)
    Write-Host $Text -ForegroundColor $Colors.Success
}

function Write-Error-Custom {
    param([string]$Text)
    Write-Host $Text -ForegroundColor $Colors.Error
}

function Write-Info {
    param([string]$Text)
    Write-Host $Text -ForegroundColor $Colors.Info
}

function Write-Line {
    param([int]$Length = 70)
    Write-Host ("=" * $Length) -ForegroundColor $Colors.Header
}

function Get-FileTitle {
    param([string]$Content)
    
    $titleMatch = [regex]::Match($Content, "@section\s*\(\s*['\"]title['\"]\s*\)\s*(.*?)\s*@endsection", [System.Text.RegexOptions]::IgnoreCase -bor [System.Text.RegexOptions]::Singleline)
    
    if ($titleMatch.Success) {
        return $titleMatch.Groups[1].Value.Trim()
    }
    return "Page"
}

function Get-PageContent {
    param([string]$Content)
    
    # Remove old extends
    $Content = [regex]::Replace($Content, "@extends\s*\(\s*['\"]layout\.header['\"]\s*\)", "")
    
    # Remove title section
    $Content = [regex]::Replace($Content, "@section\s*\(\s*['\"]title['\"]\s*\).*?@endsection", "", [System.Text.RegexOptions]::IgnoreCase -bor [System.Text.RegexOptions]::Singleline)
    
    return $Content.Trim()
}

function Replace-BootstrapIcons {
    param([string]$Content)
    
    foreach ($pattern in $IconMappings.Keys) {
        $replacement = $IconMappings[$pattern]
        
        # Replace in class attributes
        $Content = [regex]::Replace($Content, "class=`"([^`"]*?)$pattern([^`"]*?)`"", "class=`"`$1$replacement`$2`"", [System.Text.RegexOptions]::IgnoreCase)
        $Content = [regex]::Replace($Content, "class='([^']*?)$pattern([^']*?)'", "class='`$1$replacement`$2'", [System.Text.RegexOptions]::IgnoreCase)
        $Content = [regex]::Replace($Content, "class=`"$pattern`"", "class=`"$replacement`"", [System.Text.RegexOptions]::IgnoreCase)
        $Content = [regex]::Replace($Content, "class='$pattern'", "class='$replacement'", [System.Text.RegexOptions]::IgnoreCase)
    }
    
    return $Content
}

function Update-ButtonStyles {
    param([string]$Content)
    
    # Add btn-primary to submit buttons
    $Content = [regex]::Replace($Content, '<button\s+type="submit"', '<button type="submit" class="btn btn-primary"', [System.Text.RegexOptions]::IgnoreCase)
    $Content = [regex]::Replace($Content, "<button\s+type='submit'", "<button type='submit' class='btn btn-primary'", [System.Text.RegexOptions]::IgnoreCase)
    
    return $Content
}

function Indent-Content {
    param(
        [string]$Content,
        [int]$Spaces = 8
    )
    
    $indent = " " * $Spaces
    $lines = $Content -split "`n"
    $indentedLines = @()
    
    foreach ($line in $lines) {
        if ($line.Trim() -ne "") {
            $indentedLines += $indent + $line
        } else {
            $indentedLines += ""
        }
    }
    
    return $indentedLines -join "`n"
}

function New-BladeTemplate {
    param(
        [string]$Title,
        [string]$Content
    )
    
    $indentedContent = Indent-Content -Content $Content -Spaces 8
    
    $template = @"
@extends('layout')

@section('title', '$Title')

@section('content')
<div class="container mt-4">
    {{-- Page Header --}}
    <div class="page-header mb-4">
        <h1 class="page-title">$Title</h1>
        <hr>
    </div>

    {{-- Page Content --}}
    <div class="page-content">
$indentedContent
    </div>
</div>
@endsection
"@
    
    return $template
}

function Update-BladeFile {
    param([string]$FilePath)
    
    try {
        # Read original content
        $originalContent = Get-Content -Path $FilePath -Raw -Encoding UTF8
        
        # Extract page title
        $pageTitle = Get-FileTitle -Content $originalContent
        
        # Extract page content
        $pageContent = Get-PageContent -Content $originalContent
        
        # Replace Bootstrap icons
        $pageContent = Replace-BootstrapIcons -Content $pageContent
        
        # Update button styles
        $pageContent = Update-ButtonStyles -Content $pageContent
        
        # Generate new template
        $newTemplate = New-BladeTemplate -Title $pageTitle -Content $pageContent
        
        # Write updated content
        Set-Content -Path $FilePath -Value $newTemplate -Encoding UTF8
        
        return @{
            Success = $true
            Message = "✅ Updated: $(Split-Path -Leaf $FilePath)"
        }
    }
    catch {
        return @{
            Success = $false
            Message = "❌ Failed: $(Split-Path -Leaf $FilePath) - $($_.Exception.Message)"
        }
    }
}

# ============================================================================
# MAIN SCRIPT
# ============================================================================

Write-Line
Write-Header "  Laravel Blade Template Updater"
Write-Line
Write-Host "Project path: $ProjectPath" -ForegroundColor Yellow
Write-Host "Views path: $ViewsPath`n" -ForegroundColor Yellow

# Validate project path
if (-not (Test-Path $ProjectPath)) {
    Write-Error-Custom "❌ Error: Project path not found: $ProjectPath"
    exit 1
}

if (-not (Test-Path $ViewsPath)) {
    Write-Error-Custom "❌ Error: Views directory not found: $ViewsPath"
    exit 1
}

# Step 1: Find all Blade files
Write-Info "📋 Searching for Blade template files..."
$bladeFiles = Get-ChildItem -Path $ViewsPath -Filter "*.blade.php" -Recurse
Write-Success "   Found $($bladeFiles.Count) Blade files`n"

# Step 2: Find files using old layout
Write-Info "🔍 Finding files using old layout.header..."
$oldLayoutFiles = @()

foreach ($file in $bladeFiles) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8
    if ($content -match "@extends\(['\"]layout\.header['\"]\)") {
        $oldLayoutFiles += $file
    }
}

if ($oldLayoutFiles.Count -eq 0) {
    Write-Success "   ✓ No files found using layout.header"
    Write-Success "   All templates already use the new layout!"
    exit 0
}

Write-Success "   Found $($oldLayoutFiles.Count) files to update:`n"
foreach ($file in $oldLayoutFiles) {
    $relativePath = $file.FullName -replace [regex]::Escape($ViewsPath), ""
    Write-Host "      - $relativePath" -ForegroundColor Cyan
}

# Step 3: Process each file
$mode = if ($DryRun) { "[DRY RUN MODE]" } else { "[LIVE MODE]" }
Write-Info "`n$mode Processing files...`n"

$successCount = 0
$failureCount = 0
$failures = @()

foreach ($file in $oldLayoutFiles) {
    $result = Update-BladeFile -FilePath $file.FullName
    Write-Success $result.Message
    
    if ($result.Success) {
        $successCount++
    } else {
        $failureCount++
        $failures += $result.Message
    }
}

# Summary
Write-Line
Write-Header "  SUMMARY"
Write-Line
Write-Success "✅ Successfully updated: $successCount files"
Write-Error-Custom "❌ Failed: $failureCount files"

if ($failures.Count -gt 0) {
    Write-Host "`nFailed files:" -ForegroundColor Yellow
    foreach ($failure in $failures) {
        Write-Error-Custom "  $failure"
    }
}

Write-Success "`n✨ Update process completed!"
Write-Line
