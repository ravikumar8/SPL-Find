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
4. sortByName
5. sortByNaturalName
6. sortByType
7. sortByAccessedTime
7. sortByChangedTime
8. sortByModifiedTime
9. onlyFiles
10. onlyDirectories

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
#### sortByName
Filter files by name
```
	$files = $find->sortByName()->in( $path );	
```
#### sortByNaturalName
Filter files by natural name
```
	$files = $find->sortByNaturalName()->in( $path );	
```
#### sortByType
Filter by file or directory
```
	$files = $find->sortByType()->in( $path );	
```
#### sortByAccessedTime
Filter files by last accessed time
```
	$files = $find->sortByAccessedTime()->in( $path );	
```
#### sortByChangedTime
Filter files by last changed time
```
	$files = $find->sortByChangedTime()->in( $path );	
```
#### sortByModifiedTime
Filter files by last modified time
```
	$files = $find->sortByModifiedTime()->in( $path );	
```
#### onlyFiles
Filter only files
```
	$files = $find->onlyFiles()->in( $path );	
```
#### onlyDirectories
Filter only directories
```
	$files = $find->onlyDirectories()->in( $path );	
```

### License ###

Released under the [MIT](http://www.opensource.org/licenses/mit-license.php) license<br>
Copyright (c) 2014 Ravi Kumar