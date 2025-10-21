# Script untuk commit semua perubahan dengan pesan "update" menggunakan perulangan

Write-Host "=== Git Auto Commit Script ===" -ForegroundColor Green
Write-Host ""

# Array untuk menyimpan status proses
$steps = @(
    "Menambahkan semua perubahan ke staging area...",
    "Melakukan commit dengan pesan 'update'...",
    "Proses selesai!"
)

# Perulangan untuk menampilkan dan menjalankan setiap langkah
for ($i = 0; $i -lt $steps.Length; $i++) {
    Write-Host "[$($i + 1)/$($steps.Length)] $($steps[$i])" -ForegroundColor Yellow
    
    switch ($i) {
        0 {
            # Tambahkan semua perubahan (termasuk file baru dan yang dihapus)
            git add -A
            if ($LASTEXITCODE -eq 0) {
                Write-Host "Berhasil menambahkan perubahan" -ForegroundColor Green
            } else {
                Write-Host "Gagal menambahkan perubahan" -ForegroundColor Red
                exit 1
            }
        }
        1 {
            # Commit dengan pesan "update"
            git commit -m "update"
            if ($LASTEXITCODE -eq 0) {
                Write-Host "Berhasil melakukan commit" -ForegroundColor Green
            } else {
                Write-Host "Gagal melakukan commit" -ForegroundColor Red
                exit 1
            }
        }
        2 {
            Write-Host "Semua langkah selesai!" -ForegroundColor Green
        }
    }
    
    Write-Host ""
}

# Tampilkan informasi commit terakhir
Write-Host "=== Informasi Commit Terakhir ===" -ForegroundColor Cyan
git log -1 --oneline
Write-Host ""

Write-Host "Untuk push ke remote, jalankan: git push" -ForegroundColor Magenta
