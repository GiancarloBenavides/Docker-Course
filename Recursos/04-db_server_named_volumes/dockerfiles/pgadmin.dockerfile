# PgAdmin 4
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM dpage/pgadmin4:6.15
# Imagen Opcional 
# FROM dpage/pgadmin4:6
# Copia de los archivos de configuracion de los servidores al administrador
COPY ./config/servers.json /pgadmin4/
# Establece los permisos para que el servidor pueda crear los volumenes
USER root
RUN chown -R pgadmin:0 /pgadmin4/servers.json
USER postgres
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 80