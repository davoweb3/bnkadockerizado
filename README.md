# bnkadockerizado
Repo para entorno de bnka usando docker y aws ECRy ECS 
# MonoRepo de Aplicación Bancaria Básica (Test)

Esta aplicación sencilla permite realizar varias operaciones contra un backend levantado en Python + Flask y corre sobre 3 contenedores docker mediante una red en comun.


**NOTA:**
Esta pendiente levantar los servicios ECS en AWS.


## Arquitectura

### Frontend (LAMP Server):

**Tecnologías:**
-Docker
- Linux (OS)
- Apache (Web Server)
- MySQL (Database)
- PHP (Server-side scripting)

**Funcionalidad:**
- Sirve páginas web dinámicas.
- Interactúa con el microservicio a través de solicitudes HTTP.

### Microservicio (Python Flask):

**Tecnologías:**
- Python (Lenguaje)
- Flask (Web Framework)
- SQL Alchemy (ORM para interactuar con la BDD)

**Funcionalidad:**
- Ofrece servicios específicos del backend.
- Se conecta a la base de datos MySQL usando SQL Alchemy para realizar operaciones CRUD.
- Recibe solicitudes HTTP desde el frontend y responde con datos o realiza acciones en la base de datos.

### Base de Datos: MySQL

## Diagrama de la Arquitectura
![image](https://github.com/davoweb3/ejerciciobk/assets/105182325/2d2a2836-aa78-402a-9cac-878f458a6280)

## Ejecucion 
-Clonar este repo
-Pull a los contenedores en el registro publico de mi cuenta de docker hub
docker push davotrade/mysql:tagname      
docker push davotrade/bnkacontainer_frontend:tagname
docker push davotrade/bnkacontainer_backend:tagname

Los contenedores ya estan interconectados para una ejecucion local desde Docker Desktop


## Tiene CI/CD con Netlify (frontend) y render (backend)

#Esctructura de archivos del proyecto

![image](https://github.com/davoweb3/ejerciciobk/assets/105182325/eac0b79c-98e3-4bf2-8eeb-52c090475472)




