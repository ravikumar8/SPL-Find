<?php

class SortingIterator implements \IteratorAggregate	{

	const SORT_BY_NAME             = 	1;
	const SORT_BY_NAT_NAME         = 	2;
    const SORT_BY_TYPE             =    3;
    const SORT_BY_ACCESSED_TIME    =    4;
    const SORT_BY_CHANGED_TIME     =    5;
    const SORT_BY_MODIFIED_TIME    =    6;

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
        }	elseif (self::SORT_BY_TYPE === $callback) {
                $this->callback = function ($a, $b) {
                    if ($a->isDir() && $b->isFile()) {
                        return -1;
                    } elseif ($a->isFile() && $b->isDir()) {
                        return 1;
                    }

                    return strcmp($a->getRealpath(), $b->getRealpath());
                };
        }   elseif (self::SORT_BY_ACCESSED_TIME === $callback) {
                $this->callback = function ($a, $b) {
                    return ($a->getATime() - $b->getATime());
                };
        }   elseif (self::SORT_BY_CHANGED_TIME === $callback) {
                $this->callback = function ($a, $b) {
                    return ($a->getCTime() - $b->getCTime());
                };
        }   elseif (self::SORT_BY_MODIFIED_TIME === $callback) {
                $this->callback = function ($a, $b) {
                    return ($a->getMTime() - $b->getMTime());
                };
        }   elseif (is_callable($callback)) {
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