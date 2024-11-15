<?php


// echo json_encode(  $_SERVER , JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


//echo PHP_OS_FAMILY;// hash('sha256', 'The quick brown fox jumped over the lazy dog.');


$metodos = openssl_get_cipher_methods();
echo "Métodos de criptografia suportados:\n";
foreach ($metodos as $metodo) {
	echo $metodo . "\n";
}

?>

