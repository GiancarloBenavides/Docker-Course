# Docker-Course
<p><code>Fundamentos de docker para sistemas operativos</code></p>
<p>Creado por <code>Giancarlo Ortiz</code> para explicar los fundamentos de los <code>Sistemas operativos</code></p>

## Vinculación de carpetas
Cuando se desea compartir carpetas entre la maquina anfitrión y los contenedores (Host - container) existen tres posibilidades o casos de uso, según sea el sistema de archivos usado en cada uno de los sistemas:

1. __EL anfitrión es tipo Unix:__
y las dos unidades de almacenamiento se encuentran formateadas en un sistema que soporta permisos unix en cuyo caso es muy fácil establecer la propiedad y los permisos que requiera el contenedor para la carpeta compartida.

```sh
# En el anfitrión y en el contenedor
chown -R $USER:$USER /Path/to/data
chmod -R 750 /Path/to/data
```

2. __EL anfitrión no es tipo Unix (Windows):__
y la unidad de almacenamiento del anfitrión conde se creara el recurso compartido se encuentra formateada en un sistema como __NTFS__, que no soportan los permisos de UNIX; en este caso [__WSL__][1] donde funciona el anfitrión emulara y permitirá gestionar los permisos requeridos por el contenedor para la carpeta compartida.

```sh
# En el contenedor (dockerfile)
chown -R $USER:$USER /Path/to/data
chmod -R 750 /Path/to/data
```

3. __EL anfitrión es tipo Unix:__
y la unidad de almacenamiento del anfitrión conde se creara el recurso compartido es externa (_disco USB_) se encuentra formateada en un sistema como __NTFS__, que no soportan los permisos de UNIX; en este caso esta unidad se debe montar con las opciones personalizadas para [__umask__][2] requeridas por el contenedor porque luego de montar la unidad no sera posible modificar los permisos rwx. Para esto en el archivo [/etc/fstab][3] del anfitrión agregar una línea como:


```sh
# --------------------------->
# USB was on /dev/sddx opciones personalizadas de umask
UUID=8EA0A84DA0A83D99 /media/gncdev/WORK ntfs-3g defaults,umask=027,uid=1000,gid=1000    0    0
```

```sh
# En el contenedor (dockerfile)
chown -R $USER:$USER /Path/to/data
chmod -R 750 /Path/to/data
```

[1]:https://es.wikipedia.org/wiki/Subsistema_de_Windows_para_Linux
[2]:https://es.wikipedia.org/wiki/Umask
[3]:https://es.wikipedia.org/wiki/Fstab

---
## Mas Recursos
- [Docker](https://es.wikipedia.org/wiki/Docker_(software)) (Wikipedia)
- [Motor de software](https://en.wikipedia.org/wiki/Software_engine) (Wikipedia)
- [Comandos Linux terminal](https://es.wikipedia.org/wiki/Comandos_Bash) (Wikipedia)
- [Servicios en SO Windows](https://es.wikipedia.org/wiki/Servicio_de_Windows) (Wikipedia)
- [Daemon en SO Linux](https://es.wikipedia.org/wiki/Daemon_(inform%C3%A1tica)/) (Wikipedia)

