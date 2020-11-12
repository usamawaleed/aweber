<?php


namespace usamawaleed\AWeber\Aweber\Model\Collection;


use usamawaleed\AWeber\Aweber\Model\Lists;

class ListCollection extends AbstractCollection
{
    protected $entityClassType = Lists::class;
    protected $getPk = 'getId';
}