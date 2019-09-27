<?php


function validarRegistro($datos)
{

    $errores = [];

    $name = trim($datos['name']);
    $email = trim($datos['email']);
    $username = trim($datos['username']);
    $password = trim($datos['password']);


    //VALIDACION NAME

    if (strlen($name) === 0) {

        $errores['name'] = 'Nombre invalido';
    }


    //VALIDACION EMAIL

    if (strlen($email) === 0) {

        $errores['email'] = 'Llena este campo con tu email';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errores['email'] = 'El formato de email es incorrecto';
    }

    //VALIDACION USERNAME

    if (strlen($username) < 8) {

        $errores['username'] = 'Tu nombre de usuario tiene que tener mas de 8 caracteres';
    } else if (strpos($username, ' ')) {

        $errores['username'] = 'Tu nombre de usuario no debe tener espacios';
    }

    //VALIDACION PASSWORD

    if (strlen($password) < 8) {

        $errores['password'] = 'La clave debe tener mas de 8 caracteres';
    } else if (strlen($password) > 16) {

        $errores['password'] = 'La clave debe tener menos de 16 caracteres';
    } else if (!preg_match('`[a-z]`', $password)) {

        $errores['password'] = "La clave debe tener al menos una letra minúscula";
    } else if (!preg_match('`[A-Z]`', $password)) {

        $errores['password'] = "La clave debe tener al menos una letra mayuscula";
    } else if (!preg_match('`[0-9]`', $password)) {

        $errores['password'] = "La clave debe tener al menos un caracter numerico";
    }




    //RETURN
    return $errores;
}


function upUser($user){
    //Crear directorio si no esta creado.
    if (!file_exists('database')) {
        mkdir("database");
    }

    $archivo = file_get_contents('database/users.json'); //leer archivo.

    $archivoArray = json_decode($archivo, true); //convertir json a array.

    $archivoArray[] = $user;    //agreagar usuario al array.

    $archivoJSON =  json_encode($archivoArray);  //convertir array a json.

    file_put_contents('database/users.json', $archivoJSON); //guardo archivo.

}

    function validationUser($user) {
        $errores = [];

        $username = trim($user['username']);
        $password = trim($user['password']);


        $archivo = file_get_contents('database/users.json');
        $archivoArray = json_decode($archivo, true);
        var_dump($archivoArray);
        
        foreach ($archivoArray as $user) {
        var_dump($user);
        if (($user['email'] === $username or $user['username'] === $username) and password_verify($password, $user['password'])) {
            $errores = [];
            //SESION
            header("location: miPerfil.php");
        }
        $errores['login'] = 'Nombre de usuario o contraseña incorrectas';

        return $errores;
    }
}
