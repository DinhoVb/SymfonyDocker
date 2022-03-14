# SymfonyDocker


El proyecto cuenta con 4 modulos principales que son:
  - Dashboard
  - Login/Registro
  - Productos
  - Compras

DASHBOARD:
el dashboard lo hice con el fin de que sea la vista principal a la hora de que el usuario se registre. Para ingresar en esta vista requiere estar autenticado/logueado.
tambien es la que utilice como layout de las vistas que requerian ser autenticas.

LOGIN/REGISTRO:
como su nombre lo indica es para realizar el registro y logueo a la software. El usuario al intentar ingresar a una de las vistas que requira que sea logueado, esta inmediatamente lo redirecciona a esta vista para que se logue

PRODUCTOS:
este endpoint se requeria que los usuario que no estuvieran registrado ni logueado pudieran entrar. este modulo lo divide en 4 templates:
  
  - index: es la vista principal donde se encuentra un formulario, el cual da a elegir 2 opciones mirar todos los productos o hacer un filtrado.
  - list: es la vista en donde nos retorna del controlador el listado de todos los productos disponibles.
  - show: es la vista que contiene los productos que cumple con las condiciones dadas en el form de la vista index, la cual requeria de 2 parametros del nombre(este podia 
          conterner un fragmento del nombre del producto a buscar), y el limite de productos que querian que retorne.
  - new: esta vista la decide colocar aunque no se habia pedido en la prueba, ya que bien de algun modo la unica forma de almacenar productos a la tabla era de manera directa en 
          la base de datos, asi que decidi que hacerla pero con la condicion de que solo podian acceder personas que estuvieran logueadas.

COMPRAS: 
este endpoint lo diseñe con su respestivo detalle de compra ya que me parecia que asi es como se debia de hacer, en este modulo 3 templates:

  - index: en esta vista se encuentra el fomulario para realizar la respectiva compra, consta de una parte de javascript la cual usa tambien algo de jquery esto le da mas funcionalidad a lo que se espera, ya que en la vista se retorna todos los productos, y se almacenan en un select, el select en el script esta programado que para cuando se escoja el prodcuto, este rellene los input de precio y stock, sin la necesidad de tener que ingresar el dato a cada input. cuenta con un boton agregar para que esta se vea reflejada en la parte de abajo en la tabla de detalles, al agregar un producto esta la condicion que la cantidad sea menor o igual a la del stock. Los datos son almacenados en un input que guarda los datos en arryas para que al mandarlos por el form al controlador CompraSumistro esta en su respectiva funcion hace que los arrays se almancenen uno por uno en sus respectivas tablas.

-list: en esta vista nos retorna todas nuestras compras realizadas

-show: donde esta el detalle de nuestra compra realizada 
