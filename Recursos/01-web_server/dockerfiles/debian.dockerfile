# NGINX + SSH
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM debian:11
# Instalacion de el servidor web
RUN apt-get update && apt-get install -y nginx openssh-server
# Copia de los archivos que se van a servir
COPY ./volumes/www/organization.org /var/www/organization.org
# Establece los permisos para que el servidor pueda servir los archivos
RUN chmod -R 755 /var/www & chown -R $USER:$USER /var/www
# Copia de los archivos de configuracion del host virtual de nginx
COPY ./config/organization.org.conf /etc/nginx/sites-available
COPY ./config/default /etc/nginx/sites-available
COPY ./config/services_start.sh /
# Establece los permisos para la ejecucion de los servicios
RUN chmod -R 777 ./services_start.sh && chown -R $USER:$USER ./services_start.sh
# Copia simbolica para habilitar los sitios
RUN ln -s /etc/nginx/sites-available/organization.org.conf /etc/nginx/sites-enabled/
# Inicio del servicio web
ENTRYPOINT /services_start.sh
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 22
EXPOSE 80