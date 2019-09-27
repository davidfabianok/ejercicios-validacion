<?php 
require_once('funciones.php');

$errores = [];
if($_POST){
    
    $errores = validationUser($_POST);
    if(!$errores) {
        //SESION
        header('location: miPerfil.php');
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
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
        <form id='login' action='login.php' method='post'>
            <fieldset >
                <legend>Inicia sesion</legend>        
                <div class='container'>
                    <span id='login_username_errorloc' class='error'><?php echo $errores['login'] ?></span><br>
                    <label for='username' >Nombre de usuario <br> o Correo electronico*:</label><br/>
                    <input type='text' name='username' id='username' value='' maxlength="50" /><br/>
                    
                </div>
                <div class='container' style='height:80px;'>
                    <label for='password' >Contaseña*:</label><br/>
                    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
                    <input type='password' name='password' id='password' maxlength="50" />
                    <div id='login_password_errorloc' class='error' style='clear:both'><?php ?></div>
                </div>

                <div class='container'>
                    <input type='submit' name='Submit' value='Ingresar' />
                </div>

            </fieldset>
        </form>

    </body>
</html>