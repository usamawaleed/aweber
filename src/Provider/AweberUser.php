<?php


namespace usamawaleed\AWeber\Provider;


use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class AweberUser implements ResourceOwnerInterface
{
    /**
     * @var array $data
     */
    protected $data;

    /**
     * AweberUser constructor.
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->data = $response;
    }

    public function getId()
    {
        return 'iamId';
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public function getStart()
    {
        return $this->getField('start');
    }

    public function getTotalSize()
    {
        return $this->getField('total_size');
    }

    public function getDetail()
    {
        return new AweberUserCollection($this->getField('entries')[0]);
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