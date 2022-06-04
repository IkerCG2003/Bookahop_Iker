
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="./css/styles.css">
		<!-- BOOTSTRAP -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <title>Iniciar Sesión</title>
    </head>

    <body class="cuerpoInicio">
        <section id="paginaPresentacion">
            <!-- PESTAÑA DE ALUMNO -->
            <div >
                <div id="contContTitulo">
                    <div id="contTitulo">
                        <h1 id="titulo" class="flex">Inicio de Sesión</h1>
                    </div>
                </div>        
                
                <div id="contenedor">
                    <div id="contInformacion">
                        <div id="contenedorImagen">
                            <img src="./img/perfil.png" id="imagen">
                        </div>

                        <div id="informacion">
                            <div class="form">
                                <form method="post" class="formulario" id="formulario">
                                    <p><input type="text" placeholder="correo" name="mail"></p>
                                    <p><input type="password" placeholder="contraseña" name="contra"></p>
                                    <br>
                                    <p><button type="submit" class="btn btn-secondary boton" id="boton" name="enviar">Enviar</button></p>
                                </form>
                            </div>                   
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

<?php

    session_start();
    if(isset($_SESSION['username'])) 
    {
        header('location: ./app/buscar.php');
    }

    if(isset($_POST['enviar']))
	{

        if(isset($_SESSION['username'])) 
		{
            header('location: ./app/buscar.php');
        }

        $conn = mysqli_connect('localhost','root','','bookshop');

        if(!$conn) 
		{
            die("no hay conexión: ".mysqli_connect_error());
        }

        $mail = $_POST['mail'];
        
        $pass = $_POST['contra'];

        $sql = " SELECT * FROM `users` WHERE `email` = '$mail' AND `password` = '$pass' ";

        $query = mysqli_query($conn,$sql);

        $exito = mysqli_num_rows($query);

        if(!isset($_SESSION['username'])) 
		{
            if($exito == 1) 
			{
                $_SESSION['username'] = $mail;
                header('Location: ./app/buscar.php ');
            }
			else if($exito == 0) 
			{
                echo "<script>alert('el usuario no existe');window.location='./index.php'</script>";
            }
        }
    }

?>