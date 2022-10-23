<?php
    if(!empty($_POST)){
        $alert='';


        if(
                empty($_POST['nombre'])|| empty($_POST['primApellido']) || empty($_POST['fdn']) || empty($_POST['curp']) || empty($_POST['discapacidad'])|| empty($_POST['grupo'])
        )

        {
            $alert='<p class="msg_error"> Favor de llenar todos los campos requeridos </p>';
        }else{
            include "../conexion.php";
            $nombre= $_POST['nombre'];
            $primApellido= $_POST['primApellido'];
            $segApellido= $_POST['segApellido'];
            $fdn=$_POST['fdn'];
            $curp=$_POST['curp'];
            $sexo=$_POST['sexo'];
            $discapacidad=$_POST['discapacidad'];
            $telefono= $_POST['telefono'];
            $alergias=$_POST['alergias'];
            $tipoSangre=$_POST['tiposangre'];
            $desayunos=$_POST['desayuno'];
            $grupo=$_POST['grupo'];
            $estatura=$_POST['estatura'];
            $peso=$_POST['Peso'];
            $calle=$_POST['calle'];
            $numero=$_POST['numero'];
            $idEstado=$_POST['estado'];
            $idMunicipio=$_POST['municipio'];
            $colonia=$_POST['colonia'];
            $idCp=$_POST['codigoPostalID'];
            //checando por el id del codigo postal
            var_dump($idCp);


            //checando por duplicados
            $query=mysqli_query($conn, "SELECT*FROM alumnos WHERE curp='$curp'");
            $result=mysqli_fetch_array($query);
            if($result>0){
                $alert='<p class="msg_error"> El alumno ya existe </p>';
            }else{
            /*$query= mysqli_query($conn, "CALL insertarAlumnos('$nombre','$primApellido','$segApellido','$fdn','$curp', '$sexo','$discapacidad', '$telefono','$alergias','$tipoSangre',
                '$desayunos','$grupo','$estatura','$peso','$colonia', '$calle', '$numero', '$idEstado','$idMunicipio', '$idCp')");

                if($query){
                    $alert='<p class="msg_success"> Alumno agregado de manera correcta. </p>';
                }else{
                    $alert='<p class="msg_error"> Fallo en la inserción, favor de checar la información. </p>>';

                }*/

            }
        }
    }
?>

<!doctype html>
<html lang="es-mx">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php";?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="../sistema/css/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Registrar Alumno</title>
</head>
<body>
<!--<?php //include 'includes/header.php'?>-->

<section id="container">

    <div class="form-Registro2">
        <h1>Registrar Alumno</h1>

        <div class="alert"><?php echo isset($alert) ? $alert:'' ?> </div>

        <form action="" method="post">

            <ul>
                <h5>Datos Personales</h5>
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" required>

            <label for="primApellido">Primer Apellido:</label>
            <input type="text" name="primApellido" id="primApellido"placeholder="Primer Apellido" required>
            <label for="segApellido">Segundo Apellido:</label>
            <input type="text" name="segApellido" id="segApellido" placeholder="Segundo Apellido">
            <li>
                <label for="fdn">Fecha de Nacimiento:</label>
                <input type="date" name="fdn" id="fdn" placeholder="Fecha de Nacimiento" required>
            </li>
            <li>
                <label for="curp">CURP:</label>
                <input type="text" name="curp"id="curp" placeholder="CURP" required>
            </li>
            <li>
                <label for=sexo">Sexo:</label>
                <select name="sexo" id="sexo" required>
                    <option value="1">M</option>
                    <option value="0">H</option>
                </select>
            </li>
            <li>
                <label for="discapacidad">Discapacidad:</label>
                <select name="discapacidad" id="discapacidad">
                    <?php
                    include_once "../conexion.php";
                    $consulta="SELECT * FROM discapacidad";
                    $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));
                    ?>
                    <?php
                    foreach ($ejecutar as $opciones):?>
                        <option value="<?php echo $opciones['idDiscapacidad']?>"><?php echo $opciones['Discapacidad']?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li>
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" placeholder="868-000-00-00" required>
            </li>
           <li>
               <label for="alergias">Alergias:</label>
               <input type="text" name="alergias" id="alergias" placeholder="Alergias">
           </li>
           <li>
               <label for="estatura">Estatura:</label>
               <input type="text" name="estatura"id="estatura" placeholder="Estatura" >
           </li>
            <li>
                <label for="Peso">Peso:</label>
                <input type="text" name="Peso"id="Peso" placeholder="Peso">
            </li>
            <li>
                <label for="tiposangre">Tipo de sangre:</label>
                <select name="tiposangre" id="tiposangre">
                    <?php
                    include_once "../conexion.php";
                    $consulta="SELECT * FROM tiposangre";
                    $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));
                    ?>
                    <?php
                        foreach ($ejecutar as $opciones):?>
                    <option value="<?php echo $opciones['idTipo']?>"><?php echo $opciones['tipo']?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li>
                <label for="desayuno">¿Toma Desayuno?</label>
                <select name="desayuno" id="desayuno" required>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </li>
               <li>
                   <label for="grupo">Grupo:</label>
                   <select name="grupo" id="grupo" >
                       <?php
                       include_once "../conexion.php";
                       $consulta="SELECT * FROM grupo";
                       $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));
                       ?>
                       <?php
                       foreach ($ejecutar as $opciones):?>
                           <option value="<?php echo $opciones['idGrupo']?>"><?php echo $opciones['grupo']?></option>
                       <?php endforeach;?>
                   </select>
               </li>

                <br>
                <h5>Dirección</h5>
                <li>
                    <label for="calle">Calle:</label>
                    <input type="text" name="calle"id="calle" placeholder="Calle">
                </li>
                <li>
                    <label for="numero">Número:</label>
                    <input type="text" name="numero"id="numero" placeholder="número" >
                </li>
                <li>

                <label for="codigo">Código Postal:</label>
                    <input type="text" name="codigo" id="codigo" placeholder="00000" required oninput="consultaCP(this.value)">

                    <li></li>
                    <li></li>
                    <li></li>


                <li>
                    <label for="estado">Estado:</label>

                    <select name="estado" id="estado" >
                        <?php
                        include_once "../conexion.php";
                        $consulta="SELECT * FROM estados where idEstado=28";
                        $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));
                        ?>
                        <?php
                        foreach ($ejecutar as $opciones):?>

                            <option value="<?php echo $opciones['idEstado']?>"><?php echo $opciones['Estado']?></option>

                        <?php endforeach;?>
                    </select>
                </li>
                <li>
                    <label for="municipio">Municipio:</label>

                    <select name="municipio" id="municipio">
                        <?php
                        include_once "conexion.php";
                        echo $idEstado;
                        $consulta="SELECT * FROM municipio where idEstado=28";
                        $ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));
                        ?>
                        <?php
                        foreach ($ejecutar as $opciones):?>
                            <option value="<?php echo $opciones['idMunicipio']?>"><?php echo $opciones['municipio']?></option>

                        <?php endforeach;?>
                    </select>

                </li>
                <li>
                    <div id="Col">
                    <label for="colonia">Colonia:</label>
                    <select name="colonia" id="colonia" onselect="idCpxColonia(this.Selection)">

                        <option value="">Seleccione</option>
                    </select>
                    </div>
                </li>
                <li>
                    <input type="text" id="codigoPostalID" name="codigoPostalID" value="">
                </li>
                <li>
                </li>

                <li><input type="submit" value="Crear Alumno" class="btn_Guardar"></li>
            </ul>

        </form>
    </div>


</section>
<!-- Script para indicar las colonias de un codigo postal-->
<script type="text/javascript">
    function consultaCP(cp){
        var conexion;
        if(cp==""){
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if(window.XMLHttpRequest){
            conexion= new XMLHttpRequest();
        }
        conexion.onreadystatechange=function (){
            if(conexion.readyState== 4 && conexion.status==200){
                document.getElementById("colonia").innerHTML=conexion.responseText;
            }
        }
        conexion.open("GET","codigopostal.php?cp="+cp,true);
        conexion.send();
    }
    function idCpxColonia(colonia){
        var conexion2;
        if(colonia==""){
            document.getElementById("txtHint").innerHTML="";
            return;
        }if(window.XMLHttpRequest){
            conexion=new XMLHttpRequest();
        }
        conexion.onreadystatechange=function (){
            if(conexion.readyState==4 && conexion.status==200){
                document.getElementById("codigoPostalID").innerHTML=conexion.responseText;
            }
        }
        conexion2.open("GET","idCPporColonia.php?colonia="+colonia,true);
        conexion2.send();
    }

</script>


<?php include "includes/footer.php";?>
</body>
</html>
