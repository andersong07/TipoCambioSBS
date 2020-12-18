<?php

// Definimos la función cURL
    function curl($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $info = curl_exec($ch); 
        curl_close($ch);
        return $info;
    }
	$queryString = http_build_query([ 
    'access_key' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 
		'url' => 'https://www.sbs.gob.pe/app/stats/seriesH-tipo_cambio_moneda_excel.asp?fecha1=01/01/2020&fecha2=31/12/2020&moneda=02&cierre=', 
	]);
	$apiURL = sprintf('%s?%s', 'http://api.scrapestack.com/scrape', $queryString);
    $sitioweb = curl($apiURL);
    
	//var_dump($sitioweb);
	$array = array('<TABLE BORDER=1>','</TABLE>');
	$webhtml=str_replace($array,"",$sitioweb);
	$rows = explode('<TR>',$webhtml);
	$registro_final = end($rows);
	$data = explode('<TD>',$registro_final);
	$fecha = $data[1];
	$compra = (float) $data[3];
	$venta = (float) $data[4];
	
	echo '<br>';	
	echo $fecha;	
	echo '<br>';
	echo $compra;	
	echo '<br>';
	echo $venta;

?>
