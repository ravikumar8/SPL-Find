<?php

include_once 'Find.php';

$path 		=	realpath( 'C:\xampp\htdocs\Gallery\uploads' );

$find = new Find;
$files = $find->sort(2)->limit(2,5)->extension( ['jpg'])->in( $path );

foreach( $files as $key => $file) {
	echo '<pre> ' , $key . ' <br> ' , print_r($file, 1), '</pre>';
}