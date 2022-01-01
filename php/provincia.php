<?php 
    $departamento=$_POST['idDepartamento'];

	include 'conexion.php';

    $resultado = $conexion->query("SELECT idProvincia ,ProvDescripcion
    FROM provincia
    WHERE idDepartamento = $departamento
    ORDER BY ProvDescripcion ASC")or die($conexion->error);

    $html .= '<option value="Sin Datos" selected="true">Seleccione una provincia</option>';

    while($fila = mysqli_fetch_array($resultado))
    {
        $html.= "<option value='".$fila['idProvincia']."'>".$fila['ProvDescripcion']."</option>";
    }
    
    echo $html;
?>