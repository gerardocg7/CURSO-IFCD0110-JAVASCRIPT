<?php
   ini_set('display_errors', '1');
     ini_set('display_startup_errors', '1');
     error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, FETCH, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// Recogemos todos los datos enviado por el usuario desde l formulario de cliente



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
// Escapar sql injection
function db_escape($value)
{
    $server = 'localhost';
    $user = 'ifcd0110';
    $pass = 'clase-IFCD0110';
    $db = 'clase';

    $conn = mysqli_connect($server, $user, $pass, $db);
    return mysqli_real_escape_string($conn, $value);
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
        if ($row = mysqli_fetch_assoc($result)){
            $id_user= $row['id'];
        }
        $arr = array();
        $result = mysqli_query($conn, "SELECT * from canciones WHERE id_user ='$id_user'");
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
$data = json_decode(file_get_contents('php://input'), true);
// Hacemos la consulta para saber si hay un registro que coincida exactamente con lo enviado por el usuario


if (!isset($data['user']) || !isset($data['password'])) {
    echo '<h1>ERROR, faltan parámetros';
    http_response_code(400);
    exit;
}

//Extraemos de lo0sdatos el dato de nombre de usuario enviado por el client
$user = db_escape($data["user"]);
// Extraemos el password enviado por el cliente
$password = db_escape($data["password"]);
$result = mysqli_query($conn, "SELECT * from user WHERE login = '$user' && password = '$password' ");
if (!mysqli_num_rows($result)) {

    echo 'ERROR de autenticación';
    http_response_code(401);

    exit;
}

if ($row = mysqli_fetch_assoc($result)){
    $id_user= $row['id'];
}
$id_song = '';
$titulo = '';
$descripcion = '';
if (!isset($data['id_song'])) {
    http_response_code(400);
    exit;
}
$id_song = $data['id_song'];

if ($method == 'POST' && !isset($data['delete'])) {

    if (isset($data['artista'])) $artista = db_escape($data['artista']);
    if (isset($data['titulo'])) $titulo = db_escape($data['titulo']);
    if (isset($data['descripcion'])) $descripcion = db_escape($data['descripcion']);
    $result = mysqli_query($conn, "INSERT INTO canciones (id_user, id_song, artista, titulo, descripcion) VALUES ('$id_user','$id_song', '$artista', '$titulo', '$descripcion')");
    if (!$result) {
        echo 'No se ha podido añadir la canción';
        http_response_code(500);
        exit;
    }
    exit;
}

// DELETE
$result = mysqli_query($conn, "DELETE from canciones WHERE id_user ='$id_user' && id_song='$id_song'");
if (!$result) {
    http_response_code(500);
    exit;
}

exit;
