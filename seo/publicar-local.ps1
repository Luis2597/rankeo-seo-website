# Publica los posts programados desde esta PC (alternativa al GitHub Action).
# Lo corre la tarea de Windows "Rankeo - publicar posts" lun/mie/vie 09:00.
# Solo toca blog/, sitemap.xml y llms.txt; el resto del repo no se commitea.
# Ojo: en PowerShell 5.1 git escribe avisos normales en stderr ("From https://...");
# con ErrorActionPreference=Stop eso se vuelve excepción. Por eso se usa Continue
# y se revisa $LASTEXITCODE de cada comando.
$ErrorActionPreference = 'Continue'
$repo = Split-Path -Parent $PSScriptRoot
Set-Location $repo
$log = Join-Path $PSScriptRoot 'publicar-local.log'
function Log($m) { "$(Get-Date -Format 's')  $m" | Add-Content -Encoding utf8 $log }
function Paso($nombre, $bloque) {
    $salida = & $bloque 2>&1 | Out-String
    if ($LASTEXITCODE -ne 0) { throw "$nombre fallo (codigo $LASTEXITCODE): $($salida.Trim())" }
    return $salida
}

try {
    Paso 'git pull' { git pull --rebase --autostash origin master } | Out-Null
    $salida = Paso 'publicar.py' { python seo/publicar.py }
    Log ($salida.Trim() -replace "`r?`n", ' | ')
    $cambios = git status --porcelain -- blog sitemap.xml llms.txt
    if (-not $cambios) { Log 'Nada que publicar hoy.'; exit 0 }
    Paso 'git add' { git add -- blog sitemap.xml llms.txt } | Out-Null
    $hoy = Get-Date -Format 'yyyy-MM-dd'
    Paso 'git commit' { git commit -m "Blog: publicar post programado ($hoy)" -- blog sitemap.xml llms.txt } | Out-Null
    Paso 'git push' { git push origin master } | Out-Null
    Log "Publicado y subido ($(git rev-parse --short HEAD))."
} catch {
    Log "ERROR: $_"
    exit 1
}
