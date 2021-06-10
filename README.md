ESTA ES UNA API DE PRUEBA

Está construida en PHP 7, con una base de datos mysql (que soporte transacciones), y con arquitectura MVC.
Se debe instalar en el raíz del server (por ejemplo, http://localhost)


Se ha definido un árbol de directorio para la api desde el raíz university
- university/app  -> contiene la aplicación PHP que gestiona la API
- university/api  -> contiene los diferentes end-points, cada uno en diferentes directorio

ENDS POINTS
* /university/api/profesores/  - listado de todos los profesores con queryparam list (sin valor)
* /university/api/profesores/nombre/  - listado de todos los profesores cuyo queryparam nombre contenga "texto" en el value
* /university/api/profesores/profesor/  - muestra el profesor según el queryparam id

* /university/api/estudios/  - listado de todos los estudios con queryparam list (sin valor)
* /university/api/estudios/estudio/  - muestra el estudio según el queryparam id

* /university/api/asignaturas/  - listado de todas las asignaturas con queryparam list (sin valor)
* /university/api/asignaturas/estudio/  - listado de todas las asignaturas con queryparam id = estudio de filtro
* /university/api/asignaturas/asignatura/  - muestra la asignatura con queryparam id

* /university/api/relaciones/  - listado de todas las relaciones profesor-asignatura con queryparam list (sin valor)
* /university/api/relaciones/estudio/  - listado de todas las relaciones profesor-asignatura con queryparam id = estudio de filtro
* /university/api/relaciones/asignatura/  - listado de todas las relaciones profesor-asignatura con queryparam id = asignatura de filtro
* /university/api/relaciones/profesor/  - listado de todas las relaciones profesor-asignatura con queryparam id = profesor de filtro
* /university/api/relaciones/relacion/  - muestra la relación profesor-asignatura con queryparam id

Las peticiones reciben en formato JSON, en el caso de ser correctas, la siguiente estructura de response:
{
    "status": "200 || 400 || 403 || 405",
    "message": "Mensaje en función de la petición",
    "data": (OBJETO || ARRAY OBJETOS || null)
}
