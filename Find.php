<?php

include_once 'Iterators\ExtensionIterator.php';
include_once 'Iterators\SortingIterator.php';

abstract class Operations	{

	protected abstract function _extension();
	protected abstract function _sort();
	protected abstract function _limit();

	public function in( $path )	{

		$path		=	realpath( $path ); 

		$flags		=	\FilesystemIterator::FOLLOW_SYMLINKS | 
						\FilesystemIterator::CURRENT_AS_FILEINFO | 
						\FilesystemIterator::SKIP_DOTS;

		$iterator 	=	new \RecursiveDirectoryIterator( $path, $flags );

		$iterator 	=	new \RecursiveIteratorIterator( $iterator );

		if( ! empty( $this->_extension() ) )	{
			$iterator 	= 	new \ExtensionIterator($iterator, $this->_extension() );
		}		

		if( ! is_null( $this->_sort() ) )	{
			$iterator 	= 	new \SortingIterator($iterator, $this->_sort() );
			$iterator 	=	$iterator->getIterator();
		}

		$limit 		=	$this->_limit();
		if( ! empty( $limit[0] ) && ! empty( $limit[1] ) )	{			
			$iterator 	= 	new \LimitIterator($iterator, $limit[0], $limit[1] );
		}

		return $iterator;
	}
}

class Find extends Operations {

	private $extensions 	=	[];
	private $method			=	null;
	private $offset			=	null;
	private $limit			=	null;
	
	protected function _extension()	{
		return $this->extensions;
	}
	
	protected function _sort()	{
		return $this->method;
	}

	protected function _limit()	{
		return [ $this->offset, $this->limit ];
	}

	public function extension($extensions)	{
		$this->extensions 	=	$extensions;

		return $this;
	}

	public function sort($method)	{
		$this->method 	=	$method;

		return $this;
	}

	public function limit($offset, $limit )	{
		$this->offset 	=	$offset;
		$this->limit 	=	$limit;

		return $this;
	}
}