# Desarrollo de aplicaciones web. Proyecto final
Proyecto final para el curso de Desarrollo de aplicaciones web.

## Descripción
La aplicación consiste en un sistema en línea de préstamos para los laboratorios de electrónica (y similares) del campus. Permite consultar la disponibilidad de artículos en el laboratorio; al iniciar sesión como alumno, consultar los préstamos que se han solicitado; y al iniciar sesión como administrador, consultar los préstamos de todos los alumnos y crear nuevos.

## Uso
### Página principal
En la página principal, cualquier usuario (_logeado_ o no) puede revisar la disponibilidad de artículos en el laboratorio. Para facilitar la búsqueda, es posible filtrar los resultados.

Un usuario existente (encargado o alumno) puede iniciar sesión dando click al botón de _Login_. Los alumnos que deseen registrarse pueden hacerlo por medio del formulario de registro, los encargados solo pueden agregarse directamente a la base de datos.

### Página de alumno
Al iniciar sesión como alumno, el usuario puede, por medio del menú _dropdown_ a la derecha de la barra de navegación, consultar los préstamos que se le han hecho.

En la pantalla de _Préstamos_, el usuario puede elegir expandir alguno de sus pedidos y consultar la fecha de devolución de cada artículo.

### Página de encargado
Al iniciar sesión como encargado, el usuario puede, por medio del menú _dropdown_ a la derecha de la barra de navegación, consultar todos los préstamos que ha hecho.

En la pantalla de _Préstamos_, el usuario puede elegir expandir alguno de los pedidos y registrar el regreso de los artículos que lo componen.

Dando click al botón de _Nuevo préstamo_, el encargado puede registrar una nueva orden. Si se intenta agregar a la orden un artículo sin disponibilidad, aparecerá un mensaje de error. Si el usuario cierra la ventana antes de enviar el pedido, este se reestablecerá la próxima vez que visite esta pantalla.

## Implementación
### Front end
Se utilizó la librería de JavaScript jQuery y, para el diseño de la aplicación, bootstrap.

### Back end
Para el back end de la aplicación se utilizó php y una base de datos MySQL. Para el acceso a la base de datos se utilizó PDO.

#### Acceso a datos
A la clase UserDAO utilizada durante el curso se le agregaron los métodos necesarios para la funcionalidad de la aplicación. Todas las consultas y actualizaciones a la base de datos se hacen por medio de una instancia de esta clase.

Para separar el procesamiento de las peticiones de las páginas de la aplicación, en los accesos hechos por medio de Ajax, para cada acceso con la misma función hay un archivo que recibe la petición, llama los métodos relevantes de la clase UserDAO y responde.

#### Base de datos
La base de datos tiene las tablas _users_, _stock_, _orders_, y _loans_.

##### _users_
Esta tabla almacena los usuarios del sitio.

* _id_, contiene la matrícula o nómina del usuario.
* _password_, contiene la contraseña del usuario.
* _name_, el nombre completo del usuario.
* _emai_, el correo electrónico.
* _phone_, el teléfono de contacto del usuario.
* _admin_, su valor es 0 para alumnos y 1 para encargados de laboratorio.
* _addedBy_, si el usuario es administrador, contiene el _id_ del usuario que lo agregó. Corresponde a una funcionalidad no implementada en la que encargados existentes podrían agregar nuevos.

##### _stock_
Esta tabla almacena los artículos que el laboratorio posee.

* _id_, número de identificación del tipo de artículo.
* _description_, nombre del artículo.
* _total_, número de artículos de este tipo que el laboratorio posee.
* _available_, número de artículos de este tipo disponibles para prestarse.
* _loanLength_, días por los que se prestan los artículos de este tipo.
* _admin_, su valor es 0 para alumnos y 1 para encargados de laboratorio.

##### _orders_
Almacena las órdenes (conjunto de préstamos de uno o más tipos de artículos) pasadas y actuales que se han hecho.

* _id_, número de identificación de la orden.
* _student_, _id_ del estudiante al que se le hizo el préstamo.
* _timestamp_, fecha y hora en que se hizo la orden.
* _returned_, 1 si todos los artículos de la orden se han regresado, 0 si no.

##### _loans_
Almacena los préstamos (uno o más artículos del mismo tipo) que se han hecho.

* _id_, número de identificación del préstamo.
* _orderId, _id_ de la orden a la que pertenece este préstamo
* _item_, _id_ del tipo de artículo que se prestó.
* _quantity_, número de artículos que el alumno tiene en su posesión. A medida que el alumno regresa artículos del préstamo, este campo decrementa.
* _dueDate_, fecha para regresar el(los) artículo(s).
* _returned_, 0 si no se han regresado los artículos del préstamo, 1 si sí.

## Autor
**Yiann A. Celaya** - *A012050246*
