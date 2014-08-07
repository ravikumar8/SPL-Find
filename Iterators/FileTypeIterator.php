<?php

class FileTypeIterator extends \FilterIterator	{

	const ONLY_FILES        = 1;
    const ONLY_DIRECTORIES  = 2;

    private $type;

	public function __construct( \Iterator $iterator, $type )	{

		parent::__construct($iterator);
        $this->type = $type;
	}

	public function accept()	{

		$current = $this->current();

        if (self::ONLY_DIRECTORIES === (self::ONLY_DIRECTORIES & $this->type) && $current->isFile() ) {
        		return false;
        } 	elseif (self::ONLY_FILES === (self::ONLY_FILES & $this->type) && $current->isDir() ) {
            	return false;
        } 	

        return true;
	}
}