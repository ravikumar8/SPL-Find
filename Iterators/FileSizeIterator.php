<?php

class FileSizeIterator extends \FilterIterator 	{

	private $size;

	public function __construct( \Iterator $iterator, $size )	{
		parent::__construct($iterator);
        $this->size = $size;
	}

	public function accept()	{

		$file = $this->current();

		preg_match('#^(?:([=<>!]=?|<>)\s*)?((?:\d*\.)?\d+)\s*(K|M|G|T|)B?\z#i', $this->size, $matches);

		list(, $operator, $size, $unit) = $matches;

		static $units = array('' => 1, 'k' => 1024 , 'm' => 1048576, 'g' => 1073741824, 't' => 1099511627776 );
		$size 		*= $units[strtolower($unit)];
		$operator 	 = $operator ? $operator : '=';

		switch ($operator) {
			case '>':
				return $file->getSize() > $size;
			case '>=':
				return $file->getSize() >= $size;
			case '<':
				return $file->getSize() < $size;
			case '<=':
				return $file->getSize() <= $size;
			case '=':
			case '==':
				return $file->getSize() == $size;
			case '!':
			case '!=':
			case '<>':
				return $file->getSize() != $size;
			default:
				return false;
		}
	}
}