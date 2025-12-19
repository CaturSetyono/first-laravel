$ErrorActionPreference = "Stop"

Write-Host "Starting auto-commit process..." -ForegroundColor Cyan

# Get list of changed files
$changes = git status --porcelain

if (-not $changes) {
    Write-Host "No changes detected." -ForegroundColor Yellow
    exit
}

foreach ($change in $changes) {
    if ([string]::IsNullOrWhiteSpace($change)) { continue }

    # Extract status code (first 2 chars)
    $statusCode = $change.Substring(0, 2)
    
    # Extract filename (rest of the string)
    $rawFile = $change.Substring(3)
    
    # Handle renames (format: R  old -> new)
    if ($statusCode.Trim() -eq "R") {
        $parts = $rawFile -split " -> "
        $file = $parts[1]
    } else {
        $file = $rawFile
    }

    # Remove wrapping quotes if present (Git quotes paths with spaces)
    $file = $file.Trim('"')

    Write-Host "Processing: $file" -ForegroundColor Green
    
    # Determine concise action for commit message
    $action = "update"
    if ($statusCode -match "\?\?") { $action = "create" }
    elseif ($statusCode -match "A") { $action = "create" }
    elseif ($statusCode -match "D") { $action = "delete" }
    elseif ($statusCode -match "R") { $action = "move" }
    elseif ($statusCode -match "M") { $action = "update" }

    # Add the specific file
    git add "$file"
    
    # Commit with standard message format
    $msg = "chore($action): $file"
    git commit -m "$msg"
}

Write-Host "All changes have been committed one by one." -ForegroundColor Cyan
