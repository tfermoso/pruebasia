<?php

$xmlUrl = "https://www.frutasnievesonline.com/fno_googleshopping-s1-es-EUR.xml";
$xml = simplexml_load_file($xmlUrl, null, LIBXML_NOCDATA);

$contexto = "Catálogo de productos de Frutas Nieves Online:\n\n";
$contador = 0;

foreach ($xml->channel->item as $item) {
    $titulo = trim((string)$item->title);
    $precio = trim((string)$item->children('g', true)->price);
    $descripcion = trim((string)$item->description);

    // Extraer origen y categoría desde la descripción
    $origen = "";
    $categoria = "";

    if (strpos($descripcion, "Origen:") !== false) {
        $partes = explode("Origen:", $descripcion);
        if (isset($partes[1])) {
            $subpartes = explode("Categoría:", $partes[1]);
            $origen = trim($subpartes[0]);
            if (isset($subpartes[1])) {
                $categoria = trim($subpartes[1]);
            }
        }
    }

    $contexto .= "Producto: $titulo\n";
    $contexto .= "Precio: $precio\n";
    if ($origen) $contexto .= "Origen: $origen\n";
    if ($categoria) $contexto .= "Categoría: $categoria\n";
    $contexto .= "\n";

    $contador++;
    if ($contador >= 20) break; // Limita a 20 productos (puedes quitar esta línea si quieres todos)
}

echo nl2br(htmlentities($contexto));
