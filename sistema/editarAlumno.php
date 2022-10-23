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

        //checando por duplicados
        $query=mysqli_query($conn, "SELECT*FROM alumnos WHERE curp='$curp'");
        $result=mysqli_fetch_array($query);
        if($result>0){
            $alert='<p class="msg_error"> El alumno ya existe </p>';
        }else{
            $query= mysqli_query($conn, "CALL spInsertarAlumno('$nombre','$primApellido','$segApellido','$fdn','$curp', '$sexo','$discapacidad', '$telefono','$alergias','$tipoSangre',
                '$desayunos','$grupo','$estatura','$peso')");
            if($query){
                $alert='<p class="msg_success"> Alumno agregado de manera correcta. </p>';
            }else{
                $alert='<p class="msg_error"> Fallo en la inserción, favor de checar la información. </p>>';
            }
        }
    }
}
//mostrar datos
    //checando por id vacio
    if (empty($_GET['id'])){
        header('Location:ListarAlumnos.php');
    }
    //checando por id existente
    include "../conexion.php";
    $idusuario=$_GET['id'];
    $querry =mysqli_query($conn,"SELECT*FROM alumnos WHERE idAlumno='$idusuario'");
    $result=mysqli_fetch_array($querry);
    if($result==0){

        header('Location:ListarAlumnos.php');
    }else{
        while($data=mysqli_fetch_array($querry)){
            $idAlumno=$data['idAlumno'];
            $nombreAlumno=$data['nombre'];
            $primAp=$data['primApellido'];
            $segAp=$data['segApellido'];
            $fdnAlumno=$data['fdn'];
            $curpAlumno=$data['curp'];
            $sexoAlumno=$data['sexo'];
            $discapacidadAlumno=$data['idDiscapacidad'];
            $telefonoAlumno= $data['telefono'];
            $alergiasAlumno=$data['alergias'];
            $tipoSangreAlumno=$data['idTiposangre'];
            $desayunosAlumno=$data['desayuno'];
            $grupoAlumno=$data['idgrupo'];
            $estaturaAlumno=$data['estatura'];
            $pesoAlumno=$data['peso'];

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

    <title>Editar Alumno</title>
</head>
<body>
<?php include 'includes/header.php'?>

<section id="container">

    <div class="form-Registro2">
        <h1>EDITAR ALUMNO</h1>

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
                    <input type="text" name="Calle"id="Calle" placeholder="Calle">
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
                    <input type="text" name="estado"id="estado" placeholder="Estado">
                </li>
                <li>
                    <label for="municipio">Municipio:</label>
                    <input type="text" name="municipio" id="municipio" placeholder="Municipio">
                </li>
                <li>
                    <div id="Col">
                        <label for="colonia">Colonia:</label>
                        <select name="colonia" id="colonia">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                </li>
                <li></li>
                <li></li>
                <li><input type="submit" value="Editar Alumno" class="btn_secondary-color-dark"></li>
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
</script>

<?php include "includes/footer.php";?>
</body>
</html>

