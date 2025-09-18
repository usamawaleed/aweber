<?php

namespace usamawaleed\AWeber\Model\Collection;

use usamawaleed\AWeber\Model\Subscriber;

class SubscriberCollection extends AbstractCollection
{
    protected function getCollectionType()
    {
        return 'subscriber';
    }

    public function addItem(Subscriber $subscriber)
    {
        $this->data[] = $subscriber;
    }
}
