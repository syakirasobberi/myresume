# Rebuilds assets/resume/Nurul-Syakirah-Resume.pdf from cv.php using Microsoft Edge.
# Run this after changing your resume in the admin panel (Laragon must be running):
#   powershell -ExecutionPolicy Bypass -File tools\build-resume-pdf.ps1
# Use -BaseUrl if your local site lives at a different address.
param(
    [string]$BaseUrl = "http://localhost:8080/MyResume"
)

$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $PSScriptRoot
$outDir = Join-Path $root "assets\resume"
$outFile = Join-Path $outDir "Nurul-Syakirah-Resume.pdf"

$edge = @(
    "${env:ProgramFiles(x86)}\Microsoft\Edge\Application\msedge.exe",
    "$env:ProgramFiles\Microsoft\Edge\Application\msedge.exe"
) | Where-Object { Test-Path $_ } | Select-Object -First 1
if (-not $edge) { throw "Microsoft Edge was not found." }

try {
    Invoke-WebRequest -Uri "$BaseUrl/cv.php" -UseBasicParsing -TimeoutSec 10 | Out-Null
} catch {
    throw "Could not open $BaseUrl/cv.php. Start Laragon, or pass -BaseUrl with your local address."
}

New-Item -ItemType Directory -Force -Path $outDir | Out-Null
$profileDir = Join-Path $env:TEMP "myresume-pdf-profile"

& $edge --headless=new --disable-gpu --no-pdf-header-footer `
    "--user-data-dir=$profileDir" "--print-to-pdf=$outFile" "$BaseUrl/cv.php" | Out-Null

# Edge returns before the file is flushed on some machines; wait briefly for it.
for ($i = 0; $i -lt 20 -and -not (Test-Path $outFile); $i++) { Start-Sleep -Milliseconds 250 }
if (-not (Test-Path $outFile)) { throw "PDF was not created." }

Write-Host "Saved $outFile ($([math]::Round((Get-Item $outFile).Length / 1KB)) KB)"
