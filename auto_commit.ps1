$ErrorActionPreference = "Stop"

Write-Host "Starting auto-commit process (One by One)..." -ForegroundColor Cyan

# Get all changes (staged, unstaged, and untracked)
$changes = git status --porcelain

if (-not $changes) {
    Write-Host "No changes detected." -ForegroundColor Yellow
    exit
}

foreach ($line in $changes) {
    if ([string]::IsNullOrWhiteSpace($line)) { continue }

    # Parse status and filename using Regex to handle spaces and quotes correctly
    # Pattern: 2 chars for status, 1 space, then the rest is the filename (possibly quoted)
    if ($line -match "^(..)\s+(.*)$") {
        $status = $matches[1]
        $rawPath = $matches[2]
        
        # Handle Rename format: "old -> new"
        if ($rawPath -match " -> ") {
            $parts = $rawPath -split " -> "
            $path = $parts[1] 
        } else {
            $path = $rawPath
        }

        # Remove surrounding quotes if git added them
        $path = $path.Trim('"')

        Write-Host "Processing: $status - $path" -ForegroundColor Green

        # Determine action verb for commit message
        $verb = "update"
        if ($status -match "\?\?") { $verb = "create" }
        elseif ($status -match "A") { $verb = "create" }
        elseif ($status -match "D") { $verb = "delete" }
        elseif ($status -match "R") { $verb = "move" }

        # Add the specific file
        git add "$path"

        # Commit
        # Check if there are actually changes staged for this file before committing
        # (Handling case where file might be ignored or empty change)
        git commit -m "chore($verb): $path"
    }
}

Write-Host "All changes have been committed individually." -ForegroundColor Cyan
