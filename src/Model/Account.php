<?php


namespace usamawaleed\AWeber\Model;


use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class Account implements ResourceOwnerInterface
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * User constructor.
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

    public function getSelfLink()
    {
        return $this->getField('self_link');
    }

    public function getAnalyticsSrc()
    {
        return $this->getField('analytics_src');
    }

    public function getResourceTypeLink()
    {
        return $this->getField('resource_type_link');
    }

    public function getListCollectionLink()
    {
        return $this->getField('lists_collection_link');
    }

    public function getIntegrationsCollectionLink()
    {
        return $this->getField('integrations_collection_link');
    }

    public function getHttpEtag()
    {
        return $this->getField('http_etag');
    }

    public function getUuid()
    {
        return $this->getField('uuid');
    }

    public function getCompany()
    {
        return $this->getField('company');
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