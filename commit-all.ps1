# Script untuk commit semua perubahan satu per satu dengan pesan update

Write-Host "Memulai proses commit semua perubahan..." -ForegroundColor Green

# Mendapatkan daftar semua file yang berubah
$statusOutput = git status --porcelain

if (-not $statusOutput) {
    Write-Host "Tidak ada file yang perlu di-commit." -ForegroundColor Yellow
    exit 0
}

# Parse status output untuk mendapatkan daftar file
$files = @()
foreach ($line in $statusOutput) {
    if ($line.Length -gt 3) {
        $file = $line.Substring(3).Trim()
        $files += $file
    }
}

Write-Host "Ditemukan $($files.Count) file yang akan di-commit:" -ForegroundColor Cyan

$counter = 1
foreach ($file in $files) {
    Write-Host ""
    Write-Host "[$counter/$($files.Count)] Committing: $file" -ForegroundColor Yellow
    
    # Add file ke staging area
    git add "$file"
    
    # Commit dengan pesan update
    $result = git commit -m "update" 2>&1
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "Berhasil commit: $file" -ForegroundColor Green
    } else {
        Write-Host "Gagal commit: $file" -ForegroundColor Red
        Write-Host "Error: $result" -ForegroundColor Red
    }
    
    $counter++
    Start-Sleep -Milliseconds 300
}

Write-Host ""
Write-Host "Proses commit selesai!" -ForegroundColor Green
Write-Host "Total file: $($files.Count)" -ForegroundColor Cyan

# Menampilkan status git final
Write-Host ""
Write-Host "Status git setelah commit:" -ForegroundColor Cyan
git status --short