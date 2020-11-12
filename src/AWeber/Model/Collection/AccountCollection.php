<?php

namespace usamawaleed\AWeber\AWeber\Model\Collection;

use usamawaleed\AWeber\AWeber\Model\Account;

class AccountCollection extends AbstractCollection
{
    protected $entityClassType = Account::class;
    protected $getPk = 'getId';
}