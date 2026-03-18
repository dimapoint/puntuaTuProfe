#!/bin/bash

# Script de Despliegue Automatizado para puntuaTuProfe
# Uso: ./deploy.sh

set -e # Detener el script si ocurre un error

echo "🚀 Iniciando despliegue..."

# 1. Activar modo mantenimiento (Opcional, evita errores de usuarios durante el proceso)
php artisan down || true

# 2. Descargar los últimos cambios de Git
echo "📥 Descargando cambios de Git..."
git pull origin main

# 3. Instalar/Actualizar dependencias de PHP (Optimizado para producción)
echo "🐘 Instalando dependencias de PHP..."
composer install --no-dev --optimize-autoloader

# 4. Instalar dependencias de JS y generar el Build con Bun
echo "⚡ Generando assets con Bun..."
bun install
bun run build

# 5. Ejecutar migraciones de base de datos
echo "🗄️ Ejecutando migraciones..."
php artisan migrate --force

# 6. Optimizar Cache de Laravel
echo "✨ Optimizando caches de rendimiento..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 7. Limpiar archivos temporales y antiguos
echo "🧹 Limpiando temporales..."
php artisan cache:clear

# 8. Desactivar modo mantenimiento
php artisan up

echo "✅ ¡Despliegue completado con éxito!"
