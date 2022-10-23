<?php
include_once "../conexion.php";
$codigo=$_GET['cp'];
$idCodigo;
$consulta="SELECT * FROM `codigopostal`WHERE CP ='$codigo'";
$ejecutar=mysqli_query($conn, $consulta) or die(mysqli_error($conn));

?>
<?php foreach ($ejecutar as $opciones):?>
    <option value="<?php echo $opciones['idCP']?>"><?php echo $opciones['Colonia']?></option>


<?php endforeach;?>


