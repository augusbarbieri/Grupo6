<#
Link checker for Grupo6
Usage:
  cd c:\xampp\htdocs\Grupo6
  .\tools\link_check.ps1
Generates: tools\missing_links_report.txt and prints a summary.
Excludes paths containing 'paginas_backup' or 'paginas\backup'.
#>

$root = (Get-Item -Path .).FullName
Write-Host "Project root: $root"

$files = Get-ChildItem -Path $root -Recurse -Include *.php,*.html -File |
    Where-Object { $_.FullName -notmatch '\\paginas_backup\\' }

$missing = @()
$totalLinks = 0

foreach ($f in $files) {
    $content = Get-Content -Raw -Encoding UTF8 -Path $f.FullName -ErrorAction SilentlyContinue
    if (-not $content) { continue }

    # find double-quoted attributes
    $dq = [regex]::Matches($content, '(?:href|src|action)\s*=\s*"(.*?)"')
    # find single-quoted attributes
    $sq = [regex]::Matches($content, "(?:href|src|action)\s*=\s*'(.*?)'")

    $all = @()
    foreach ($m in $dq) { $all += $m.Groups[1].Value }
    foreach ($m in $sq) { $all += $m.Groups[1].Value }

    foreach ($link in $all) {
        $link = $link.Trim()
        # skip obvious externals
        if ([string]::IsNullOrWhiteSpace($link)) { continue }
        if ($link -match '^[a-zA-Z][a-zA-Z0-9+.-]*:') { continue }
        if ($link.StartsWith('#')) { continue }
        if ($link.StartsWith('data:')) { continue }

        $totalLinks++

        if ($link.StartsWith('/')) {
            $rel = $link.TrimStart('/') -replace '/','\\'
            $resolved = Join-Path $root $rel
        } else {
            $fileDir = Split-Path $f.FullName
            $resolved = [System.IO.Path]::GetFullPath((Join-Path $fileDir $link))
        }

    # strip query/fragment
    if ($resolved -match '\?') { $resolved = $resolved.Split('?')[0] }
        if ($resolved -match '#') { $resolved = $resolved.Split('#')[0] }

        $exists = Test-Path -Path $resolved -PathType Leaf
        if (-not $exists -and (Test-Path -Path $resolved -PathType Container)) {
            if (Test-Path -Path (Join-Path $resolved 'index.php')) { $exists = $true; $resolved = (Join-Path $resolved 'index.php') }
            elseif (Test-Path -Path (Join-Path $resolved 'index.html')) { $exists = $true; $resolved = (Join-Path $resolved 'index.html') }
        }

        if (-not $exists) {
            $missing += [PSCustomObject]@{
                Source = $f.FullName
                Link = $link
                Resolved = $resolved
            }
        }
    }
}

$reportPath = Join-Path $root 'tools\\missing_links_report.txt'
"Project root: $root`nTotal files scanned: $($files.Count)`nTotal links found (candidate local links): $totalLinks`nMissing links: $($missing.Count)`n" | Out-File -FilePath $reportPath -Encoding UTF8

if ($missing.Count -gt 0) {
    "Missing links report:" | Out-File -FilePath $reportPath -Append -Encoding UTF8
    $missing | ForEach-Object {
        "Source: $($_.Source)`n  Link: $($_.Link)`n  Resolved: $($_.Resolved)`n" | Out-File -FilePath $reportPath -Append -Encoding UTF8
    }
}

Write-Host "Scanned $($files.Count) files. Found $totalLinks local link candidates. Missing: $($missing.Count). Report saved to $reportPath"
if ($missing.Count -gt 0) { Write-Host "First 20 missing entries:"; $missing | Select-Object -First 20 | Format-Table -AutoSize }
else { Write-Host "No missing local files detected by this scan." }
