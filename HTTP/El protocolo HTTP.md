# El protocolo HTTP

###### Daniel Alconchel Vázquez

---

**Ejercicio 1: Petición web con cURL**

![](./.source/2024-03-04-17-49-27-Captura%20desde%202024-03-04%2017-47-23.png)

Con el primer comando solo podemos ver el cuerpo de la respuesta, por lo que no podemos comentar nada sobre los encabezados de HTTP.

Con el segundo comando, podemos ver que hay una primera parte donde se construye la petición HTTP. En dicha petición, vemos que en la primera línea se muestra que se trata de una petición `GET`, después sigue el encabezado, donde se muestra el host al que se manda la petición, y el agente usado para mandarlo, que en este caso es `curl`, además de especificar el tipo de contenido que puede aceptar y procesar el cliente (`*/*`). Por último, hay una línea en blanco. A continuación, podemos ver el mensaje de respuesta de HTTP, que sigue una estructura similar. Tiene una primera línea, donde se muestra el protocolo usado y el estado de la respuesta, después, aparecen los encabezados, con la información que podemos ver en la captura y, por último, una línea en blanco, seguido del cuerpo de la respuesta.

**Ejercicio 2: Redirecciones con cURL**

![](./.source/2024-03-04-18-02-46-Captura%20desde%202024-03-04%2018-02-16.png)

Como podemos ver, no nos redirige automáticamente y nos muestra el código de estado 301 de HTTP, que suele usarse cuando ocurre un cambio de HTTP a HTTPS

![](./.source/2024-03-04-18-07-30-Captura%20desde%202024-03-04%2018-05-30.png)

![](./.source/2024-03-04-18-07-41-Captura%20desde%202024-03-04%2018-07-16.png)

Como podemos ver, esta vez si hace la redirección.

![](./.source/2024-03-04-18-08-49-Captura%20desde%202024-03-04%2018-08-30.png)

**Ejercicio 3: Añadiendo encabezados sobre compresión gzip con cURL**

![](./.source/2024-03-04-18-13-17-Captura%20desde%202024-03-04%2018-11-04.png)

Podemos ver que evita escribir la información binaria en la consola, tal y como indica el guión.

![](./.source/2024-03-04-18-13-54-Captura%20desde%202024-03-04%2018-12-54.png)

Esta vez, le forzamos a hacerlo con `--output`. Veamos el fichero descomprimido:

![](./.source/2024-03-04-18-15-32-Captura%20desde%202024-03-04%2018-15-21.png)

Probamos, por último, la opción `--compressed` para descomprimir la información y verla directamente en consola:

![](./.source/2024-03-04-18-16-50-Captura%20desde%202024-03-04%2018-16-06.png)

**Ejercicio 4: Añadiendo encabezados sobre conexiones persistentes con cURL**

![](./.source/2024-03-04-18-19-59-Captura%20desde%202024-03-04%2018-19-23.png)

Vemos que, en la segunda petición, se indica *Re-using existing connection!...*, lo que indica que se mantuvo la misma conexión TCP/IP.

![](./.source/2024-03-04-18-22-17-Captura%20desde%202024-03-04%2018-22-09.png)

Podemos apreciar en la captura que hemos deshabilitado la opción de reutilizar la misma conexión. También podemos ver que indica con `#n` el número de la conexión, siendo el de la primera 0 y el de la segunda 1.

![](./.source/2024-03-04-18-23-53-Captura%20desde%202024-03-04%2018-23-44.png)

Vemos, por último, que de esta forma si hace uso de las conexiones persistentes.

**Ejercicio 5: Averiguar el software que usa un servidor web**

![](./.source/2024-03-04-18-33-17-Captura%20desde%202024-03-04%2018-30-59.png)

Podemos ver que realiza una redirección de http a https. Si desglosamos la segunda cabecera, podemos ver que `Server: Apache/2.4.52(Ubutnu)`, indicandonos que se trata de un servidor apache en ubuntu. Por otro lado, vemos que también se hace una petición para descargar el icono de página.

![](./.source/2024-03-04-18-39-01-Captura%20desde%202024-03-04%2018-38-20.png)

Podemos ver que esta página web hace muchas solicitudes, para descargar todo los recursos necesarios de la página. En la cabecera podemos ver que se trata de un servidor `nginx`.

![](./.source/2024-03-04-18-42-18-Captura%20desde%202024-03-04%2018-42-04.png)

Vemos que hace una redirección de http a https, además, el código 302 de la segunda petición, indica una redirección a una nueva ubicación temporal. Podemos ver que se trata de un servidor Apache y, como en el caso anterior, hace múltiples peticiones para conseguir todos los recursos necesarios.

![](./.source/2024-03-04-18-44-27-Captura%20desde%202024-03-04%2018-44-16.png)

Podemos ver que también se produce una redirección de http a https. Es un servidor `nginx`, `Via: 1.1 varnish` y `X-Served-By: cache-mad22057-MAD`. Hace alguna petición extra para obtener algunos recursos.

![](./.source/2024-03-04-18-47-11-Captura%20desde%202024-03-04%2018-47-04.png)

En este caso vemos que no hay redirección de http a https. Podemos observar que realiza múltiples peticiones para obtener los diferentes recursos de la web.

![](./.source/2024-03-04-18-49-20-Captura%20desde%202024-03-04%2018-49-04.png)

Vemos que hay dos redirecciones. La primera de http a https, y la segunda de dominio. También podemos observar que hace múltiples peticiones para obtener los recursos de la web.

![](./.source/2024-03-04-18-52-47-Captura%20desde%202024-03-04%2018-52-38.png)

Podemos ver que hay una redirección de http a https. Por otro lado, se trata de un servidor `nginx`, `via: 1.1 varnish` y con `x-served-by: cache-mad22074-MAD`. La página realiza múltiples peticiones para descargar los diferentes recursos de la web.

![](./.source/2024-03-04-18-56-27-Captura%20desde%202024-03-04%2018-55-58.png)

Se produce una redirección de http a https y se producen múltiples peticiones para descargar los recursos.

![](./.source/2024-03-04-19-00-52-Captura%20desde%202024-03-04%2019-00-41.png)

Se producen dos redirecciones, una de http a https y otra de cambio de dominio permanente. Por otro lado, vemos que se trata de un servidor `apache`, `via: 1.1 slack-prod.tinyspeck.com, envoy-www-iad-rvzeumxq, envoy-edge-lhr-jzhgzlgf`, que realiza múltiples peticiones para descargar los recursos de la web.

![](./.source/2024-03-04-19-03-32-Captura%20desde%202024-03-04%2019-03-22.png)

En esta última web, vemos que se produce una redirección de http a https. El servidor aparece como `XXXXXX` y que realiza múltiples peticiones para descargar los recursos de la web.

**Ejercicio 6: Envio de datos en un formulario GET**

![](./.source/2024-03-04-19-22-39-Captura%20desde%202024-03-04%2019-22-11.png)

![](./.source/2024-03-04-19-22-45-Captura%20desde%202024-03-04%2019-22-25.png)

Podemos ver desde la herramienta de desarrollador que se han enviado los datos desde una petición `GET`.

![](./.source/2024-03-04-19-25-19-Captura%20desde%202024-03-04%2019-25-09.png)

Vemos que funciona de la misma forma desde comandos.

**Ejercicio 7: Envío de datos en un formulario POST**

![](./.source/2024-03-05-10-03-53-Captura%20desde%202024-03-05%2010-03-12.png)

Tras modificar y resubir la script, vemos que esta funciona correctamente.

Probamos a mandar datos en un POST con cURL:

![](./.source/2024-03-05-10-06-10-Captura%20desde%202024-03-05%2010-04-54.png)

![](./.source/2024-03-05-10-06-16-Captura%20desde%202024-03-05%2010-05-34.png)

**Ejercicio 8: Autenticación básica con cURL**

Tras subir los correspondientes archivos, vemos que funciona:
![](./.source/2024-03-05-10-14-41-Captura%20desde%202024-03-05%2010-14-16.png)

Ahora vamos a probar con cURL:

![](./.source/2024-03-05-10-22-08-Captura%20desde%202024-03-05%2010-21-53.png)

**Ejercicio 9: Envío de ficheros con cURL**

![](./.source/2024-03-05-10-32-35-Captura%20desde%202024-03-05%2010-32-19.png)

**Ejercicio 10: Búsqueda de autor**

**Primera Forma:**

Si entramos en la web e intentamos buscar por autores, vemos que la url es de la forma:

```url
https://openlibrary.org/search/authors?q=
```

Al hacer la búsqueda, colocando en nombre de Antonio Garrido Carrillo, vemos que, al clickar en el resultado buscado, la url pasa de 

```url
https://openlibrary.org/search/authors?q=antonio+garrido+carrillo
```

a la siguiente:

```url
https://openlibrary.org/authors/OL12536697A/Antonio_Garrido_Carrillo
```

Investigando en la información de la API, vemos que el valor `OL12536697A` es la key de dicha autor. Con dicha key, podemos hacer una petición GET a la API

```url
GET https://openlibrary.org/authors/OL25836A/works.json
```

y obtendriamos todo en formato JSON. Para hacerlo todo mediante cURL, el proceso sería el siguiente:

```bash
curl https://openlibrary.org/search/authors?q=antonio+garrido+carrillo | grep -i "author"
# Después de filtrar por la palabra author, podemos encontrar fácilmente el valor de la key
curl -v https://openlibrary.org/authors/OL25836A/works.json
# Con esto obtendríamos el json (la salida podría ser rederigida)
```

![Captura desde 2024-03-05 15-58-16.png](./.source/Captura%20desde%202024-03-05%2015-58-16.png)

![Captura desde 2024-03-05 15-58-19.png](./.source/Captura%20desde%202024-03-05%2015-58-19.png)

Como vemos, son dos solicitudes `GET`. 

**Segunda Forma:**

Esta forma es parecida, pero cambiamos el primer paso. Si conocemos algún libro de dicho autor, podemos tomar el ISBN13 y hacer una petición `GET` a la API de la siguiente forma:

```bash
curl -v  https://openlibrary.org/api/books?bibkeys=ISBN:9788433863362
```

En la salida, obtendremos lo siguiente:

```json
var _OLBookInfo = {"ISBN:9788433863362": {"bib_key": "ISBN:9788433863362", "info_url": "https://openlibrary.org/books/OL47096624M/Estructuras_de_datos_avanzadas_con_soluciones_en_C", "preview": "noview", "preview_url": "https://openlibrary.org/books/OL47096624M/Estructuras_de_datos_avanzadas_con_soluciones_en_C", "thumbnail_url": "https://covers.openlibrary.org/b/id/13468530-S.jpg"}};
```

y de aquí podemos sacar el código de autor como antes, para proceder como en la forma anterior.

![Captura desde 2024-03-05 16-07-29.png](./.source/Captura%20desde%202024-03-05%2016-07-29.png)

**Ejercicio 11: Monitorizar el tráfico de red**

Mirando la documentación oficial, que podemos encontrar [aquí](https://www.tcpdump.org/manpages/tcpdump.1.html), vemos que el comando presenta una gran cantidad de posibles parámetros. Los más interesantes son:

- `-A` : Imprime cada paquete en ASCII y es muy útil para capturar páginas webs

- `-s` : Snaplen, es decir, cantidad de bytes que se quiere guardar por cada paquete

- `-v`, `-vv`, `-vvv` : Vebose output

- `-n` : Mejora rendimiento, evitando la resolución inversa de DNS

- `-w` : Para guardar el trafico en un documento y analizarlo después de forma más sencilla

![](./.source/2024-03-07-09-28-35-Captura%20desde%202024-03-07%2009-27-51.png)

Después tiene algunos para indicar la cantidad de paquetes que quiere leer, por si no te interesa ver todo el tráfico, leer paquetes de un fichero, mirar checksums...

```bash
sudo tcpdump -A -s 10240 'host void.ugr.es and (tcp port 80 or tcp port 443)' -vv -w output.pcap
```

![](./.source/2024-03-06-16-13-39-Captura%20desde%202024-03-06%2016-13-21.png)

Vamos a visualizar la informacion ahora con

```bash
tcpdump -r output.pcap -A
```

![Captura desde 2024-03-07 09-31-53.png](./.source/Captura%20desde%202024-03-07%2009-31-53.png)

Tras bastante rato probando, no consigo encontrar el apartado de HTML, no se si es porque sigue saliendo el cuerpo del mensaje comprimido, pero como puede apreciar en las capturas de arriba la configuración está cambiada, y he reiniciado hasta el equipo, eliminado cookies... por si acaso.

Como el comando anterior escucha tanto en el puerto 80 como en el 443, escucha tanto http como https, por lo que repetimos el procedimiento para la segunda url.

![Captura desde 2024-03-07 09-35-36.png](./.source/Captura%20desde%202024-03-07%2009-35-36.png)

![Captura desde 2024-03-07 09-36-01.png](./.source/Captura%20desde%202024-03-07%2009-36-01.png)

Ahora con wireshark:

![Captura desde 2024-03-07 09-42-17.png](./.source/Captura%20desde%202024-03-07%2009-42-17.png)

Sigue saliendo los cuerpos de los mensajes así, por lo que no he conseguido encontrar el html, pero la idea sería, por ejemplo, buscar paquetes que tengan un método GET y la url de interés, usar `Follow > TCP Stream` para seguir el flujo de esa solicitud y, ahí, buscar etiquetas html tales como `<html>`, `<head>`...

Para la otra url, exactamente igual:

![Captura desde 2024-03-07 09-48-03.png](./.source/Captura%20desde%202024-03-07%2009-48-03.png)
