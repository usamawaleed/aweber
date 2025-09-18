<?php

namespace usamawaleed\AWeber\Model;

class Subscriber
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * Subscriber constructor.
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
        return $this->data;
    }

    public function getAdTracking()
    {
        return $this->getField('ad_tracking');
    }

    public function getAreaCode()
    {
        return $this->getField('area_code');
    }

    public function getCity()
    {
        return $this->getField('city');
    }

    public function getCountry()
    {
        return $this->getField('country');
    }

    public function getCustomFields()
    {
        return $this->getField('custom_fields');
    }

    public function getDmaCode()
    {
        return $this->getField('dma_code');
    }

    public function getEmail()
    {
        return $this->getField('email');
    }

    public function getIpAddress()
    {
        return $this->getField('ip_address');
    }

    public function isVerified()
    {
        return $this->getField('is_verified');
    }

    public function getLastFollowupMessageNumberSent()
    {
        return $this->getField('last_followup_message_number_sent');
    }

    public function getLastFollowupSentAt()
    {
        return $this->getField('last_followup_sent_at');
    }

    public function getLastFollowupSentLink()
    {
        return $this->getField('last_followup_sent_link');
    }

    public function getLatitude()
    {
        return $this->getField('latitude');
    }

    public function getLongitude()
    {
        return $this->getField('longitude');
    }

    public function getMiscNotes()
    {
        return $this->getField('misc_notes');
    }

    public function getName()
    {
        return $this->getField('name');
    }

    public function getPostalCode()
    {
        return $this->getField('postal_code');
    }

    public function getRegion()
    {
        return $this->getField('region');
    }

    public function getResourceTypeLink()
    {
        return $this->getField('resource_type_link');
    }

    public function getSelfLink()
    {
        return $this->getField('self_link');
    }

    public function getStatus()
    {
        return $this->getField('status');
    }

    public function getSubscribedAt()
    {
        return $this->getField('subscribed_at');
    }

    public function getSubscriptionMethod()
    {
        return $this->getField('subscription_method');
    }

    public function getSubscriptionUrl()
    {
        return $this->getField('subscription_url');
    }

    public function getTags()
    {
        return $this->getField('tags');
    }

    public function getUnsubscribeMethod()
    {
        return $this->getField('unsubscribe_method');
    }

    public function getUnsubscribedAt()
    {
        return $this->getField('unsubscribed_at');
    }

    public function getVerifiedAt()
    {
        return $this->getField('verified_at');
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
