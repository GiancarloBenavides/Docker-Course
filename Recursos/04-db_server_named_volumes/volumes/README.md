# Docker-Course
<p><code>Fundamentos de docker para sistemas operativos</code></p>
<p>Creado por <code>Giancarlo Ortiz</code> para explicar los fundamentos de los <code>Sistemas operativos</code></p>

## Volúmenes nombrados
Las carpetas compartidas son una gran solución cuando se desea acceder fácilmente a los datos del contenedor desde el host, pero son substancialmente de menor rendimiento; por ello es deseable los volúmenes nombrados sobre las carpetas compartidas para persistir los datos del contenedor mas allá del ciclo de vida del mismo.

Aunque Docker-compose permite declarar un volumen nuevo en el manifiesto, también es posible crear el volumen previamente

```sh
# Para crear un volumen en el anfitrión antes de lanzar un contenedor con Docker run o Docker compose
# docker volume create <nombre-del-volumen>
docker volume create db-data
docker volume create db-admin
```

>Nota: adicionalmente los volúmenes no necesitan permisos especiales en el anfitrión y se pueden gestionar por completo desde el contenedor

Si se desea acceder a los datos del volumen desde el anfitrión se tienen dos opciones:

* Montar el volumen en un contenedor básico.
* Acceder a los datos del volumen en el espacio de docker.

```sh
# Para listar los volúmenes creados
docker volume ls

# Para inspeccionar los puntos de montaje de un volumen
docker volume inspect db-data
docker volume inspect db-admin

# Para montar los volúmenes creados en ubuntu
docker run -v db-data:/temp/db-admin -v db-admin:/tmp/db-data ubuntu

# Para acceder a los datos del volumen en GNU/Linux
cd /var/lib/docker/volumes/db-data/_data
cd /var/lib/docker/volumes/db-admin/_data

# Para acceder a los datos del volumen en MS/Windows
cd "\\wsl$\docker-desktop-data\version-pack-data\community\docker\volumes\db-data\_data"
cd "\\wsl$\docker-desktop-data\version-pack-data\community\docker\volumes\db-admin\_data"
```

---
## Mas Recursos
- [Docker](https://es.wikipedia.org/wiki/Docker_(software)) (Wikipedia)
- [Motor de software](https://en.wikipedia.org/wiki/Software_engine) (Wikipedia)
- [Comandos Linux terminal](https://es.wikipedia.org/wiki/Comandos_Bash) (Wikipedia)
- [Servicios en SO Windows](https://es.wikipedia.org/wiki/Servicio_de_Windows) (Wikipedia)
- [Daemon en SO Linux](https://es.wikipedia.org/wiki/Daemon_(inform%C3%A1tica)/) (Wikipedia)

