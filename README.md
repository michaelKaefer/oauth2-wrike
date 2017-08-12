# Wrike Provider for OAuth 2.0 Client

This package provides Wrike OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

```
composer require michaelkaefer/oauth2-wrike
```

## Usage

```php
$wrikeProvider = new \MichaelKaefer\OAuth2\Client\Provider\Wrike([
    'clientId'                => 'yourId',    // The client ID assigned to you by Wrike
    'clientSecret'            => 'yourSecret',   // The client password assigned to you by the provider
    'redirectUri'             => ''
]);

// Get authorization code
if (!isset($_GET['code'])) {
    // Get authorization URL
    $authorizationUrl = $wrikeProvider->getAuthorizationUrl();

    // Get state and store it to the session
    $_SESSION['oauth2state'] = $wrikeProvider->getState();

    // Redirect user to authorization URL
    header('Location: ' . $authorizationUrl);
    exit;
// Check for errors
} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {
    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }
    exit('Invalid state');
} else {
    try {
        // Get access token
        $accessToken = $wrikeProvider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // Get resource owner
        $resourceOwner = $wrike->getResourceOwner($accessToken);
        
        // Output results ...
        var_dump($resourceOwner);
        var_dump($accessToken);
        
        // ... or store them to session ...
        $_SESSION['accessToken'] = $accessToken;
        $_SESSION['resourceOwner'] = $resourceOwner;
        
        // ... or do some API request
        $folderId = 'yourFolderId';
        $request = $wrikeProvider->getAuthenticatedRequest(
            'GET',
            'https://www.wrike.com/api/v3/folders/' . $folderId . '/folders',
            $accessToken
        );
        $response = $wrikeProvider->getParsedResponse($request);
        var_dump($response['data']);
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit($e->getMessage());
    }
}
```

For more information see the PHP League's general usage examples.
