<?php
include "../conexion.php";
$grupo=$_GET['idGrupo'];
$query= "call spListarAlumno('$grupo')";

$ejecutar=mysqli_query($conn, $query) or die (mysqli_error($conn));
?>

<br>
<br>
<tr>
    <th>ID</th>
    <th>CURP</th>
    <th>Nombres</th>
    <th>Primer Apellido</th>
    <th>Segundo Apellido</th>
    <th>Acciones</th>

</tr>
<?php foreach ($ejecutar as $data):?>



    <tr>
        <td><?php echo $data['idAlumno']?></td>
        <td><?php echo $data['curp']?></td>
        <td><?php echo $data['nombre']?></td>
        <td><?php echo $data['primApellido']?></td>
        <td><?php echo $data['segApellido']?></td>
        <td>
            <a class="edit" href="editarAlumno.php?id=<?php echo  $data['idAlumno']?>"><i class="fa-solid fa-user-pen fa-2x"> </i> EDITAR</a>
            |
            <a class="delete" href="confimarEliminarAlumno.php?id=<?php echo $data['idAlumno']?>"><i class="fa-solid fa-2x fa-user-xmark"></i> BORRAR</a>

        </td>
    </tr>
<?php endforeach;?>



