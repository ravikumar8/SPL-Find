<?php

include_once 'Profiler.php';
include_once 'Find.php';

$path 		=	realpath( 'D:\xampp\htdocs\webloper\Gallery\uploads' );

$find = new Find;
$files = $find->in( $path );

foreach( $files as $key => $file) {
	echo '<pre> ' , $key . ' <br> ' , print_r($file, 1), '</pre>';
}

$profiler = new Profiler;

echo '<pre>',print_r( Profiler::included_files(), 1 );

echo '<pre>',print_r( $profiler->printMemoryUsageInformation(), 1 );