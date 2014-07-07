<?php

class SortingIterator implements \IteratorAggregate	{

	const SORT_BY_NAME 		= 	1;
	const SORT_BY_NAT_NAME 	= 	2;

	private $iterator 	=	null;
	private $callback 	=	null;

    public function __construct(\Traversable $iterator, $callback)	{

    	$this->iterator = $iterator;

        if (self::SORT_BY_NAME === $callback) {
            $this->callback = function ($a, $b) {
                return strcmp($a->getRealpath(), $b->getRealpath());
            };
        }	elseif (self::SORT_BY_NAT_NAME === $callback) {
            $this->callback = function ($a, $b) {
                return strnatcasecmp($a->getRealpath(), $b->getRealpath());
            };
        }	elseif (is_callable($callback)) {
            $this->callback = $callback;
        }	else {
        	throw new \InvalidArgumentException(sprintf('Callback must be callable (%s given).', $callback));
        }
    }

    public function getIterator()	{
        $array = iterator_to_array($this->iterator);
        usort($array, $this->callback);
        return new \ArrayIterator($array);
    }
}