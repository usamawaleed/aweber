<?php
session_start();

use usamawaleed\AWeber\Aweber;
use usamawaleed\AWeber\Model\Account;

require_once ('vendor/autoload.php');

$config = [
    'clientId'          => 'cbzcZ4dUPWWRWJ17fUOiH6hWSvD9zxYX',
    'clientSecret'      => 'F540YofNElyFeTbCKshcgb7jJUuxa7Cx',
    'redirectUri'       => 'https://aweberoauth.com',
];

$provider = new Aweber($config);

echo '<pre>';

// If we don't have an authorization code then get one
if (!isset($_GET['code'])) {
    // Fetch the authorization URL from the provider; this returns the urlAuthorize option and generates and stores a state
    $authorizationUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    echo '<a href="' . $authorizationUrl . '">Connect Me</a>';
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }
    exit('Invalid state');
} else {
    try {
        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // We have an access token, which we may use in authenticated
        // requests against the service provider's API.
        echo 'Access Token: ' . $accessToken->getToken() . "<br>";
        echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
        echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
        echo 'Already expired? ' . ($accessToken->hasExpired() ? 'Yes' : 'No') . "<br>";

        // Using the access token, we may look up details about the
        // resource owner.
        /** @var Account $resourceOwner */
        $resourceOwner = $provider->getResourceOwner($accessToken);

        printf('Hello %s!', $resourceOwner->getCompany());
        echo "\n\n";

        // Get accounts
        $accounts = $provider->getAccounts($accessToken, 'accounts');
        echo "Accounts:\n";
        print_r($accounts->toArray());

        // Get lists
        $firstAccount = $accounts->getIterator()->current();
        $lists = $provider->getList($accessToken, 'accounts/' . $firstAccount->getId() . '/lists');
        echo "Lists:\n";
        print_r($lists->toArray());

        // Get subscribers
        $firstList = $lists->getIterator()->current();
        $subscribers = $provider->getSubscribers($accessToken, 'accounts/' . $firstAccount->getId() . '/lists/' . $firstList->getId() . '/subscribers');
        echo "Subscribers:\n";
        print_r($subscribers->toArray());

        /*
        // Add a subscriber
        $newSubscriberData = [
            'email' => 'test.subscriber@example.com',
            'name' => 'Test Subscriber'
        ];
        $newSubscriber = $provider->addSubscriber($accessToken, 'accounts/' . $firstAccount->getId() . '/lists/' . $firstList->getId() . '/subscribers', $newSubscriberData);
        echo "New Subscriber:\n";
        print_r($newSubscriber);
        */

        /*
        // Update a subscriber
        $subscriberToUpdate = $subscribers->getIterator()->current();
        $updatedData = [
            'name' => 'Updated Test Subscriber'
        ];
        $updatedSubscriber = $provider->updateSubscriber($accessToken, 'accounts/' . $firstAccount->getId() . '/lists/' . $firstList->getId() . '/subscribers/' . $subscriberToUpdate->getId(), $updatedData);
        echo "Updated Subscriber:\n";
        print_r($updatedSubscriber);
        */

        /*
        // Delete a subscriber
        $subscriberToDelete = $subscribers->getIterator()->current();
        $result = $provider->deleteSubscriber($accessToken, 'accounts/' . $firstAccount->getId() . '/lists/' . $firstList->getId() . '/subscribers/' . $subscriberToDelete->getId());
        echo "Deleted Subscriber:\n";
        print_r($result);
        */


    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // Failed to get the access token or user details.
        exit($e->getMessage());
    }
}
