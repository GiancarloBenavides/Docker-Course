# PGADMIN
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM dpage/pgadmin4
# Imagen Opcional 
# FROM dpage/pgadmin4:5.6
# Copia de los archivos de configuracion del host virtual de nginx
COPY ./config/servers.json /pgadmin4/