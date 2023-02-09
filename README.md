# Maphpodon


Methods

```
include('../vendor/autoload.php');

use Maphpodon\Maphpodon;

$masto = new Maphpodon(
    "mastobotti.eu",
    "CLIENT_ID",
    "CLIENT_SECRET",
    "ALL_YOU_NEED_IS_AUTH_TOKEN",
);

####### Timelines
$result = $masto->timelines()->public(["limit" => 10]);
$result = $masto->timelines()->home(["limit" => 2]);
$result = $masto->timelines()->tag("fish");

####### Statuses
$result = $masto->statuses()->post(["status" => "testi"]);
$result = $masto->statuses()->get($result->id);
$result = $masto->statuses()->get("109825403503402367");
$result = $masto->statuses()->delete("109823185566762882");
$result = $masto->statuses()->reblogged_by("109825461095585733");
$result = $masto->statuses()->favourited_by("109825461095585733");

####### Remote status favourite
// find a remote post, use resolve true! so it gets federated to local instance
$result = $masto->search()->get(["q" => "https://mas.to/@duukkis/109818862518591984", "resolve" => true]);
/** @var \Maphpodon\models\Status $status */
$status = $result->statuses[0];
$result = $masto->statuses()->favourite($status->id);

####### Media handling
$result = $masto->media()->post("./IMG_6298.jpg", "description of somesort", null]);
$result = $masto->media()->get("109825314440397270");
####### post with media
$result = $masto->statuses()->post(["status" => "dippa", "media_ids" => ["109825314440397270"]]);

####### Notifications
$result = $masto->notifications()->index();
$result = $masto->notifications()->get("1");
$masto->notifications()->dismiss("1");
$masto->notifications()->clear();

####### Instance
$result = $masto->instance()->index();

####### Accounts
$result = $masto->accounts()->get("109807809719057795");
$result = $masto->accounts()->statuses("109807809719057795", ["min_id" => "109816527054798413", "limit" => 4]);
$result = $masto->accounts()->followers("109807809719057795", ["limit" => 2]);
$result = $masto->accounts()->featured_tags("109807491887075545", []);
$result = $masto->accounts()->lists("109817168119540210", []);
$result = $masto->accounts()->follow("109817168119540210");
$result = $masto->accounts()->unfollow("109817168119540210");
$result = $masto->accounts()->pin/unpin/block/unblock/...("109817168119540210");

####### Oauth token fetching

// the maphpdon has /api in base_uri so we need to substitute the client with better base_uri
$masto = new Maphpodon(
    "mastobotti.eu",
    "CLIENT_ID",
    "CLIENT_SECRET",
    null,
    null,
    new \GuzzleHttp\Client([
        'base_uri' => 'https://mastobotti.eu/',
        'timeout' => 10,
    ])
);

// this will return an url where to redirect customer
$result = $masto->auth()->authorize(
    "read",
    "urn:ietf:wg:oauth:2.0:oob",
    "false",
    "en"
);
print $result . PHP_EOL;
// or header("Location: " . $result); exit();

# After user has clicked ok or returned to actual return url given above, you get authorization code in &code param
# THIS IS DIFFERENT FROM AUTH_TOKEN so we need to fetch the token with below method

$result = $masto->auth()->token(
    [
        "grant_type" => "authorization_code",
        "code" => "AUTHORIZATION_CODE_FROM_ABOVE",
        "client_id" => $masto->clientKey,
        "client_secret" => $masto->clientSecret,
        "redirect_uri" => "urn:ietf:wg:oauth:2.0:oob",
        "scope" => "read",
    ]
);
/*
print_r($result);

Maphpodon\models\Token Object
(
    [access_token] => HERE-IS-A-TOKEN-YOU-CAN-USE
    [token_type] => Bearer
    [scope] => read
    [created_at] => 1675972651
)
*/
$result = $masto->auth()->revoke(
    [
        "client_id" => $masto->clientKey,
        "client_secret" => $masto->clientSecret,
        "token" => "HERE-IS-A-TOKEN-YOU-CAN-USE",
    ]
);

####### Apps
$result = $masto->apps()->post(
    [
        "client_name" => "Duukkis new Api client",
        "redirect_uris" => "urn:ietf:wg:oauth:2.0:oob",
        "scopes" => "read follow write:lists",
        "website" => "https://github.com/duukkis/maphpodon",
    ]
);
$result = $masto->apps()->verify_credentials();

```
