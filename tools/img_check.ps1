<#
Image path validator for Grupo6
Scans all files under paginas/ for img src attributes, resolves them to the filesystem,
and checks existence. Also validates the asset paths referenced in componentes/header.php
and reports differences (e.g. Assets vs assets).
Outputs: tools\img_report.txt
#>
$root = (Get-Item -Path .).FullName
$report = @()

# read header.php to get asset path references
$headerPath = Join-Path $root 'componentes\header.php'
$headerContent = ''
if (Test-Path $headerPath) { $headerContent = Get-Content -Raw -Path $headerPath -Encoding UTF8 }

# find which assets folder header uses (search for assets/img or Assets/img)
$headerAssetFolder = ''
if ($headerContent -match "assets/img") { $headerAssetFolder = 'assets/img' }
elseif ($headerContent -match "Assets/img") { $headerAssetFolder = 'Assets/img' }
else { 
    # fallback: find any "img/" usage
    if ($headerContent -match "img/") { $headerAssetFolder = 'assets/img' }
}

# Record header findings
$report += "Header asset folder guess: $headerAssetFolder"
$report += "Header file: $headerPath`n"

# Check header images mentioned explicitly
$expectedHeaderImgs = @('logo.png','default.png')
foreach ($img in $expectedHeaderImgs) {
    $p = Join-Path $root ($headerAssetFolder -replace '/','\\')
    $pimg = Join-Path $p $img
    $exists = Test-Path $pimg -PathType Leaf
    $report += "Header expects: $headerAssetFolder/$img -> $pimg (exists: $exists)"
}

# Scan paginas for img tags
$pages = Get-ChildItem -Path (Join-Path $root 'paginas') -Recurse -File -Include *.php,*.html
$total = 0
$missing = 0
foreach ($f in $pages) {
    $content = Get-Content -Raw -Encoding UTF8 -Path $f.FullName -ErrorAction SilentlyContinue
    if (-not $content) { continue }
    $matches = [regex]::Matches($content, '<img[^>]*?src\s*=\s*"([^"]+)"', 'IgnoreCase')
    foreach ($m in $matches) {
        $src = $m.Groups[1].Value.Trim()
        if ([string]::IsNullOrWhiteSpace($src)) { continue }
        # skip external
        if ($src -match '^[a-zA-Z][a-zA-Z0-9+.-]*:') { continue }
        if ($src.StartsWith('data:')) { continue }

        $total++
        if ($src.StartsWith('/')) {
            $rel = $src.TrimStart('/') -replace '/','\\'
            $resolved = Join-Path $root $rel
        } else {
            $dir = Split-Path $f.FullName
            $resolved = [System.IO.Path]::GetFullPath((Join-Path $dir $src))
        }
        $exists = Test-Path $resolved -PathType Leaf
        if (-not $exists) { $missing++ }
        $report += [string]::Format('File: {0}`n  src: {1}`n  resolved: {2}`n  exists: {3}`n', $f.FullName, $src, $resolved, $exists)
    }
}

$report += "Total img tags scanned: $total"
$report += "Total missing images: $missing"

$out = Join-Path $root 'tools\img_report.txt'
$report | Out-File -FilePath $out -Encoding UTF8
Write-Host "Image scan complete. Scanned $total tags, missing $missing. Report: $out"
