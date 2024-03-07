# El protocolo HTTP

###### Daniel Alconchel Vázquez

---

**Ejercicio 1: Petición web con cURL**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-17-49-27-Captura%20desde%202024-03-04%2017-47-23.png)

Con el primer comando solo podemos ver el cuerpo de la respuesta, por lo que no podemos comentar nada sobre los encabezados de HTTP.

Con el segundo comando, podemos ver que hay una primera parte donde se construye la petición HTTP. En dicha petición, vemos que en la primera línea se muestra que se trata de una petición `GET`, después sigue el encabezado, donde se muestra el host al que se manda la petición, y el agente usado para mandarlo, que en este caso es `curl`, además de especificar el tipo de contenido que puede aceptar y procesar el cliente (`*/*`). Por último, hay una línea en blanco. A continuación, podemos ver el mensaje de respuesta de HTTP, que sigue una estructura similar. Tiene una primera línea, donde se muestra el protocolo usado y el estado de la respuesta, después, aparecen los encabezados, con la información que podemos ver en la captura y, por último, una línea en blanco, seguido del cuerpo de la respuesta.

**Ejercicio 2: Redirecciones con cURL**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-02-46-Captura%20desde%202024-03-04%2018-02-16.png)

Como podemos ver, no nos redirige automáticamente y nos muestra el código de estado 301 de HTTP, que suele usarse cuando ocurre un cambio de HTTP a HTTPS

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-07-30-Captura%20desde%202024-03-04%2018-05-30.png)

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-07-41-Captura%20desde%202024-03-04%2018-07-16.png)

Como podemos ver, esta vez si hace la redirección.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-08-49-Captura%20desde%202024-03-04%2018-08-30.png)

**Ejercicio 3: Añadiendo encabezados sobre compresión gzip con cURL**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-13-17-Captura%20desde%202024-03-04%2018-11-04.png)

Podemos ver que evita escribir la información binaria en la consola, tal y como indica el guión.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-13-54-Captura%20desde%202024-03-04%2018-12-54.png)

Esta vez, le forzamos a hacerlo con `--output`. Veamos el fichero descomprimido:

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-15-32-Captura%20desde%202024-03-04%2018-15-21.png)

Probamos, por último, la opción `--compressed` para descomprimir la información y verla directamente en consola:

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-16-50-Captura%20desde%202024-03-04%2018-16-06.png)

**Ejercicio 4: Añadiendo encabezados sobre conexiones persistentes con cURL**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-19-59-Captura%20desde%202024-03-04%2018-19-23.png)

Vemos que, en la segunda petición, se indica *Re-using existing connection!...*, lo que indica que se mantuvo la misma conexión TCP/IP.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-22-17-Captura%20desde%202024-03-04%2018-22-09.png)

Podemos apreciar en la captura que hemos deshabilitado la opción de reutilizar la misma conexión. También podemos ver que indica con `#n` el número de la conexión, siendo el de la primera 0 y el de la segunda 1.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-23-53-Captura%20desde%202024-03-04%2018-23-44.png)

Vemos, por último, que de esta forma si hace uso de las conexiones persistentes.

**Ejercicio 5: Averiguar el software que usa un servidor web**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-33-17-Captura%20desde%202024-03-04%2018-30-59.png)

Podemos ver que realiza una redirección de http a https. Si desglosamos la segunda cabecera, podemos ver que `Server: Apache/2.4.52(Ubutnu)`, indicandonos que se trata de un servidor apache en ubuntu. Por otro lado, vemos que también se hace una petición para descargar el icono de página.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-39-01-Captura%20desde%202024-03-04%2018-38-20.png)

Podemos ver que esta página web hace muchas solicitudes, para descargar todo los recursos necesarios de la página. En la cabecera podemos ver que se trata de un servidor `nginx`.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-42-18-Captura%20desde%202024-03-04%2018-42-04.png)

Vemos que hace una redirección de http a https, además, el código 302 de la segunda petición, indica una redirección a una nueva ubicación temporal. Podemos ver que se trata de un servidor Apache y, como en el caso anterior, hace múltiples peticiones para conseguir todos los recursos necesarios.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-44-27-Captura%20desde%202024-03-04%2018-44-16.png)

Podemos ver que también se produce una redirección de http a https. Es un servidor `nginx`, `Via: 1.1 varnish` y `X-Served-By: cache-mad22057-MAD`. Hace alguna petición extra para obtener algunos recursos.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-47-11-Captura%20desde%202024-03-04%2018-47-04.png)

En este caso vemos que no hay redirección de http a https. Podemos observar que realiza múltiples peticiones para obtener los diferentes recursos de la web.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-49-20-Captura%20desde%202024-03-04%2018-49-04.png)

Vemos que hay dos redirecciones. La primera de http a https, y la segunda de dominio. También podemos observar que hace múltiples peticiones para obtener los recursos de la web.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-52-47-Captura%20desde%202024-03-04%2018-52-38.png)

Podemos ver que hay una redirección de http a https. Por otro lado, se trata de un servidor `nginx`, `via: 1.1 varnish` y con `x-served-by: cache-mad22074-MAD`. La página realiza múltiples peticiones para descargar los diferentes recursos de la web.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-18-56-27-Captura%20desde%202024-03-04%2018-55-58.png)

Se produce una redirección de http a https y se producen múltiples peticiones para descargar los recursos.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-19-00-52-Captura%20desde%202024-03-04%2019-00-41.png)

Se producen dos redirecciones, una de http a https y otra de cambio de dominio permanente. Por otro lado, vemos que se trata de un servidor `apache`, `via: 1.1 slack-prod.tinyspeck.com, envoy-www-iad-rvzeumxq, envoy-edge-lhr-jzhgzlgf`, que realiza múltiples peticiones para descargar los recursos de la web.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-19-03-32-Captura%20desde%202024-03-04%2019-03-22.png)

En esta última web, vemos que se produce una redirección de http a https. El servidor aparece como `XXXXXX` y que realiza múltiples peticiones para descargar los recursos de la web.

**Ejercicio 6: Envio de datos en un formulario GET**

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-19-22-39-Captura%20desde%202024-03-04%2019-22-11.png)

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-19-22-45-Captura%20desde%202024-03-04%2019-22-25.png)

Podemos ver desde la herramienta de desarrollador que se han enviado los datos desde una petición `GET`.

![](/home/daniel/snap/marktext/9/.config/marktext/images/2024-03-04-19-25-19-Captura%20desde%202024-03-04%2019-25-09.png)

Vemos que funciona de la misma forma desde comandos.
