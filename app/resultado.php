<?php 

session_start() ;

if(isset($_SESSION['username'])) 
{
    $usuario = $_SESSION['username'] ;
}

else 
{
    header('location: ../index.php') ;
}

if(isset($_POST['volver'])) 
{
    header('location: buscar.php') ;
}

$conexion = mysqli_connect('localhost','root','','bookshop');

$resul = $_POST['caja_busqueda'] ;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>

        <script src="../Alert/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="../Alert/sweetalert.css">
        <link rel="stylesheet" href="./css/styles.css">
        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

        <!-- ESTILO CURSOS DE PROGRAMACION -->
        <link rel="stylesheet" href="../css/styles.css">
        <title>Consulta basica</title>
    </head>

    <body>

        <!-- BUSCADOR / FILTRO -->

        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <a class="navbar-brand" id="bienve" href="buscar.php">Bienvenido: <?php echo $usuario ?></a>
        </nav>

        <!-- TABLAS -->

        <div id="fondoTabla">
            <div>
                <br>
                <div id="contTitulo">
                    <div id="titulo2">
                        <p>Contenido de la tabla Books</p>
                    </div>
                </div>
                
                <div class="container-fluid p-2" id="tabla">
                    <?php 
                    if(!empty($_REQUEST["nume"]))
                    { 
                        $_REQUEST["nume"] = $_REQUEST["nume"];}else{ $_REQUEST["nume"] = '1';
                    }
                        if($_REQUEST["nume"] == "" )
                        {$_REQUEST["nume"] = "1";
                    }
                    
                    $resul = $_POST['caja_busqueda'] ;

                    $articulos=mysqli_query($conexion,"SELECT * FROM books WHERE titulo LIKE '%".$resul."%' ;");

                    $num_registros=@mysqli_num_rows($articulos);
                    ?>

                    <h3 class="card-tittle" id="resul">Resultados (<?php echo $num_registros; ?>)</h3>
                    <div class="container_card">
                        <table class="table table-striped table-condensed table-bordered">   
                            <thead>   
                                <tr>   
                                    <th class="id">#</th>    
                                    <th class="tit">Título</th>   
                                    <th class="fech">F. Publicación</th>   
                                    <th class="sec">Sección</th>
                                </tr>   
                            </thead>

                            <tbody>   
                                <?php     
                                    while ($row = mysqli_fetch_array($articulos)) {    
                                ?>     
                                <tr>     
                                    <td class="id"><?php echo $row["id"]; ?></td>     
                                    <td class="tit"><?php echo $row["titulo"]; ?></td>
                                    <td class="fech"><?php echo $row["publication"]; ?></td>   
                                    <td class="sec"><?php echo $row["section"]; ?></td>   
                                </tr>     
                                <?php     
                                    };    
                                ?>     
                            </tbody> 
                        </table>
                    </div>
                </div>
                
                <!-- BOTÓN CERRAR SESIÓN -->

                <div id="boton" class="boton2">
                    <form action="" method="post">
                    <button type="submit" class="btn-dark" name="volver">Volver</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

