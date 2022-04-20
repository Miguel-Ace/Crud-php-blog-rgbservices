<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e0c685abde.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>css/estilo.css">
</head>
<body>
    <header>
        <div class="contenedor">
            <div class="logo izquierda">
                <a href="<?php echo RUTA;?>"><img src="logo/RGB_Services.png"></a>
            </div>

            <div class="derecha">
                <form name="busqueda" class="buscar" action="<?php echo RUTA; ?>/buscar.php" method="get">
                    <input type="text" name="busqueda">
                    <button type="submit" class="icono fa fa-search"></button>
                </form>

                <nav class="menu">
                    <ul>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?php echo RUTA;?>contacto.php">Contacto<i class="icono fa fa-envelope"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
<div class="contenedor contacto">
    
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <input type="email" name="correo" placeholder="Tu correo" value="<?php if(!$enviado && isset($correo)) echo $correo;?>">
        <textarea name="mensaje" class="mensaje" placeholder="Mensaje"><?php if(!$enviado && isset($mensaje)) echo $mensaje;?></textarea>


        <?php if(!empty($error)):?>
            <div class="alert error">
                <p><?php echo $error;?></p>
            </div>
        <?php elseif($enviado):?>
            <div class="alert success">
                <p>ENVIADO</p>
            </div>
        <?php endif;?>

        <input type="submit" name="submit">
        </form>
</div>
<?php require 'footer.php';?>