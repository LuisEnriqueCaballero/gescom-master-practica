<?php
$documento_colaborador = $_POST['documento_colaborador'];
$data = file_get_contents("http://api.ateneaperu.com/api/Reniec/Dni?sNroDocumento=".$documento_colaborador."&fbclid=IwAR3lSx_0i-U7gBGUDZAY7kbM9IMJyDzCLt8IR0BodgRvHaouPu5UgytbqFg");
$info = json_decode($data, true);

if($data==='[]'){
	$datos = array(24 => $info['nombres_completos'] == '  ');
	//echo 'nada';
	//echo json_encode($datos);
}else{

$datos = array(
	0 => $info['ruc'], 
	1 => $info['nombre_o_razon_social'],
	2 => $info['estado_del_contribuyente'],
	3 => $info['condicion_de_domicilio'],
	4 => $info['ubigeo'],
	5 => $info['tipo_de_via'],
	6 => $info['nombre_de_via'],
	7 => $info['codigo_de_zona'],
	8 => $info['numero'],
	9 => $info['interior'],
	10 => $info['lote'],
	11 => $info['dpto'],
	12 => $info['manzana'],
	13 => $info['kilometro'],
	14 => $info['departamento'],
	15 => $info['provincia'],
	16 => $info['distrito'],
	17 => $info['direccion'],
	18 => $info['direccion_completa'],
	19 => date("d/m/Y H:i:s", strtotime($info['ultima_actualizacion'])),
	20 => $info['informacion_resultado'],
	21 => $info['apellido_paterno'],
	22 => $info['apellido_materno'],
	23 => $info['nombres'],
	24 => $info['nombres_completos']
);

echo json_encode($datos);

}

?>
