# Publica los posts programados desde esta PC (alternativa al GitHub Action).
# Lo corre la tarea de Windows "Rankeo - publicar posts" lun/mie/vie 09:00.
# Solo toca blog/, sitemap.xml y llms.txt; el resto del repo no se commitea.
$ErrorActionPreference = 'Stop'
$repo = Split-Path -Parent $PSScriptRoot
Set-Location $repo
$log = Join-Path $PSScriptRoot 'publicar-local.log'
function Log($m) { "$(Get-Date -Format 's')  $m" | Add-Content -Encoding utf8 $log }

try {
    git pull --rebase --autostash origin master 2>&1 | Out-Null
    $salida = python seo/publicar.py 2>&1 | Out-String
    Log ($salida.Trim() -replace "`r?`n", ' | ')
    $cambios = git status --porcelain -- blog sitemap.xml llms.txt
    if (-not $cambios) { Log 'Nada que publicar hoy.'; exit 0 }
    git add -- blog sitemap.xml llms.txt
    $hoy = Get-Date -Format 'yyyy-MM-dd'
    git commit -m "Blog: publicar post programado ($hoy)" -- blog sitemap.xml llms.txt | Out-Null
    git push origin master 2>&1 | Out-Null
    Log "Publicado y subido ($(git rev-parse --short HEAD))."
} catch {
    Log "ERROR: $_"
    exit 1
}
