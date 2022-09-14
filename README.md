# Docker-Course
<p><code>Fundamentos de docker para sistemas operativos</code></p>
<p>Creado por <code>Giancarlo Ortiz</code> para explicar los fundamentos de los <code>Sistemas operativos</code></p>

## Instrumentos
Un instrumento de docker es un documento escrito que permite al motor de docker informar las opciones de compilación de imágenes y puesta en marcha de contenedores.

## Agenda
1. [Dockerfile](#1-dockerfile).
1. [Manifiesto](#2-manifiesto).
1. [Punto de entrada](#3-punto-de-entrada).

<br>

---
# 1. Dockerfile
Un [dockerfile][1_0] es un documento de texto plano que contiene los comandos para agregar como una capa de software multiples elementos a una imagen base y ensamblar una nueva imagen de docker.

* ><i>"Sigo a mucha gente, porque tengo mucho que aprender."</i><br>
<cite style="display:block; text-align: right">[Salomón Hykes](https://fr.wikipedia.org/wiki/Solomon_Hykes)</cite>

[1_0]:https://docs.docker.com/engine/reference/builder/


## <code>Ejemplo:</code> dockerfile

```sh
# NGINX + SSH
# Opciones de construcción de la imagen
# -------------------------------------
# Imagen base de la imagen que construye el dockerfile
FROM debian:11
# Instalación de el servidor web
RUN apt-get update && apt-get install -y nginx openssh-server
# Copia de los archivos que se van a servir
# Expone los puertos a los que es dirigido los servicios TCP
EXPOSE 22
EXPOSE 80
```


## 1.1 Compilación 
En la compilación del dockerfile el motor de docker ejecuta cada instrucción en el archivo en secuencia, si la imagen base no esta almacenada la descarga y sobre ella realiza todas las actualizaciones en sucesión automatizada hasta obtener una nueva imagen de docker almacenada localmente.

><b>Nota:</b> Esta imagen nueva se puede almacenar en tu cuenta de [docker-hub][11_0] y publicar para compartir con otros usuarios de docker.

[11_0]:https://hub.docker.com/


## <code>Ejemplo:</code> build from dockerfile

```sh
# Docker build -t [name_image:tag_image]
docker build -t web:10
```


# 2. Manifiesto
Un [Manifiesto][2_0] es un documento de texto que contiene los comandos para configurar y ejecutar un contenedor a partir de una imagen de Docker utilizando docker compose.

* ><i>"Siempre encuentro a la gente más inteligente que yo. Entonces mi trabajo es asegurarme de que la gente inteligente pueda trabajar junta. Y es que la gente estúpida puede trabajar junta fácilmente, la gente inteligente no."</i><br>
<cite style="display:block; text-align: right">[Jack Ma](https://es.wikipedia.org/wiki/Jack_Ma)</cite>

[2_0]:https://docs.docker.com/compose/gettingstarted/


## <code>Ejemplo:</code> docker-compose.yaml

```yml
version: "3.9" # optional since v1.27.0

# Declaración de redes   
networks:
    # Red para los contenedores (back-tier es un label)
    back-tier:
        # Nombre de la red
        name: red_org
        # Tipo de red
        driver: bridge
            # Gestión IP 
            ipam:
                driver: default
                config:
                    subnet: 192.168.1.0/24
                    gateway: 192.168.1.254

# Declaración de servicios
services:
    # Contenedor del servicio WEB (http es un label)
    http:
        # Nombre del contenedor
        container_name: nginx_ctn
        # Opciones de restart: "no" | always | on-failure | unless-stopped
        restart: "no"
        build:
            # Ruta de la carpeta con el dockerfile de la imagen a construir
            context: ./http
            # Nombre del archivo dockerfile
            dockerfile: Dockerfile
        # Puertos que serán expuestos en ejecución
        ports:
            - "8000:80"
        # Redes a las que se conectara el contenedor
        networks:
            back-tier:
                aliases:
                    - nginx.host
```


## 2.1 Ejecución 
En la ejecución de un docker-compose el [motor de docker][21_0] ejecuta uno o varios contenedores de una o varias imágenes cumpliendo con todas las opciones manifestadas en el archivo Yaml, esto puede incluir configuraciones de la red o redes a las que se conecta cada contenedor.

><b>Nota:</b> Es posible ejecutar un contenedor a partir de una imagen sin la ayuda de compose, pero compose facilita la legibilidad y gestión del código.

[21_0]:https://docs.docker.com/engine/

## <code>Ejemplo:</code> run from docker-compose.yml

```sh
# Run docker-without-compose
docker run --name ng-server \
-p 8000:80 \
-p 8022:20 \
web:10
# Stop docker-without-compose
docker stop ng-server
# Remove docker-without-compose
docker rm ng-server
# Run docker-compose
docker compose up
# Stop docker-compose
docker compose -f ./docker-compose.yml down
```


# 3. Punto de entrada
Un [entry_point][3_0] es un documento de texto plano que incluye una secuencia de comandos simple o [script][3_1] de sistema en un lenguaje que es soportado por el sistema operativo en el contenedor. 

Este punto de entrada puede o no iniciar la ejecución de uno o varios <i>Disk And Execution Monitor</i> ([daemon][3_2]) para ejecutar servicios en segundo plano; en caso contrario el contenedor terminara su ejecución al finalizar la ultima tarea solicitada.

* ><i>"Siempre encuentro a la gente más inteligente que yo. Entonces mi trabajo es asegurarme de que la gente inteligente pueda trabajar junta. Y es que la gente estúpida puede trabajar junta fácilmente, la gente inteligente no."</i><br>
<cite style="display:block; text-align: right">[Jack Ma](https://es.wikipedia.org/wiki/Jack_Ma)</cite>

[3_0]:https://es.wikipedia.org/wiki/Punto_de_entrada_(inform%C3%A1tica)/
[3_1]:https://es.wikipedia.org/wiki/Script
[3_2]:https://es.wikipedia.org/wiki/Daemon_(inform%C3%A1tica)/


## <code>Ejemplo:</code> build from dockerfile

```sh
# Inicia el servidor SSH
service ssh start
# Inicia el servidor HTTP
service nginx start
# Inicia el log de visitas por HTTP y se queda a la espera de nuevas entradas
tail -F /var/log/nginx/access.log

```

## 3.1 Modos de Ejecución 
Si no se incluye el modificador `-d` al comando `docker run` la salida estándar [STDOUT][31_0] del proceso **punto de entrada** en el contenedor queda vinculada (attached) a la terminal de comandos; si se incluye este la terminal termina el comando pero el contenedor seguirá corriendo en segundo plano, pero aun se puede ejecutar comandos en un contenedor corriendo en segundo plano.

><b>Nota:</b> Incluso es posible ejecutar una terminal interactiva dentro del contenedor.

[31_0]:https://es.wikipedia.org/wiki/Entrada_est%C3%A1ndar


## <code>Ejemplo:</code> execute command in running container

```sh
# Run container in detach mode with docker
docker run --name ng-server \
-p 8000:80 \
-p 8022:20 \
-d web:10
# Run docker-compose in detach mode 
docker compose up -d
# Execute CLI terminal in a running container
docker exec –i ng-server /bin/bash
```


---
## Mas Recursos
- [Docker](https://es.wikipedia.org/wiki/Docker_(software)) (Wikipedia)
- [Motor de software](https://en.wikipedia.org/wiki/Software_engine) (Wikipedia)
- [Comandos Linux terminal](https://es.wikipedia.org/wiki/Comandos_Bash) (Wikipedia)
- [Servicios en SO Windows](https://es.wikipedia.org/wiki/Servicio_de_Windows) (Wikipedia)
- [Daemon en SO Linux](https://es.wikipedia.org/wiki/Daemon_(inform%C3%A1tica)/) (Wikipedia)

