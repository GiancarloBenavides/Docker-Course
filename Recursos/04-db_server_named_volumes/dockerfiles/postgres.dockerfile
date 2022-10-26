# PostgreSQL
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
# Imagen principal 
FROM postgres:15.0
# Imagen Opcional 
# FROM bitnami/postgresql:14
# El uid y gid del usuario en el host debe ser igual al uid de postgres
RUN groupmod -g 1000 postgres
RUN usermod -u 1000 postgres
# Establece los permisos para que el servidor pueda crear los volumenes 
RUN chown -R 1000:1000 /var/lib/postgresql/data
RUN chmod -R 750 /var/lib/postgresql/data
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 5432