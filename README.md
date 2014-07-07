SPL Find
==========

This package provides specialized Iterator classes for finding files and directories.

```
	include_once 'Find.php';

	$path 		=	realpath( 'YOUR_PATH' );

	$find = new Find;
	$files = $find->in( $path );

	foreach( $files as $key => $file) {
		echo '<pre> ' , $key . ' <br> ' , print_r($file, 1), '</pre>';
	}
```
### Methods

It uses template and fluent design pattern. 

1. extension
2. sort
3. limit

#### extension
This is used to filter the files on the basis of extensions of the file.
```
	$files = $find->extension(['jpg'])->in( $path );	
```
#### sort
This is used to sort the files. <br>
const SORT_BY_NAME		=	1 <br>
const SORT_BY_NAT_NAME 	= 	2
```
	$files = $find->sort( 2 )->in( $path );	
```
#### limit
This is used to limit the output files.
```
	$files = $find->limit( $offset, $limit )->in( $path );	
```