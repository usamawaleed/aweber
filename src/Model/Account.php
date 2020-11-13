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
        return $this->getEntries('id');
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public function getSelfLink()
    {
        return $this->getEntries('self_link');
    }

    public function getAnalyticsSrc()
    {
        return $this->getEntries('analytics_src');
    }

    public function getResourceTypeLink()
    {
        return $this->getEntries('resource_type_link');
    }

    public function getListCollectionLink()
    {
        return $this->getEntries('lists_collection_link');
    }

    public function getIntegrationsCollectionLink()
    {
        return $this->getEntries('integrations_collection_link');
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

    /**
     * Returns a field from the data.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    private function getEntries($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }


}