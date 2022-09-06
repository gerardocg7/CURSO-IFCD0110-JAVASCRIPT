<?php
/*   ini_set('display_errors', '1');
     ini_set('display_startup_errors', '1');
     error_reporting(E_ALL);*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, FETCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Recogemos todos los datos enviado por el usuario desde l formulario de cliente

// Escapar sql injection

// Valores de conexión a la base de datos
$server = 'localhost';
$user = 'ifcd0110';
$pass = 'clase-IFCD0110';
$db = 'clase';

$conn = mysqli_connect($server, $user, $pass, $db);
function db_escape($value) {
    $server = 'localhost';
    $user = 'ifcd0110';
    $pass = 'clase-IFCD0110';
    $db = 'clase';

    $conn = mysqli_connect($server, $user, $pass, $db);
    return mysqli_real_escape_string($conn, $value);
}
if (!$conn) {
    echo '<h1>ERROR, no se ha podido conectar con la base de datos</h1>';
    http_response_code(500);
    exit;
}
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'GET') {
    // comprobamos si nos envían todos los datos requeridos, estén bien o mal
    if (!isset($_GET["user"]) || !isset($_GET["password"])) {
        http_response_code(400);
        exit;
    }
    //echo "<h1>ENHORABUENA, te has coectado a la base de datos</h1>";
    //Extraemos de los datos el dato de nombre de usuario enviado por el cliente
    $user =db_escape($_GET["user"]);
    // Extraemos el password enviado por el cliente
    $password = db_escape($_GET["password"]);

    // Hacemos la consulta para saber si hay un registro que coincida exactamente con lo enviado por el usuario
    $result = mysqli_query($conn, "SELECT * from user WHERE login ='$user' && password='$password'");
    if (mysqli_num_rows($result)) {
        //devovlvemos los datos del usuario
        $arr = array();
        /**En javascript
         * let nobrevar = [];
         *  */
        /* fetch associative array */
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
        exit;
    }
    echo 'ERROR de autenticación';
    http_response_code(401);
    exit;
}

// PUT.
// Modificación

$data = json_decode(file_get_contents('php://input'), true);
$user = db_escape($data['user']);
$password = db_escape($data['password']);
if ($method == 'POST' && !isset($data['delete'])) {

    if (!isset($data['userAnt']) || !isset($data['passwordAnt'])) {
        http_response_code(400);
        exit;
    }
    $userAnt = $data['userAnt'];
    $passwordAnt = $data['passwordAnt'];

    $result = mysqli_query($conn, "SELECT * from user WHERE login ='$userAnt' && password='$passwordAnt'");
    if (!mysqli_num_rows($result)) {
        //El login de usuario antiguo no existe
        echo "el usuario antiguo no existe";
        http_response_code(404);
        exit;
    }
    if ($userAnt != $user) {
        $result = mysqli_query($conn, "SELECT * from user WHERE login ='$user'");
        if (mysqli_num_rows($result)) {
            echo "El login del nuevo usuario ya existe";
            http_response_code(405);
            exit;
        }
    }
    $result = mysqli_query($conn, "UPDATE user SET login ='$user', password='$password' WHERE login='$userAnt' && password='$passwordAnt'");
    if (!$result) {
        /**
         *  Se comprobaría si el muevo nombre de usuario
         * existe pero entonces ya habría que usar todo esto en funciones
         * en plan if (!funcionquecomprueba)
         * */
        http_response_code(500);
        exit;
    }
}

// DELETE
$result = mysqli_query($conn, "DELETE from user WHERE login ='$user' && password='$password'");
if (!$result) {

    http_response_code(500);
    exit;
}


///antiguo
exit;
