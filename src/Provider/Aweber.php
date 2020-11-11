<?php


namespace League\OAuth2\Client\Provider;


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

    public function getBaseAuthorizationUrl()
    {
        return 'https://auth.aweber.com/oauth2/';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://auth.aweber.com/oauth2/token';
    }

    public function getDefaultScopes()
    {
        return [
            'account.read',
            'list.read',
            'list.write',
            'subscriber.read',
            'subscriber.write',
            'email.read',
            'email.write',
            'subscriber.read-extended',
            'landing-page.read'
        ];
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'No detail';
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


}