#!/usr/bin/env bash
# =============================================================================
# audit-docs.sh — Auditoría de referencias obsoletas (stack aspiracional)
# Compatible: Linux, macOS (GNU sed), WSL. En macOS BSD sed, instalar: brew install gnu-sed → usar gsed.
#
# Uso:
#   ./audit-docs.sh              # Informe + comandos sed propuestos (sin modificar archivos)
#   ./audit-docs.sh --dry-run    # Igual (explícito)
#   ./audit-docs.sh --apply      # Solo *.md, *.txt, .env.example — crea backup *.bak
#
# NO modifica: .php, .js, .blade.php u otros fuentes (solo se listan hallazgos).
# =============================================================================

set -euo pipefail

readonly SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
readonly REPO_ROOT="${SCRIPT_DIR}"

readonly EXCLUDE_DIRS=(
  ".git" "node_modules" "vendor" "storage" "bootstrap/cache"
  "dist" "build" ".cache" "__pycache__" ".idea" ".vscode"
)

# Patrones de búsqueda (ERE). Incluye postgres para detectar menciones al motor en docs.
readonly SEARCH_PATTERN='frontend/|backend/|NestJS|nestjs|PostgreSQL|postgres\b|Prisma|Socket\.io|socket\.io|\bJWT\b|\bjwt\b'

APPLY=0

for arg in "$@"; do
  case "$arg" in
    --dry-run) APPLY=0 ;;
    --apply)   APPLY=1 ;;
    -h|--help)
      sed -n '2,18p' "$0"
      exit 0
      ;;
  esac
done

# Resolver comando sed in-place (preferir GNU sed)
if command -v gsed >/dev/null 2>&1; then
  SED_INPLACE=(gsed -i.bak)
elif sed --version >/dev/null 2>&1; then
  SED_INPLACE=(sed -i.bak)
else
  SED_INPLACE=()
fi

is_editable_file() {
  local f="$1"
  [[ "$f" =~ \.(md|txt)$ ]] || [[ "$(basename "$f")" == ".env.example" ]] || [[ "$f" =~ \.env\.example$ ]]
}

if [[ ! -r "${REPO_ROOT}" ]]; then
  echo "Error: sin permiso de lectura en ${REPO_ROOT}" >&2
  exit 1
fi

if [[ "${APPLY}" -eq 1 ]]; then
  if [[ ${#SED_INPLACE[@]} -eq 0 ]]; then
    echo "Error: se requiere GNU sed para --apply. Instale gsed (brew install gnu-sed) o use Linux/WSL." >&2
    exit 1
  fi
  if [[ ! -w "${REPO_ROOT}" ]]; then
    echo "Error: --apply requiere permisos de escritura." >&2
    exit 1
  fi
fi

echo "═══════════════════════════════════════════════════════════════════"
echo " Auditoría de documentación — referencias posiblemente obsoletas"
echo " Raíz del repo: ${REPO_ROOT}"
echo " Modo: $([[ "${APPLY}" -eq 1 ]] && echo 'APLICAR (solo .md, .txt, .env.example)' || echo 'SOLO LECTURA / vista previa')"
echo "═══════════════════════════════════════════════════════════════════"
echo

cd "${REPO_ROOT}"

FIND_EXCLUDE=()
for d in "${EXCLUDE_DIRS[@]}"; do
  FIND_EXCLUDE+=(-path "*/${d}" -prune -o)
done

# --- 1) Informe: hallazgos por archivo ---
echo "────────── Hallazgos por archivo (grep -n) ──────────"
FOUND=0
while IFS= read -r -d '' f; do
  if OUT=$(grep -E -n --color=never "${SEARCH_PATTERN}" "$f" 2>/dev/null); then
    FOUND=1
    echo
    echo "📄 ${f#${REPO_ROOT}/}"
    echo "${OUT}" | sed 's/^/  /'
  fi
done < <(find "${REPO_ROOT}" "${FIND_EXCLUDE[@]}" -type f \( \
  -name '*.md' -o -name '*.txt' -o -name '.env.example' -o -name '*.env.example' \
  -o -name '*.php' -o -name '*.js' -o -name '*.blade.php' \
  \) -print0 2>/dev/null)

if [[ "${FOUND}" -eq 0 ]]; then
  echo "(Sin coincidencias con los patrones actuales.)"
fi

echo
echo "────────── Archivos editables con coincidencias (.md / .txt / .env.example) ──────────"
EDITABLE_LIST=()
while IFS= read -r -d '' f; do
  if grep -E -q "${SEARCH_PATTERN}" "$f" 2>/dev/null && is_editable_file "$f"; then
    EDITABLE_LIST+=("$f")
    echo "  • ${f#${REPO_ROOT}/}"
  fi
done < <(find "${REPO_ROOT}" "${FIND_EXCLUDE[@]}" -type f \( \
  -name '*.md' -o -name '*.txt' -o -name '.env.example' -o -name '*.env.example' \
  \) -print0 2>/dev/null)

if [[ ${#EDITABLE_LIST[@]} -eq 0 ]]; then
  echo "  (Ningún archivo editable contiene los patrones.)"
fi

# Archivos donde NO aplicar sustituciones automáticas (contienen histórico deliberado)
EDITABLE_APPLY=()
for ef in "${EDITABLE_LIST[@]}"; do
  if [[ "$(basename "$ef")" == "LEGACY-VISION.md" ]]; then
    continue
  fi
  EDITABLE_APPLY+=("$ef")
done
if [[ ${#EDITABLE_LIST[@]} -gt ${#EDITABLE_APPLY[@]} ]]; then
  echo
  echo "  (Excluidos de sed/--apply: LEGACY-VISION.md — revisión manual.)"
fi

# --- 2) Reglas sed (conservadoras: rutas aspiracionales + marcadores LEGACY en tecnologías) ---
# No se reemplaza "PostgreSQL" genérico en .env (Laravel soporta pgsql); solo frases de stack antiguo.
declare -a SED_RULES=(
  's|^[[:space:]]*cd[[:space:]]\+frontend/*|cd kanban-sena|g'
  's|^[[:space:]]*cd[[:space:]]\+backend/*|cd kanban-sena|g'
  's|\.\./frontend/|../kanban-sena/|g'
  's|\.\./backend/|../kanban-sena/|g'
  's|stack PostgreSQL + Redis|stack documentado en README raíz (ver kanban-sena/)|g'
)

declare -a LEGACY_MARKERS=(
  's|NestJS|⚠️ LEGACY (NestJS — no implementado)|g'
  's|nestjs|⚠️ LEGACY (nestjs — no implementado)|g'
  's|Prisma|⚠️ LEGACY (Prisma — no implementado)|g'
  's|Socket\.io|⚠️ LEGACY (Socket.io — no implementado)|g'
  's|socket\.io|⚠️ LEGACY (socket.io — no implementado)|g'
  's|JWT|⚠️ LEGACY (JWT — no implementado; auth por sesión Laravel)|g'
)

build_sed_command_args() {
  SED_CMD_ARGS=()
  local r
  for r in "${SED_RULES[@]}" "${LEGACY_MARKERS[@]}"; do
    SED_CMD_ARGS+=(-e "$r")
  done
}

build_sed_command_args

echo
echo "────────── Comandos sed propuestos (GNU sed, backup -i.bak) ──────────"
echo "# Destino permitido: *.md, *.txt, .env.example"
echo "# Ejemplo manual equivalente a una pasada del script:"
echo "#   sed -i.bak -e 's/.../.../g' -e 's/.../.../g' ruta/archivo.md"
echo

for ef in "${EDITABLE_APPLY[@]}"; do
  rel="${ef#${REPO_ROOT}/}"
  echo "# --- ${rel} ---"
  printf 'sed -i.bak'
  for r in "${SED_RULES[@]}" "${LEGACY_MARKERS[@]}"; do
    printf " -e %q" "$r"
  done
  printf ' %q\n' "$rel"
done

if [[ ${#EDITABLE_APPLY[@]} -eq 0 ]]; then
  echo "# (Sin archivos destino para sed automático; revise exclusiones o patrones.)"
fi

echo
echo "────────── Rollback manual ──────────"
echo "  mv archivo.md.bak archivo.md   # restaurar copia previa (GNU sed crea archivo.bak)"
echo "  rm -f archivo.md.bak"

# Vista previa tipo diff (sin escribir archivos): solo primer archivo editable
if [[ "${APPLY}" -eq 0 ]] && [[ ${#EDITABLE_APPLY[@]} -gt 0 ]] && [[ ${#SED_CMD_ARGS[@]} -gt 0 ]]; then
  echo
  echo "────────── Vista previa (diff unificado, primer archivo aplicable) ──────────"
  FIRST="${EDITABLE_APPLY[0]}"
  sed "${SED_CMD_ARGS[@]}" "$FIRST" | diff -u "$FIRST" - | sed 's/^/  /' || true
fi

# --- 3) Aplicar con --apply ---
if [[ "${APPLY}" -eq 1 ]]; then
  echo
  echo "⚠️  Aplicando reemplazos (GNU sed -i.bak) solo en .md / .txt / .env.example ..."
  for ef in "${EDITABLE_APPLY[@]}"; do
    rel="${ef#${REPO_ROOT}/}"
    if [[ ! -w "$ef" ]]; then
      echo "  Omitido (sin escritura): ${rel}" >&2
      continue
    fi
    "${SED_INPLACE[@]}" "${SED_CMD_ARGS[@]}" "$ef"
    echo "  OK: ${rel}"
  done
  echo
  echo "Revise los cambios con git diff. El respaldo de cada archivo tiene sufijo .bak"
else
  echo
  echo "ℹ️  Sin cambios en disco. Para aplicar sustituciones automáticas en documentación:"
  echo "   ./audit-docs.sh --apply"
fi

echo
echo "Nota: hallazgos en .php / .js / .blade.php solo se listan; edítelos manualmente si aplica."
exit 0
