<?php


namespace usamawaleed\AWeber\Provider;

class AweberUserLists
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * AweberUserLists constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->data = $response;
    }

    public function getId()
    {
        return $this->getField('id');
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public function getCampaignsCollectionLink()
    {
        return $this->getField('campaigns_collection_link');
    }

    public function getCustomFieldsCollectionLink()
    {
        return $this->getField('custom_fields_collection_link');
    }

    public function getDraftBroadcastsLink()
    {
        return $this->getField('draft_broadcasts_link');
    }

    public function getScheduledBroadcastsLink()
    {
        return $this->getField('scheduled_broadcasts_link');
    }

    public function getSentBroadcastsLink()
    {
        return $this->getField('sent_broadcasts_link');
    }

    public function getUUID()
    {
        return $this->getField('uuid');
    }

    public function getLandingPagesCollectionLink()
    {
        return $this->getField('landing_pages_collection_link');
    }

    public function getListName()
    {
        return $this->getField('name');
    }

    public function getResourceTypeLink()
    {
        return $this->getField('resource_type_link');
    }

    public function getSelfLink()
    {
        return $this->getField('self_link');
    }

    public function getSegmentsCollectionLink()
    {
        return $this->getField('segments_collection_link');
    }

    public function getSubscribersCollectionLink()
    {
        return $this->getField('subscribers_collection_link');
    }

    public function getTotalSubscribedSubscribers()
    {
        return $this->getField('total_subscribed_subscribers');
    }

    public function getSubscribers()
    {
        return $this->getField('total_subscribers');
    }

    public function getTotalSubscribersSubscribedToday()
    {
        return $this->getField('total_subscribers_subscribed_today');
    }

    public function getTotalSubscribersSubscribedYesterday()
    {
        return $this->getField('total_subscribers_subscribed_yesterday');
    }

    public function getTotalUnconfirmedSubscribers()
    {
        return $this->getField('total_unconfirmed_subscribers');
    }

    public function getTotalUnsubscribedSubscribers()
    {
        return $this->getField('total_unsubscribed_subscribers');
    }

    public function getUniqueListId()
    {
        return $this->getField('unique_list_id');
    }

    public function getWebFormsSplitTestsCollectionLink()
    {
        return $this->getField('web_form_split_tests_collection_link');
    }

    public function getWebFormsCollectionLink()
    {
        return $this->getField('web_forms_collection_link');
    }


    /**
     * Returns a field from the data.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    private function getField($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

}