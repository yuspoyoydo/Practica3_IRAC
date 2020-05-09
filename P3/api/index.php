<?php

    // Cabeceras de la respuesta
    header( 'Expires: Mon, 20 Dec 1998 01:00:00 GMT');
    header( 'Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GM');
    header( 'Cache-Control: no-cache, must-revalidate');
    header( 'Pragma: no-cache');
    header('Access-Control-Allow-Origin: *'); // Para permitir CORS
    header('Access-Control-Allow-Headers: origin,range,accept,accept-encoding,referer,content-type, SOAPAction');
    header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST');
    header('Access-Control-Expose-Headers: server,range,content-range,content-length,content-type');

    // Buscamos un metodo GET, cuando se pida OPTIONS cerramos
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('Content-Length: 0');
        header('Expires: -1');
        return;
    }

    // Comprobar que el Request del DASH es valido
    $kid = explode('?', $_SERVER['REQUEST_URI'])[1];
    if (!isset($kid)) exit(-1);

    // Mapa de llaves
    $keys = array(
        "oW5AK5BW43HzbTSKpiu3SQ" => "hyN9IKGfWKdAwFaE5pm0qg"
    );

    // Crear esqueleto de la respuesta
    $resp = ['keys' => [], 'type' => 'temporary'];

    // Añadir llaves a la respuesta
    array_push($resp['keys'], ['k' => $keys[$kid], 'kty' => 'oct', 'kid' => $kid]);

    // Imprimir respuesta
    echo json_encode($resp);