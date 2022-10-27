# PostgreSQL
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
# Imagen principal 
FROM postgres:15.0
# Imagen Opcional 
# FROM bitnami/postgresql:14
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 5432