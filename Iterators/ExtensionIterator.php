<?php

class ExtensionIterator extends \FilterIterator	{

	private $extensions;

	public function __construct( \Iterator $iterator, $extensions )	{
		parent::__construct($iterator);
        $this->extensions = $extensions;
	}

	public function accept()	{

		$current = $this->getInnerIterator()->current();

		if( is_string($current) ) {
            $extension = end( explode('.', $current) );
        }	else {
            $extension = $current->getExtension();            
        }

        return in_array($extension,$this->extensions);
	}
}