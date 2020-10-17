<?php

$destinatario = "hondurasconecta@gmail.com";
$destinatario_cc = "";
$destinatario_bcc = "";
$asunto  = "Mensaje de Contacto - HondurasConecta.com"; 
$mensaje  = "";
$campos_obligatorios  = Array();
$campo_nombre = "Nombre"; // Campo del formulario con el nombre del visitante
$campo_correo = "Email"; // Campo del formulario con el correo del visitante
 // CONFIGURACION HTML
$enviado_bien = "Su formulario ha sido enviado correctamente";
$enviado_mal  = "ERROR: No se pudo enviar";

// RECOGER DATOS 
reset ($_POST);

$mensaje .= "<table border=\"1\">";
while (list ($clave, $valor) = each ($_POST)) {
  $clave = htmlspecialchars($clave);
  $valor = htmlspecialchars(trim($valor));
  $mensaje .= "<tr><th>" . $clave . "</th><td>" . $valor . "</td></tr>";
}
$mensaje .= "<tr><th>Fecha de consulta</th><td>" . date("d/m/Y H:i:s") . "</td></tr>";
$mensaje .= "</table>";


// VARIABLES INTERNAS
$nombre = $_POST[$campo_nombre];
$correo = $_POST[$campo_correo];
$cabeceras = "MIME-Version: 1.0\r\n"; //para el envío en formato HTML 
$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
if ($correo != "") {
 $cabeceras .= "From: " . $nombre . " <" . $correo . ">\r\n"; // Dirección del remitente 
 $cabeceras .= "Reply-To: " . $nombre . " <" . $correo . ">\r\n"; // Dirección de respuesta
}
if ($destinatario_cc != "") { $cabeceras .= "Cc: " . $destinatario_cc . "\r\n"; }
if ($destinatario_bcc != "") { $cabeceras .= "Bcc: " . $destinatario_bcc . "\r\n"; }

if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
	echo "<h1>¡Tu mensaje ha sido enviado con éxito!</h1>";
  echo "<script> window.location='index.html'; </script>";
  
} else {
  echo $enviado_mal;
}



?>