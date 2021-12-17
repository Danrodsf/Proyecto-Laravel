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

### Endpoints

#### Endpoints que NO tienen protección Oauth.

```
Post -- api/signUp -- User Register.
Post -- api/signIn -- User Login.
```

#### Endpoints protegidos por Oauth.

##### Users

```
Post -- api/logout -- User Logout.
Get -- api/getAll -- Lista de todos los usuarios registrados.
Post -- api/getProfile -- Lista los datos de el usuario logueado.
Put -- api/updateProfile -- Actualiza los datos del usuario logueado.
Delete -- api/removeUser -- Elimina un usuario.
```

##### Friends

```
Post -- api/addFriend -- Crea una solicitud de amistad con otro usuario.
Post -- api/getFriends -- Lista de todos los amigos confirmados del usuario logueado.
Post -- api/getPendingFriends -- Lista de todas las solicitudes de amistad pendientes de confirmar del usuario.
Post -- api/getPendingFriendsRequest -- Lista de todas las solicitudes de amistad recibidas pendientes de confirmar por el usuario.
Put -- api/acceptFriend -- Actualiza una solicitud de amistad recibida para confirmar amistad.
Delete -- api/removeFriend -- Elimina a un amigo confirmado de la lista de amigos del usuario.
```

##### Parties

```
get -- api/getParties -- Lista todas las partidas creadas.
Post -- api/addParty -- Crea una partida.
Post -- api/joinParty -- Añade como miembro de una partida al usuario.
Post -- api/getPartiesByGameId -- Lista todas las partidas filtradas por juego pasado por Id del juego.
Post -- api/getPartiesByGameTitle -- Lista todas las partidas filtradas por juego pasado por el título del juego.
Post -- api/getMyParties -- Lista todas las partidas de la que es miembro el usuario.
Post -- api/getPartyMembers -- Lista de todos los miembros de una partida de la que el usuario es miembro.
Delete -- api/removeParty -- Elimina una partida de la que el usuario es el dueño.
Delete -- api/quitParty -- Elimina como miembro de una partida al usuario.
Delete -- api/kickFromParty -- Elimina como miembro de una partida a un usuario seleccionado por el dueño de la misma.
```

##### Games

```
Get -- api/getGames -- Lista de todos los juegos registrados.
Post -- api/addGame -- Añade un juego a la base de datos.
Post -- api/getGameById -- Lista la informacion de un juego seleccionado por su id.
Post -- api/getGameByTitle -- Lista la informacion de un juego seleccionado por su titulo.
Put -- api/updateGame -- Actualiza la información de un juego.
Delete -- api/removeGame -- Elimina un juego de la base de datos.
```

##### Messages

```
Get -- api/getMessages -- Lista todos los mensajes enviados.
Post -- api/addMessage -- Envia un mensaje nuevo a una partida de la que el usuario es miembro.
Post -- api/getPartyMessages -- Lista todos los mensajes de una partida de la que el usuario es miembro.
Put -- api/updateMessage -- Edita un mensaje enviado previamente por el usuario.
Delete -- api/removeMessage -- Elimina un mensaje enviado previamente por el usuario.
```
