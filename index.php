<?php

include_once 'Find.php';

//$path 		=	realpath( 'D:\xampp\htdocs\webloper\Gallery\uploads' );

$path 		=	realpath( 'Your Path' );

$find = new Find;
$files = $find->depth(2)->in( $path );

$index = 1;
foreach( $files as $key => $file) {
	echo '<pre> ' , $index . ' ' , print_r($file, 1), ' ', print_r($file->getSize(), 1), '</pre>';
	$index++;
}