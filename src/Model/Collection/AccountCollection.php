<?php

namespace usamawaleed\AWeber\Model\Collection;

use usamawaleed\AWeber\Model\Account;

class AccountCollection extends AbstractCollection
{
    protected $entityClassType = Account::class;
    protected $getPk = 'getId';
}