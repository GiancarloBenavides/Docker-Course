# NGINX + PHP
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM nginx
# Imagen Opcional 
# FROM debian:11
# Instalacion de php y conector posgre en el servidor web
RUN apt-get update && apt-get install -y php-fpm && apt-get install -y php-pgsql
# Copia de los archivos de configuracion del host virtual de nginx
COPY ./config/nginx.conf /etc/nginx
COPY ./config/default.conf /etc/nginx/conf.d
COPY ./config/organization.org.conf /etc/nginx/conf.d
#COPY ./config/www.conf /etc/php/7.4/fpm/pool.d
COPY ./config/services_start.sh /docker-entrypoint.d
# Habilita la estension pgsql en php.ini
RUN sed -i 's/;extension=pgsql/extension=pgsql/g' /etc/php/7.4/fpm/php.ini
# Establece los permisos para la ejecucion de los servicios
RUN mkdir /var/log/nginx/organization.org
RUN chown -R $USER:$USER /var/log/nginx/organization.org
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 80