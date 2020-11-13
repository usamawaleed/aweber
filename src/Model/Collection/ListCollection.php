<?php


namespace usamawaleed\AWeber\Model\Collection;


use usamawaleed\AWeber\Model\Lists;

class ListCollection extends AbstractCollection
{
    protected $entityClassType = Lists::class;
    protected $getPk = 'getId';
}