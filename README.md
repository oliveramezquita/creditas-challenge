# Creditas technical challenge
Este repositorio contiene una aplicación web para generar un lead para los actuales clientes: **auto**, **casa** y **nómia**.
La aplicación sigue el patrón de diseño de arquitectura de software de Separación de intereses. La aplicación está hecha en Vue JS (lado del cliente) y una API Codeigniter (lado del servidor).

# Instrucciones
Docker se encargará de todo el aprovisionamiento, la instalación y la configuración por usted. Docker creará el esquema de la base de datos y la completará.

Las imágenes de Docker predeterminadas que se utilizaron son:

Para PHP

 - [https://hub.docker.com/_/php](https://hub.docker.com/_/php)

Para MySQL

 - [https://hub.docker.com/_/mysql](https://hub.docker.com/_/mysql)

Para la Webapp 

 - [https://hub.docker.com/_/node](https://hub.docker.com/_/node)

Para la documentación

 - [https://hub.docker.com/r/mhart/alpine-node](https://hub.docker.com/r/mhart/alpine-node)

## Requisitos
Instala [docker](https://www.docker.com/).
```
$ sudo apt-get update
```
```
$ sudo apt-get install docker-ce docker-ce-cli containerd.io
```
## Configuración
 1. Clona este repositorio:
```
$ git clone https://github.com/oliveramezquita/creditas-challenge.git
```
 2. Ejecuta este comando dentro de la carpeta del repositorio:
```
$ docker-compose up
```
## Webapp URL
Si nada marco error, puedes abrir el siguiente enlace en tu navegador:
 - [http://127.0.0.1:8080](http://127.0.0.1:8080)

## Pruebas
Para ejecutar las pruebas es necesario abrir la terminal dentro la carpeta del repositorio y seguir las siguientes instrucciones:
1. Abre la carpeta test
```
$ cd test
```
2. Instala los módulos requeridos ([Supertets](https://www.npmjs.com/package/supertest) y [Mocha](https://mochajs.org/)) para las pruebas:
```
$ npm install
```
3. Por último solo requerimos correr el comando test para realizar las pruebas:
```
$ npm test
```

## Documentación
- De la solución: Solucion.docx
- [Endpoints - http://localhost:8081/#/](http://localhost:8081/#/)
