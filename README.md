## ![](http://i.imgur.com/cacgQlq.png)  Pinterest API V5+ - PHP

[![](https://travis-ci.org/dirkgroenen/Pinterest-API-PHP.svg)](https://travis-ci.org/dirkgroenen/Pinterest-API-PHP)
[![](https://img.shields.io/scrutinizer/g/dirkgroenen/Pinterest-API-PHP.svg)](https://scrutinizer-ci.com/g/dirkgroenen/Pinterest-API-PHP/?branch=master)
[![](https://img.shields.io/scrutinizer/coverage/g/dirkgroenen/Pinterest-API-PHP.svg)](https://scrutinizer-ci.com/g/dirkgroenen/Pinterest-API-PHP/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dirkgroenen/Pinterest-API-PHP/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dirkgroenen/Pinterest-API-PHP/?branch=master)
[![Packagist](https://img.shields.io/packagist/v/dirkgroenen/pinterest-api-php.svg)](https://packagist.org/packages/dirkgroenen/pinterest-api-php)
-------------------

A PHP wrapper for the official [Pinterest API V5+](https://developers.pinterest.com/docs/api/v5/).

# Requirements
- PHP 5.4 or higher (actively tested on PHP >=7.1)
- cURL
- Registered Pinterest App

# Get started
To use the Pinterest API V5+ you have to register yourself as a developer and [create](https://developers.pinterest.com/apps/) an application. After you've created your app you will receive a `app_id` and `app_secret`.

> The terms `client_id` and `client_secret` are in this case `app_id` and `app_secret`.

## Installation
The Pinterest API V5+ wrapper is available on Github only so you need two steps to install it.

The Pinterest API V5+ client is available on Composer
```
composer require siapepfrance/pinterest-api-php
```

If you're not using Composer (which you should start using, unless you've got a good reason not to) you can include the `autoload.php` file in your project.

## Simple Example
```php
use SiapepFrance\Pinterest\Pinterest;

$pinterest = new Pinterest(CLIENT_ID, CLIENT_SECRET);
```

After you have initialized the class you can get a login URL:

```php
$loginurl = $pinterest->auth->getLoginUrl(REDIRECT_URI, array('read_public'));
echo '<a href=' . $loginurl . '>Authorize Pinterest</a>';
```

Check the [Pinterest documentation](https://developers.pinterest.com/docs/api/v5/#tag/Scopes) for the available scopes.

After your user has used the login link to authorize he will be send back to the given `REDIRECT_URI`. The URL will contain the `code` which can be exchanged into an `access_token`. To exchange the code for an `access_token` and set it you can use the following code:

```php
if(isset($_GET["code"])){
    $token = $pinterest->auth->setRedirectUri(REDIRECT_URI)->getOAuthToken($_GET["code"]);
    $pinterest->auth->setOAuthToken($token->access_token);
}
```

## Get the user's account

To get the profile of the current logged in user you can use the `UserAccounts::get(<array>);` method.

```php
$userAccount = $pinterest->user_accounts->get();
echo $userAccount;
```

# Models
The API wrapper will parse all data through it's corresponding model. This results in the possibility to (for example) directly `echo` your model into a JSON string.

Models also show the available fields (which are also described in the Pinterest documentation). By default, not all fields are returned, so this can help you when providing extra fields to the request.

## Available models

### [User Accounts](https://developers.pinterest.com/docs/api/v5/#tag/user_account)

### [Boards](https://developers.pinterest.com/docs/api/v5/#tag/boards)

### [Pins](https://developers.pinterest.com/docs/api/v5/#tag/pins)

### [Ad Accounts](https://developers.pinterest.com/docs/api/v5/#tag/ad_accounts)


## Retrieving extra fields
If you want more fields you can specify these in the `$data` (GET requests) or `$fields` (PATCH requests) array. Example:

```php
$pinterest->user_accounts->get();
```

Response:

```json
{
    "account_type": "PINNER",
    "profile_image": "https://www.siapep.fr/profile",
    "website_url": "https://www.siapep.fr",
    "username": "siapepfrance"
}
```

By default, not all fields are returned. The returned data from the API has been parsed into the `UserAccount` model. Every field in this model can be filled by parsing an extra `$data` array with the key `fields`. Say we want the user's username, account_type, website_url:

```php
$pinterest->user_accounts->get(array(
    'fields' => 'username,account_type,website_url'
));
```

The response will now be:

```json
{
    "account_type": "PINNER",
    "website_url": "https://www.siapep.fr",
    "username": "siapepfrance"
}
```

# Collection

When the API returns multiple models (for instance when your requesting the pins from a board) the wrapper will put those into a `Collection`.

The output of a collection contains the `data` and page `key`. If you echo the collection you will see a json encoded output containing both of these. Using the collection as an array will only return the items from `data`.

Available methods for the collection class:

## Get all items
`all()`

```php
$pins = $pinterest->boards->listBoards();
$pins->all();
```

Returns: `array<Model>`

## Get item at index
`get( int $index )`

```php
$pins = $pinterest->boards->listBoards();
$pins->get(0);
```

Returns: `Model`

## Check if collection has next page

`hasNextPage()`

```php
$pins = $pinterest->boards->listBoards();
$pins->hasNextPage();
```

## Get the next page if collection has next page

`getNextPage()`

```php
$pins = $pinterest->boards->getNextPage();
$pins->getNextPage();
```

Returns: `Boolean`

## Get pagination data
Returns an array with an `URL` and `cursor` for the next page, or `false` when no next page is available.

`pagination`

```php
$pins = $pinterest->boards->listBoards();
$pins->pagination['cursor'];
```

Returns: `Array`

# Available methods

> Every method containing a `data` array can be filled with extra data. This can be for example extra fields or pagination.

## Authentication

The methods below are available through `$pinterest->auth`.

### Get login URL
`getLoginUrl(string $redirect_uri, array $scopes, string $response_type = "code");`

```php
$pinterest->auth->getLoginUrl("https://pinterest.dev/callback.php", array("boards:read,boards:write,boards:write_secret,pins:read,pins:write,pins:write_secret"));
```

Check the [Pinterest documentation](https://developers.pinterest.com/docs/api/v5/#tag/Scopes) for the available scopes.

**Note: since 0.2.0 the default authentication method has changed to `code` instead of `token`. This means you have to exchange the returned code for an access_token.**

### Set redirect_uri (this method is useful when using the authorization_code flow to authenticate )
`setRedirectUri( string $redirect_uri );`

```php
$pinterest->auth->setRedirectUri($redirect_uri);
```

### Get access_token
`getOAuthToken( string $code );`

```php
$pinterest->auth->getOAuthToken($code);
```

### Set access_token
`setOAuthToken( string $access_token );`

```php
$pinterest->auth->setOAuthToken($access_token);
```

### Refresh the expired access_token thanks to the refresh token
`refreshOAuthToken( string $refresh_token );`

```php
$pinterest->auth->refreshOAuthToken($access_token);
```

### Get state
`getState();`

```php
$pinterest->auth->getState();
```

Returns: `string`

### Set state
`setState( string $state );`

This method can be used to set a state manually, but this isn't required since the API will automatically generate a random state on initialize.

```php
$pinterest->auth->setState($state);
```

## Rate limit
> Note that you should call an endpoint first, otherwise `getRateLimit()` will return `unknown`.

### Get limit
`getRateLimit();`

This method can be used to get the maximum number of requests.

```php
$pinterest->getRateLimit();
```

Returns: `int`

### Get remaining
`getRateLimitRemaining();`

This method can be used to get the remaining number of calls.

```php
$pinterest->getRateLimitRemaining();
```

Returns: `int`

## User Accounts

The methods below are available through `$pinterest->user_accounts`.

> You also cannot access a user’s boards or Pins who has not authorized your app.

### Get logged in user account
`get( array $data );`

```php
$pinterest->user_accounts->get();
```

Returns: `UserAccount`

### Get logged in user account analytics
`getAnalytics( array $data );`

```php
$pinterest->user_accounts->getAnalytics($data);
```

Returns: `Collection<UserAccountAnalytic>`

## Boards

The methods below are available through `$pinterest->boards`.

### List boards
`listBoards( array $data );`

```php
$pinterest->boards->listBoards();
```

Returns: `Collection<Board>`

### Get board
`get( string $boardId, array $data );`

```php
$pinterest->boards->get();
```

Returns: `Board`

### Create board
`create( array $data );`

```php
$pinterest->boards->create(array(
    "name"          => "Test board from API",
    "description"   => "Test Board From API Test",
    "privacy"       => "PUBLIC"
));
```

Returns: `Board`

### Edit board
`edit( string $boardId, array $data, string $fields = null );`

```php
$pinterest->boards->edit("1234567890", array(
    "name"  => "Test board after edit"
));
```

Returns: `Board`

### Get board pins
`delete( string $boardId, array $data );`

```php
$pinterest->boards->pins("1234567890", []);
```

Returns: `Collection<Pin>`

### Delete board
`delete( string $boardId, array $data );`

```php
$pinterest->boards->delete("1234567890", []);
```

Returns: `True|PinterestException`

## Sections
The methods below are available through `$pinterest->sections`.

### Create section on board
`create( string $boardId, array $data );`

```php
$pinterest->sections->create("1234567890", array(
    "name" => "Test from API"
));
```

Returns: `Section`

### Update section on board
`create( string $boardId, string $sectionId, array $data );`

```php
$pinterest->sections->update("1234567890", "10111213", array(
    "name" => "Test from API"
));
```

Returns: `Section`

### Get sections on board
`get( string $boardId, array $data );`

```php
$pinterest->sections->get("1234567890");
```

Returns: `Collection<Section>`

### Get pins from section
> Note: Returned board ids can't directly be provided to `pins()`. The id needs to be extracted from \<BoardSection xxx\>

`get( string $boardId, string $sectionId, array $data );`

```php
$pinterest->sections->pins("1234567890", "10111213");
```

Returns: `Collection<Pin>`

### Delete section

`delete( string $boardId, string $sectionId );`

```php
$pinterest->sections->delete("1234567890", "10111213");
```

Returns: `boolean`

## Pins

The methods below are available through `$pinterest->pins`.

### Get pin
`get( string $pinId, array $data );`

```php
$pinterest->pins->get("10111213");
```

Returns: `Pin`

### Get pins from board
`fromBoard( string $boardId, array $data );`

```php
$pinterest->pins->fromBoard("1234567890");
```

Returns: `Collection<Pin>`

### Create pin
`create( array $data );`

Creating a pin with an image hosted somewhere else:

```php
$pinterest->pins->create(array(
    'link' => 'https://www.siapep.fr',
    'title' => 'Test board from API',
    'description' => $message,
    'alt_text' => "",
    'board_id' => '1234567890',
    'board_section_id' => null,
    'media_source' => [
        'source_type' => 'image_url',
        'url' => 'https://www.siapep.fr/api/public/file/23/getcontent'
    ]
));
```

Creating a pin with a base64 encoded image on the server:

```php

// Get the image and convert into string
$img = file_get_contents('/path/to/image.png');

// Encode the image string data into base64
$imgBase64 = base64_encode($img);

$pinterest->pins->create(array(
    'link' => 'https://www.siapep.fr',
    'title' => 'Test Pin from API',
    'description' => 'Test Pin description from API',
    'alt_text' => "",
    'board_id' => '1234567890',
    'board_section_id' => null,
    'media_source' => [
        'source_type' => 'image_base64',
        'content_type' => 'image/png',
        'data' => $imgBase64
    ]
));
```

Returns: `Pin`

### Edit pin

`edit( string $pinId, array $data, string $fields = null );`

```php
$pinterest->pins->edit("15161718", array(
    'description' => 'Test Pin description from API bis',
));
```

Returns: `Pin`

### Delete pin
`delete( string $pinId, array $data );`

```php
$pinterest->pins->delete("181692166190246650");
```

Returns: `True|PinterestException`


## Ad Accounts

The methods below are available through `$pinterest->ad_accounts`.

> You also cannot access a user’s boards or Pins who has not authorized your app.

### Get ad accounts
`get( array $data );`

```php
$pinterest->ad_accounts->get();
```

Returns: `AdAccount`

### Get ad accounts analytics
`getAnalytics( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getAnalytics($adAccountId, $data);
```

Returns: `Collection<AdAccountAnalytic>`

### Get ad accounts campaigns
`getCampaigns( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getCampaigns($adAccountId, $data);
```

Returns: `Collection<AdCampaign>`

### Get ad account campaign analytics
`getCampaignAnalytics( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getCampaignAnalytics($adAccountId, $data);
```

Returns: `Collection<AdCampaignAnalytic>`

### Get ad account groups
`getAdGroups( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getAdGroups($adAccountId, $data);
```

Returns: `Collection<AdGroup>`

### Get ad account group analytics
`getAdGroupAnalytics( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getAdGroupAnalytics($adAccountId, $data);
```

Returns: `Collection<AdGroupAnalytic>`

### Get ad account ads
`getAds( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getAds($adAccountId, $data);
```

Returns: `Collection<Ad>`

### Get ad account ad analytics
`getAdAnalytics( string $adAccountId, array $data );`

```php
$pinterest->ad_accounts->getAdAnalytics($adAccountId, $data);
```

Returns: `Collection<AdAnalytic>`

# Examples

Use can take a look at the `./demo` directory for a simple example.

Let me know if you have an (example) project using the this library.
