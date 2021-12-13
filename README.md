<div id="top"></div>

  <h3>Proyecto Api Laravel</h3>

Daniel Rodriguez
[![LinkedIn][linkedin-shield]][linkedin-url]

  <p>
    Proyecto Api desarrollado en Laravel
    <br />
    <a href="https://drs-proyecto-laravel.herokuapp.com">Ver Aplicación</a>
    <br />
    <a href="https://github.com/Danrodsf/Proyecto-Laravel/issues">Reportar un Error</a>
  </p>
</div>

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/832c7a28ea8e6d603244?action=collection%2Fimport)

## Sobre el Proyecto

La base de datos consta de 6 tablas:

1. La principal `Users` donde estarian todos los datos de los usuarios de la aplicación.
2. Los usuarios podrían añadirse como amigos, por lo que la tabla `Friends` era necesaria para dicha relación.
3. Los usuarios podrían unirse en grupos o partidas llamadas `Parties`.
4. Para enlazar a los usuarios con las partidas fue necesaria la creación de la tabla `Belongs`.
5. Las partidas estarían unidas a un juego en específico, por lo que `Games` recopila toda la información de cada juego.
6. Dentro de las partidas, los usuarios pueden enviarse mensajes para que sean vistos por todos los miembros de la misma, por lo que `Messages` guardaría todos los mensajes, el id del usuario quien lo envía, y el id de la partida a donde la envía.

### Diagrama relacional de la base de datos

<img src=https://raw.githubusercontent.com/Danrodsf/Proyecto-Laravel/main/img/DB.png>

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/832c7a28ea8e6d603244?action=collection%2Fimport)

```
Los requisitos para este proyecto serian:

● Los usuarios se tienen que poder registrar a la aplicación, estableciendo un usuario/contraseña.
● Los usuarios tienen que autenticarse a la aplicación haciendo login.
● Los usuarios tienen que poder crear partidas (parties) por un determinado videojuego.
● Los usuarios tienen que poder buscar partidas seleccionando un videojuego.
● Los usuarios pueden entrar y salir de una Partida.
● Los usuarios tienen que poder enviar mensajes a la partida. Estos mensajes tienen que poder ser editados y borrados por su usuario creador.
● Los mensajes que existan a una partida se tienen que visualizar como un chat común.
● Los usuarios pueden introducir y modificar sus datos de perfil, por ejemplo, su usuario de Steam.
● Los usuarios tienen que poder hacer logout de la aplicación web.
```

### Tecnologías

Las tecnologías usadas para este proyecto fueron las siguientes:

-   [MySQL](https://www.mysql.com//)
-   [PHP](https://www.php.net/)
-   [Eloquent](https://laravel.com/docs/8.x/eloquent)

### Como instalar

1. Se requiere tener `COMPOSER` instalado en el sistema para poder instalar las dependencias.

2. Para instalar de manera local se debe ejecutar el comando `php composer install`.

3. Para usar en una base de datos propia, se debe de cambiar el nombre del archivo `.env.example` a `.env` y agregar los datos de la base de datos a utilizar.

4. Luego se deberá realizar las migraciones de las tablas con el comando `php artisan migrate`.

5. Como último paso OPCIONAL se puede utilizar el comando `php artisan db:seed` para generar datos de ejemplo en la base de datos en las tablas `users` y `games`. El resto de tablas se requiere que se rellenen manualmente ya que existen dependencias y relaciones entre las demás tablas de la base de datos.

<p align="right">(<a href="#top">Volver al inicio</a>)</p>

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/danielrodriguezserafin/
