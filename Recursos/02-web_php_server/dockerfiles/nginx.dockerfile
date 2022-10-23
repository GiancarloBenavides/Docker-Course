# NGINX
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM nginx
# Imagen Opcional 
# FROM debian:11
# Instalacion de php y conector posgre en el servidor web
RUN apt-get update && apt-get install -y php-fpm
# Copia de los archivos de configuracion del host virtual de nginx
COPY ./config/nginx.conf /etc/nginx
COPY ./config/default.conf /etc/nginx/conf.d
COPY ./config/organization.org.conf /etc/nginx/conf.d
#COPY ./config/www.conf /etc/php/7.4/fpm/pool.d