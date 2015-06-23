<?php

namespace Richardchey\Fund;

class ConcreteFactory
{
    protected $typeList;

    public function __construct()
    {
        $this->typeList = array(
            '001034' => __NAMESPACE__ . '\Fund001034',
            '001238' => __NAMESPACE__ . '\Fund001238'
        );
    }

    public function createFund($type)
    {
        if (!array_key_exists($type, $this->typeList)) {
            throw new \InvalidArgumentException("$type is not valid fund");
        }
        $className = $this->typeList[$type];

        return new $className();
    }
}
