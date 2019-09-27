<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
include_once('funciones.php');

// $errores = [
//     'name' => '',
//     'email' => '',
//     'username' => '',
//     'password' => ''
// ];

if (!empty($_POST)) {
    $errores = validarRegistro($_POST);

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    
    if (!$errores) {
        $user = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)//PASSWORD HASHEADA
        ];
        var_dump($user);

        //CARGA DE DATOS EN JSON
        upUser($user);


        header('location:login.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Register</title>
    <style>
    #fg_membersite{
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .error{
        color:red;
        font-size: 13px;
    }
    
    </style>
</head>
<body>

    <div id='fg_membersite'>
        <form id='register' action='register.php' method='post'>
            <fieldset >
                <legend>Registrate</legend>        
                <div><span class='error'></span></div>
                <div class='container'>
                    <label for='name' >Nombre completo: </label><br/>
                    <input type='text' name='name' id='name' value='<?php echo $_POST['name'] ?>' maxlength="50" /><br/>
                    <span id='register_name_errorloc' class='error'> <?php echo $errores['name']; ?> </span>
                </div>
                <div class='container'>
                    <label for='email' >Email:</label><br/>
                    <input type='text' name='email' id='email' value='<?php echo $_POST['email']; ?>' maxlength="50" /><br/>
                    <span id='register_email_errorloc' class='error'> <?php echo $errores['email']; ?>  </span>
                </div>
                <div class='container'>
                    <label for='username' >Nombre de usuario*:</label><br/>
                    <input type='text' name='username' id='username' value='<?php echo $_POST['username']; ?>' maxlength="50" /><br/>
                    <span id='register_username_errorloc' class='error'><?php echo $errores['username']; ?></span>
                </div>
                <div class='container' style='height:80px;'>
                    <label for='password' >Contaseña*:</label><br/>
                    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
                    <input type='password' name='password' id='password' maxlength="50" />
                    <div id='register_password_errorloc' class='error' style='clear:both'><?php echo $errores['password']; ?></div>
                </div>

                <div class='container'>
                    <input type='submit' name='Submit' value='Registrar' />
                </div>

            </fieldset>
        </form>

    </body>
</html>
