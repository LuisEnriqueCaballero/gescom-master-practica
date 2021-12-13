<?php
/*$curl = curl_init();

$data = [
    'token' => 'PtJBuhWN1h8aBVCP7JaQGcPKU2MAK4mlv6SC0wE9oqbZmLAoWo0voXqPykfP'
];

$post_data = http_build_query($data);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.migo.pe/api/v1/exchange/latest",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $post_data,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}*/

/*$url   = "https://dni.optimizeperu.com/api/tipo-cambio";
$json  = file_get_contents($url);
$datos = json_decode($json, true);

//$conv  = $datos["result"];
//$conv1 = $conv["conversion"][52]["rate"];

//echo $url;

var_dump($datos);*/

//$documento_colaborador = $_POST['documento_colaborador'];
$data = file_get_contents("https://dni.optimizeperu.com/api/tipo-cambio");
$info = json_decode($data, true);

if($data==='[][]'){
	$datos = array(0 => $info['cambio_actual'] == '');
	//echo 'nada';
	//echo json_encode($datos);
}else{

$datos = array(
	0 => $info['cambio_actual']['compra']
);

echo json_encode($datos);

} ?>
<input type="text" name="valorTipoCambio" class="form-control" value="<?php echo $datos; ?>" style="font-size:12px;">