<?php
/*    ini_set('display_errors', '1');
     ini_set('display_startup_errors', '1');
     error_reporting(E_ALL);*/
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, FETCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Recogemos todos los datos enviado por el usuario desde l formulario de cliente
$data = json_decode(file_get_contents('php://input'), true);

// Valores de conexión a la base de datos
$server = 'localhost';
$user = 'ifcd0110';
$pass = 'clase-IFCD0110';
$db = 'clase';
$conn = mysqli_connect($server, $user, $pass, $db);
if (!$conn) {
    echo '<h1>ERROR, no se ha podido conectar con la base de datos</h1>';
    http_response_code(500);
    exit;
}
// comprobamos si nos envían todos los datos requeridos, estén bien o mal
if (!isset($data["user"]) || !isset($data["password"])) {
    http_response_code(400);
    exit;
}
//echo "<h1>ENHORABUENA, te has coectado a la base de datos</h1>";
//Extraemos de los datos el dato de nombre de usuario enviado por el cliente
$user = $data["user"];
// Extraemos el password enviado por el cliente
$password = $data["password"];
// Hacemos la consulta para saber si hay un registro que coincida exactamente con lo enviado por el usuario
$result = mysqli_query($conn, "SELECT * from user WHERE login ='$user'");
if (mysqli_num_rows($result)) {
    
    echo 'El usuario ya existe';
    http_response_code(405);
    exit;
}
$result = mysqli_query($conn, "INSERT INTO user (login, password) VALUES ('$user','$password')");
if (!$result) {
    
    echo 'No se ha podido dar de alta el usuario';
    http_response_code(500);
    exit;
}
echo 'Bienvenido '.$user;
exit;
