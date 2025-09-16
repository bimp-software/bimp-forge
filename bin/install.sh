#!/bin/bash
set -e

echo "🔧 Iniciando instalación de Bimp-Forge..."

# ========== Helpers ==========
fail() { echo "❌ $1"; exit 1; }
info() { echo "ℹ️ $1"; }
ok()   { echo "✔ $1"; }

# ========== 1) PHP y extensiones ==========
command -v php >/dev/null 2>&1 || fail "PHP no está instalado o no está en el PATH."
PHP_VERSION=$(php -r 'echo PHP_VERSION;')
MIN_VERSION="8.1.0"

# compara versiones (sort -V disponible en Linux/mac; en Windows usa Git Bash/WSL)
if [ "$(printf '%s\n' "$MIN_VERSION" "$PHP_VERSION" | sort -V | head -n1)" != "$MIN_VERSION" ]; then
  fail "Se requiere PHP >= $MIN_VERSION. Tienes $PHP_VERSION"
fi
ok "PHP $PHP_VERSION OK (mínimo $MIN_VERSION)"

# Extensiones requeridas por tu clase
REQ_EXT=("openssl" "mbstring" "pdo" "pdo_mysql")
for ext in "${REQ_EXT[@]}"; do
  php -m | grep -q -i "^$ext$" || fail "Falta extensión PHP: $ext"
done
ok "Extensiones OK: ${REQ_EXT[*]}"

# ========== 2) Crear carpetas base (si quieres mantener estructura) ==========
for dir in cache logs storage; do
  if [ ! -d "$dir" ]; then
    mkdir -p "$dir"
    echo "📁 Creada carpeta: $dir"
  else
    info "Carpeta ya existe: $dir"
  fi
done

# ========== 3) Generar .env si no existe (mismo contenido que tu Install::default()) ==========
if [ ! -f ".env" ]; then
  # project = nombre de la carpeta actual (equivalente aproximado a tu getProject())
  PROJECT="$(basename "$PWD")"
  PROJECT_LOGO="${PROJECT}.png"

  # Claves usando tu función generate_key() si existe; si no, fallback con OpenSSL
  GEN_KEY_PHP='
    $f="storage/src/forge/function/bimp_core.php";
    if (is_file($f)) { require $f; if (function_exists("generate_key")) { echo generate_key(); exit; } }
    // fallback
    echo base64_encode(random_bytes(32));
  '

  KEY_PUBLIC=$(php -r "$GEN_KEY_PHP" 2>/dev/null || true)
  KEY_PRIVATE=$(php -r "$GEN_KEY_PHP" 2>/dev/null || true)

  if [ -z "$KEY_PUBLIC" ] || [ -z "$KEY_PRIVATE" ]; then
    # fallback bash si PHP falla por alguna razón muy rara
    command -v openssl >/dev/null 2>&1 || fail "No se pudieron generar claves y no hay OpenSSL disponible."
    KEY_PUBLIC=$(openssl rand -base64 32)
    KEY_PRIVATE=$(openssl rand -base64 32)
  fi

  # OJO: respetamos exactamente las claves y campos de tu default(), incluso el charset "uft-8"
  cat > .env <<ENV
#Nombre del proyecto principal no modificar
NAME_PROYECTO    = "${PROJECT}"
LOGO_PROYECTO    = "${PROJECT_LOGO}"
VERSION_PROYECTO = "1.0.0"
IS_DEMO          = true

# Datos de la empresa / negocio / sistema

SITE_LANG        = "es"
SITE_CHARSET     = ""
SITE_NAME        = ""
SITE_VERSION     = ""
SITE_LOGO        = ""
SITE_FAVICON     = ""
SITE_DESC        = ""
                    
# Set para conexión en producción o servidor real
DB_ENGINE  = "mysql"
DB_HOST    = "localhost"
DB_NAME    = ""
DB_USER    = "root"
DB_PASS    = ""
DB_CHARSET = "uft-8"

#Css framework a utilizar
CSS_FRAMEWORK = "bs5" #bs4 | bs5 | tailwind | foundation | bulma | materialize | uikit | none 

#Keys para consumos de la API de esta instancia de bimp forge
#puedes generarlas en bimp/generate
API_PUBLIC_KEY  = "${KEY_PUBLIC}"
API_PRIVATE_KEY = "${KEY_PRIVATE}"

#Salt utilizada para agregar seguridad al hash de contraseñas dependiendo el uso requerido
AUTH_SALT = ""

# Define si es requeria autenticacion para consumir los recursos de la API
#programaticamente se define que recursos son accesibles sin autenticación
#Por defecto true | false para consumir la API sin autenticacion | no recomendado 
API_AUTH = true

#Sesiones de usuario persistentes
FORGE_USERS_TABLE     = "_users"         #Nombre de la tabla para autenticación de usuarios
FORGE_COOKIES         = true               #Es utilizada para determinar si se usarán sesiones persistentes con cookies en el sistema
FORGE_COOKIE_ID       = "forge__cookie_id"  #Nombre del cookie para el identificador de usuario
FORGE_COOKIE_TOKEN    = "forge__cookie_tkn" # Nombre del cookie para el token generado para usuario
FORGE_COOKIE_LIFETIME = '60 * 60 * 24 * 7'
FORGE_COOKIE_PATH     = '/'
FORGE_COOKIE_DOMAIN   = ""

#Utilidades
JQUERY      = true
VUEJS       = true
AXIOS       = false
SWEETALERT2 = true
TOASTR      = true
WAITME      = true
LIGHTBOX    = false

USE_TWIG = false #define si será usado Twig por defecto para renderizar las vistas

CORREO_EMPRESA = ""
CLAVE_EMPRESA = ""

DEFAULT_CONTROLLER = "home"
DEFAULT_METHOD     = "index"

PHPMAILER_TEMPLATE = 'emailTemplate'

GMAPS = ""
ENV
  ok "Archivo .env creado correctamente"
else
  info "Archivo .env ya existe (saltado)"
fi

# ========== 4) Composer install (si hay composer.json) ==========
if [ -f "composer.json" ]; then
  if command -v composer >/dev/null 2>&1; then
    echo "📦 Ejecutando composer install..."
    composer install --no-interaction --prefer-dist
    ok "Composer install OK"
  elif [ -f "composer.phar" ]; then
    echo "📦 Ejecutando php composer.phar install..."
    php composer.phar install --no-interaction --prefer-dist
    ok "Composer (phar) install OK"
  else
    info "composer.json encontrado, pero Composer no está instalado (saltado)"
  fi
else
  info "No se encontró composer.json (saltado)"
fi

echo "✅ Instalación completada."
