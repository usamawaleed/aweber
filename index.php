<?php
session_start();

use usamawaleed\AWeber\Aweber;
use usamawaleed\AWeber\Model\Account;

require_once ('vendor/autoload.php');
$baseURL = 'https://api.aweber.com/1.0/';

$url = 'https://api.aweber.com/1.0/accounts';
//echo strtotime(date('Y-m-d H:i:s'));
//exit;

$config = [
    'clientId'          => 'cbzcZ4dUPWWRWJ17fUOiH6hWSvD9zxYX',
    'clientSecret'      => 'F540YofNElyFeTbCKshcgb7jJUuxa7Cx',
    'redirectUri'       => 'https://aweberoauth.com',
];

$provider = new Aweber($config);
$accessToken = '';
//unset($_SESSION['access_token']);
echo '<pre>';
if(empty($_GET['code']) && !isset($_SESSION['access_token']))
{
    $oauthUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();

    echo '<a href="'.$oauthUrl.'">Connect Me</a>';
}elseif(!isset($_SESSION['access_token'])){
    $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
    print_r($accessToken);
    $_SESSION['access_token'] = $accessToken->getToken();
    $_SESSION['refresh_token'] = $accessToken->getRefreshToken();

}

print_r($accessToken);


$accessToken = $_SESSION['access_token'];
$refreshToken = $_SESSION['refresh_token'];


echo 'Access Token: ' . $accessToken . '<br>';
echo 'Refresh Token: ' . $refreshToken . '<br>';

//$newTokens = $provider->getNewAccessToken($config, $refreshToken);
//$_SESSION['access_token'] = $newTokens['access_token'];
//$_SESSION['refresh_token'] = $newTokens['refresh_token'];
//print_r($newTokens);
//exit;
//echo 'TOken: ' . $accessToken->getToken().'<br>';
//echo 'RTOken: ' . $accessToken->getRefreshToken().'<br>';
//echo 'Expiry: ' . $accessToken->getExpires().'<br>';


/**
 * @var $owner User
 */
$owner = $provider->getResourceOwner($accessToken);
//echo $owner->getDetail()->getId().'<br>';

$collection = $provider->getAccounts($accessToken, 'accounts');
pr($collection);
/**
 * @var $item Account
 */
foreach ($collection as $item)
{
    $id = $item->getId();
}

//print_r($collection);
echo '<br>';
$list = $provider->getList($accessToken, 'accounts/'.$id.'/lists');
print_r($list);
exit;
