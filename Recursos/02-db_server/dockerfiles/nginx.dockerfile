# NGINX
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM nginx
# Imagen Opcional 
# FROM debian:11

RUN sudo apt install php7.2-fpm 