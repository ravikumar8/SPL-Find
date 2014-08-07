<?php

include_once 'Find.php';

$path 		=	realpath( 'D:\xampp\htdocs\webloper\Gallery\uploads' );

$find = new Find;
$files = $find->in( $path );

foreach( $files as $key => $file) {
	echo '<pre> ' , $key . ' <br> ' , print_r( $file, 1 ), '</pre>';
}