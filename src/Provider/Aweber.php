<?php


namespace usamawaleed\AWeber\Provider;


use GuzzleHttp\Client;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Aweber extends AbstractProvider
{
    use BearerAuthorizationTrait;


    public function __construct(array $options = [], array $collaborators = [])
    {
        parent::__construct($options, $collaborators);
    }

    public function getBaseUrl()
    {
        return 'https://api.aweber.com/1.0/';
    }

    public function getBaseAuthorizationUrl()
    {
        return 'https://auth.aweber.com/oauth2/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://auth.aweber.com/oauth2/token';
    }

    public function getDefaultScopes()
    {
        return [
            'account.read',
            'landing-page.read',
            'list.read',
            'list.write',
            'subscriber.read',
            'subscriber.write',
            'subscriber.read-extended',
            'email.read',
            'email.write',
        ];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.aweber.com/1.0/accounts';
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new AweberUser($response);
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            $message = $data['error']['type'].': '.$data['error']['message'];
            throw new IdentityProviderException($message, $data['error']['code'], $data);
        }
    }

    /**
     * @param $accessToken
     * @param $url
     * @return AweberUserCollection
     */
    function getCollection($accessToken, $url)
    {
        $collection = $this->sendRequest($url, $accessToken);
        return new AweberUserCollection($collection[0]);
    }

    function getList($accessToken, $url)
    {
        $list = $this->sendRequest($url, $accessToken);
        return $list;
//        return new AweberUserCollection($collection[0]);
    }

    private function verifyUrl($url)
    {
        if(strpos($url, $this->getBaseUrl())!==0)
        {
            $url = $this->getBaseUrl() . $url;
        }

        return $url;
    }

    private function sendRequest($url, $accessToken)
    {
        $client = new Client();

        $url = $this->verifyUrl($url);

        $data = array();

        while (isset($url)) {
            $request = $client->get($url,
                ['headers' => ['Authorization' => 'Bearer ' . $accessToken]]
            );
            $body = $request->getBody();
            $page = json_decode($body, true);
            $data = array_merge($page['entries'], $data);
            $url = isset($page['next_collection_link']) ? $page['next_collection_link'] : null;
        }

        return $data;
    }


}