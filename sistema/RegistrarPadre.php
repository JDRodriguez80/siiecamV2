<?php
    if(!empty($_POST)){
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['primApellido']) || empty($_POST['telefono']) || empty($_POST['oficio']) || empty($_POST['curp']) || empty($_POST['escolaridad'])){
            $alert='<p class="msg_error"> Favor de llenar todos los campos. </p>';
        } else{include "../conexion.php";
            $nombre= $_POST['nombre'];
            $primApellido= $_POST['primApellido'];
            $segApellido= $_POST['segApellido'];
            $telefono= $_POST['telefono'];
            $oficio= $_POST['oficio'];
            $curp= $_POST['curp'];
            $escolaridad= $_POST['escolaridad'];
            $user=$_POST['usuario'];
            $email=$_POST['email'];
            //valores por defecto
            $idNivel=9;//relativo a nivel "padre de familia"
            $estatus=0;//desactivado
            $password=md5(mysqli_real_escape_string($conn, "cam10s"));//password por default que debera ser cambiado al momento del primer acceso del padre de familia
            $hash=md5( rand(0,1000) ); //creando hash personalizado para cada usuario, este sera utilizado para fines de verificacion de email y activacion de cuenta.

            // checando por dupicidades en la base de datos
            $query= mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario='$user' or email='$email'");
            $result= mysqli_fetch_array($query);
            if($result>0){
                $alert='<p class="msg_error"> Correo electronico o usuario ya existen </p>';
            }else{
                $queryInsert=mysqli_query($conn, "call spCrearPadre('$user', '$email','$password','$estatus', '$idNivel', '$hash', '$nombre','$primApellido', '$segApellido','$telefono', '$oficio', '$curp', '$escolaridad')");
                 if($queryInsert){
                     $alert='<p class="msg_success"> Padre agregado de manera correcta. </p>';
                 }else{
                     $alert='<p class="msg_error"> Fallo en la inserción, favor de checar la información. </p>>';
                 }
            }



        }
    }
?>

<!doctype html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <?php include "../sistema/includes/scripts.php";?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Registrar Padre</title>
</head>
<body>
<?php include 'includes/header.php'?>
<section id="container">
        <div class="form-Registro">
            <h1>Registro de padres</h1>

            <div class="alert"><?php echo isset($alert) ? $alert:'' ?> </div>
                <form action="" method="post">



                    <label for="nombres">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                    <label for="primApellido">Primer Apellido:</label>
                    <input type="text" name="primApellido" id="primApellido"placeholder="Primer Apellido">
                    <label for="segApellido">Segundo Apellido:</label>
                    <input type="text" name="segApellido" id="segApellido" placeholder="Segundo Apellido">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono">
                    <label for="oficio">Oficio:</label>
                    <input type="text" name="oficio" id="oficio"placeholder="Oficio">
                    <label for="curp">CURP:</label>
                    <input type="text" name="curp"id="curp" placeholder="CURP">
                    <label for="email">Correo Electrónico:</label>
                    <input type="text" name="email" id="email" placeholder="Email Padre">
                    <label for="usuario">Usuario</label>
                    <input type="text"name="usuario" id="usuario" placeholder="Usuario">
                    <label for="Escolaridad">Escolaridad:</label>
                    <select name="escolaridad" id="escolaridad">

                            <?php
                            include_once "../conexion.php";
                            $consulta="SELECT * FROM escolaridad";
                            $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));

                            ?>
                            <?php foreach ($ejecutar as $opciones):?>
                                <option value="<?php echo $opciones['idEscolaridad']?>"><?php echo $opciones['escolaridad']?></option>
                            <?php endforeach;?>
                        </select>
                    <input type="submit" value="Crear Padre" class="btn_Guardar">

                </form>

        </div>
</section>
<?php include "includes/footer.php";?>
</body>
</html>

