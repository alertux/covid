# COVID-19
Contribución de soluciones para combatir la gran pandemia COVID-19 usando tecnologías.


# Caracteristicas (Proximanente)


### Tecnologías

Listamos los proyectos open source para trabajar la solución:

* [Frontend] VUE JS, Boostrap 4
* [Backend] PHP con Laravel 5.6
* [Base de Datos]  PostgreSQL
* [Cloud] Google Cloud Platform

### Instalación
[SOLO PARA WINDOWS]

1. Descargar laragon, la version "Laragon full"
   https://laragon.org/download/

2. Install Laragon.

3. Descargar PHP >= 7.1.3  
	https://windows.php.net/download

	Sigue estos pasos para actualizar a nueva version de PHP.
	https://forum.laragon.org/topic/166/tutorial-how-to-add-another-php-version-php-7-4-updated

4. Clonar repositorio en la carpeta "www" en tu directorio de laragon {RUTA_DE_SISTEMA}/laragon/www

5. Instalar dependencias, navega a la ruta de instalación de "covid" en  {RUTA_DE_INSTALACION}/laragon/www/covid
 ```sh
$ npm install 
$ composer install
```  

6. Agrega el archivo ".env" a tu proyecto.
    Clona el archivo ".env.example" con el nombre ".env" en la ruta raiz de proyecto y  cambia la
   rutas a: 
	APP_URL=http://covid.test ó http://localhost/covid 
    ASSET_URL=http://covid.test ó http://localhost/covid

7. Probar la instalación
   http://covid.test/

8. Estas listo para iniciar con la primera tarea.

Dejamos este ISSUE o conversación que ayudará a resolver problemas con la instalación [https://github.com/alertux/covid/issues/1]

### FRONTEND 

Para compilar de SASS/Vue.js a CSS/JS.

```sh
$ npm run dev
```

Compilar cambios SASS/VUE.JS en HOT-RELOAD (Caliente)

```sh
npm run watch
```

### FLUJO DE TRABAJO

1. Ponte en contacto con lider de equipo, y te dara acceso a tareas en trello.com.

2. Lider de equipo te asignara una tarea pequeña.

3. Debes de asegurar de endender los requerimientos de la tarea.

4. Crea un branch usando la tecnica de "Git flow"
   Descarga https://danielkummer.github.io/git-flow-cheatsheet/
   Te ayudara a tener un flujo estandar de cada Features o tarea en la que trabajaras.

5. Cuando tu tarea esta completada, debes de enviar un Pull Request (PR) al branch "develop",
   este debe incluir una descripcion clara del nuevo features o cambios.

6. Un miembro del equipo revisara tu PR para garantizar que el nuevo feature o cambios funcionen correctamente con lo 
   minimo esperado segun la tarea asignada.

7. Si tu PR tienes sugerencias o no esta funcionando correctamente, deberas de enviar nuevos "commits" con los cambios solicitados.

8. Si tu PR esta completo, la persona encargada de "Code Review" hara Merge desde tu Branch con el Branch Develop y verificará cualquier conflicto entre ambos branch.

10. Tu tarea esta listo en el entorno de desarrollo para enviar a producción.

### Equipo y Contribuidores

| Nombre | Rol |Email |
| ------ | ------ | ------ |
| Oscar Joya | Project Manager | oscar.joya@tadeosytems.com
| Edward Servellón |  Backend Developer | Edward.servellon1@gmail.com
| Wilfredo Noyola  | Frontend Developer  | wilfredon163@gmail.com
| Angel Cáceres | Backend Developer + DevOps  | caceres840@gmail.com
| Mardoqueo Carranza | Infraestructura Desarrollo y Producción | jcarranza@web-informatica.com
| Roberto Palomo | | Rpalomoc@gmail.com
| Rubén Rochi | | rrochi@alertux.com
| Jose Luis Barreto | | jlbarretoe@gmail.com


### Recursos

| Plugin | README |
| ------ | ------ |
| Laravel | [https://laravel.com/docs/5.6/][PlDb] |
| Boostrap | [https://getbootstrap.com/][PlDb] |

### Guias y buenas prácticas

| Plugin | README |
| ------ | ------ |
| Laravel | [https://github.com/alexeymezenin/laravel-best-practices/blob/master/spanish.md][PlDb] |


### Desarrollo

¿Quieres contribuir? ¡CHIVO!

Envia un correo a covid19@alertux.com

### Docker
Proximamente, por ahora sigue los pasos de la sección "Instalación".

License
----

MIT


**Software libre. ¡Si!**
