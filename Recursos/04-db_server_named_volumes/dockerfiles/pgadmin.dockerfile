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
RUN chown -R $USER:$USER /pgadmin4/servers.json
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 80