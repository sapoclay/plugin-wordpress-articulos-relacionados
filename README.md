# plugin-wordpress-articulos-relacionados
Este es un  plugin para Wordpress que muestra artículos relacionados (segun el TAG) en la mitad del artículo.

![articulos-relacionados](https://user-images.githubusercontent.com/6242827/215624691-f760e93c-c137-4de6-a17c-4b9c6723c5f7.jpg)

Tengo que decir que este plugin va a calcular el número de párrafos que se muestran dentro de la página del artículo. Después va a posicionar los artículos relacionados justo después de la mitad. Además añadí algo de CSS con lo que estilizar un poco los enlaces que se van a ver. Todo se hace desde un único archivo llamado index.php. 

Si el interesado en utilizar este plugin quiere cambiar el lugar en el que aparecen los artículos relacionados, basta con cambiar el valor 2 de la siguiente línea, que se muestra en el anterior código:

`$insert_point = floor(count($paragraphs) / 2);`

Tengo que decir que este plugin se puede configurar en algunos aspectos, pero no le he añadido una interfaz gráfica. Por eso cualquier modificacion debe hacerse mediante código.

**Una vez guardado el archivo index.php en nuestro equipo, solo tendremos que subir la carpeta del plugin (en la que tengamos guardado el archivo index.php) a nuestro hosting vía FTP, a la carpeta «plugins» de nuestra instalación de Wordpress**. O también se puede comprimir la carpeta en la que está nuestro plugin y utilizar el instalador de paquetes de Wordpress. Una vez instalado el plugin, tendremos que activarlo en el listado de plugins de nuestra CMS.
