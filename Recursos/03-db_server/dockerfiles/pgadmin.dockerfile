# PgAdmin 4
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM dpage/pgadmin4:6.15
# Imagen Opcional 
# FROM dpage/pgadmin4:6
# El uid y gid del usuario en el host debe ser igual al uid de postgres
USER root
RUN useradd --uid 1000 -U postgres
# Copia de los archivos de configuracion de los servidores al administrador
COPY ./config/servers.json /pgadmin4
# # Establece los permisos para que el servidor pueda crear los volumenes
RUN chown -R 1000:1000 /var/lib/pgadmin
RUN chown -R 1000:1000 /pgadmin4/config_distro.py
RUN chown -R 1000:1000 /pgadmin4/servers.json
RUN chmod -R 750 /var/lib/pgadmin
USER postgres
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 80