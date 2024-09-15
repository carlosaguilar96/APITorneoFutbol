# APITorneoFutbol

Pasos para usar el contenedor:

  1) Descargar la aplicación de Docker Desktop.
  2) Abrir Docker Desktop para que se active el Docker Engine.
  3) Clonar el proyecto.
  4) Copiar y pegar el archivo ".env.example" en la carpeta raíz del proyecto. Luego, cambiarle el nombre a la copia para que sea el archivo ".env"
  5) Abrir una terminal en la raíz del proyecto y ejecutar el siguiente comando: _docker-compose build_ (puede tomar un tiempo)
  6) Cuando haya terminado de construirse el contenedor, ponerlo a funcionar con el comando: _docker-compose up_ (puede tomar un tiempo, por lo que se debe esperar hasta que se muestre el mensaje de "Server running")
  7) LISTO! La API está desplegada en el contenedor y funcionando. Para detenerla, usar Ctr + C 
  8) Con el contenedor funcionando, se puede probar la API Rest partiendo de la URL http://localhost:8000/api/
  9) Se puede usar la extensión de VS Code Thunder Client (https://marketplace.visualstudio.com/items?itemName=rangav.vscode-thunder-client)
      La cual nos permite ejecutar peticiones de todo tipo, entre las cuales están:
     a) GET para realizar consultas
     b) POST para añadir registros
     c) PUT para actualizar
     d) DELETE para eliminar
     Se pueden brindar los parámetros en formato JSON o Query 
