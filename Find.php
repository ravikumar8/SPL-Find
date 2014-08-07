<?php

include_once 'Iterators\ExtensionIterator.php';
include_once 'Iterators\SortingIterator.php';
include_once 'Iterators\FileTypeIterator.php';

abstract class Operations	{

	protected abstract function _extension();
	protected abstract function _sort();
	protected abstract function _limit();

	/**
	 * in denotes folder path
	 * @param  string $path
	 * @return mixed
	 */
	public function in( $path )	{

		$path		=	realpath( $path ); 

		$flags		=	\FilesystemIterator::SKIP_DOTS;

		$iterator 	=	new \RecursiveDirectoryIterator( $path, $flags );

		$iterator 	=	new \RecursiveIteratorIterator( $iterator, \RecursiveIteratorIterator::SELF_FIRST );

		if( $this->_type() )	{
			$iterator 	= 	new \FileTypeIterator($iterator, $this->_type() );
		}

		if( ! empty( $this->_extension() ) )	{
			$iterator 	= 	new \ExtensionIterator($iterator, $this->_extension() );
		}		

		if( ! is_null( $this->_sort() ) )	{
			$iterator 	= 	new \SortingIterator($iterator, $this->_sort() );
			$iterator 	=	$iterator->getIterator();
		}

		$limit 		=	array_filter( $this->_limit() );		
		if( 2 == count( $limit ) )	{	
			$iterator 	= 	new \LimitIterator($iterator, $limit[0], $limit[1] );
		}

		return $iterator;
	}
}

class Find extends Operations {

	private $extensions 	=	[];
	private $type			=	0;
	private $method			=	null;
	private $offset			=	null;
	private $limit			=	null;
	
	protected function _type()	{
		return $this->type;
	}

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

	public function sortByName()	{
		$this->method 	=	SortingIterator::SORT_BY_NAME;

		return $this;
	}

	public function sortByNaturalName()	{
		$this->method 	=	SortingIterator::SORT_BY_NAT_NAME;

		return $this;
	}
	
	public function sortByType()	{
		$this->method 	=	SortingIterator::SORT_BY_TYPE;

		return $this;
	}

	public function sortByAccessedTime()	{
		$this->method 	=	SortingIterator::SORT_BY_ACCESSED_TIME;

		return $this;
	}

	public function sortByChangedTime()	{
		$this->method 	=	SortingIterator::SORT_BY_CHANGED_TIME;

		return $this;
	}

	public function sortByModifiedTime()	{
		$this->method 	=	SortingIterator::SORT_BY_MODIFIED_TIME;

		return $this;
	}

	public function onlyFiles()	{
		$this->type 	=	FileTypeIterator::ONLY_FILES;

		return $this;
	}

	public function onlyDirectories()	{
		$this->type 	=	FileTypeIterator::ONLY_DIRECTORIES;

		return $this;
	}

	public function limit($offset, $limit )	{
		$this->offset 	=	$offset;
		$this->limit 	=	$limit;

		return $this;
	}
}