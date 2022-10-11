# NGINX
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM nginx
# Imagen Opcional 
# FROM debian:11
# Instalacion de php y conector posgre en el servidor web
RUN apt-get update && apt-get install -y php7.2-fpm php-pgsql