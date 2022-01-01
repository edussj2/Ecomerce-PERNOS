<?php 
    $provincia=$_POST['idProvincia'];

	include 'conexion.php';

    $resultado = $conexion->query("SELECT idDistrito ,DisDescripcion
    FROM distrito
    WHERE idProvincia = $provincia
    ORDER BY DisDescripcion ASC")or die($conexion->error);


    $html.= '<option value="Sin Datos" selected="true">Seleccione un Distrito</option>';

    while($fila = mysqli_fetch_array($resultado))
    {
        $html.= "<option value='".$fila['idDistrito']."'>".$fila['DisDescripcion']."</option>";
    }
    
    echo $html;
?>