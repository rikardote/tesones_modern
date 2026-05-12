#!/bin/bash
set -e

# Configurar zona horaria del sistema
export TZ=America/Tijuana
ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Ajustar permisos para Laravel
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Iniciar el proceso principal
if [ "$#" -gt 0 ]; then
    echo "Ejecutando comando: $@"
    exec "$@"
else
    echo "Iniciando PHP-FPM..."
    exec php-fpm
fi
