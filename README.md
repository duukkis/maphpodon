# Maphpodon

PHP client-api for Mastodon. https://docs.joinmastodon.org/ has the api-methods documented.
All the entities functions have a link to corresponding documentation.

## Install
```
composer require duukkis/maphpodon
```

## Usage

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
/** @var \Maphpodon\models\Status $status */
foreach ($result as $i => $status) {
    print "User " . $status->account->username . 
    " posted at " . $status->created_at->format("Y-m-d. H:i") . 
    " this " .$status->content . PHP_EOL;
}
$result = $masto->timelines()->home(["limit" => 2]);
$result = $masto->timelines()->tag("fish");

####### Statuses
$result = $masto->statuses()->post(["status" => "testi"]);
$result = $masto->statuses()->get($result->id);
$result = $masto->statuses()->get("109825403503402367");
$result = $masto->statuses()->delete("109823185566762882");
$result = $masto->statuses()->reblogged_by("109825461095585733");
$result = $masto->statuses()->favourited_by("109825461095585733");

####### Poll
$result = $masto->statuses()->post(
    [
        "status" => "What is the best way to make a poll?",
        "poll" => [
            "options" => [
                "This way",
                "Some other way"
            ],
            "expires_in" => 60 * 60,
            "multiple" => false,
        ]
    ]
);
$result = $masto->polls()->get("5");
$result = $masto->polls()->vote("5", ["choices" => [0, 1]]);

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
$result = $masto->accounts()->note("109817168119540210", ["comment" => "api test"]);
$result = $masto->accounts()->note("109817168119540210"); // remove comment
$result = $masto->accounts()->search(["q" => "p??iv??n"]);
$result = $masto->accounts()->lookup(["acct" => "duukkis"]);
// these gave me 500, so something there or then it's just my instance
$result = $masto->accounts()->relationships(["id" => ["109817168119540210", "109813823501112312"]]);
$result = $masto->accounts()->familiar_followers(["id" => ["109817168119540210", "109813823501112312"]]);

####### Oauth token fetching

// just put in a ID and secret
$masto = new Maphpodon(
    "mastobotti.eu",
    "CLIENT_ID",
    "CLIENT_SECRET",
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

####### Admin
$result = $masto->admin()->accounts()->viewV1(["limit" => 2]);
$result = $masto->admin()->accounts()->viewV2(["status" => "active", "limit" => 2]);
$result = $masto->admin()->accounts()->view("109807491887075545");
$result = $masto->admin()->accounts()->approve("109807491887075545");
$masto->admin()->accounts()->action("109807491887075545", ["type" => "none"]);
// reject, delete, enable, unsilence, unsuspend, unsensitive

$result = $masto->admin()->domain_allows()->list([]);
$result = $masto->admin()->domain_blocks()->list([]);
$result = $masto->admin()->ip_blocks()->list();
$result = $masto->admin()->ip_blocks()->view("1");
$result = $masto->admin()->ip_blocks()->create(["..."]);
$result = $masto->admin()->ip_blocks()->update("1", ["..."]);
$masto->admin()->ip_blocks()->delete("1");

$result = $masto->admin()->reports()->list([]);
$result = $masto->admin()->reports()->view("2");
$result = $masto->admin()->reports()->assign_to_self("2");
$result = $masto->admin()->reports()->unassign("2");
$result = $masto->admin()->reports()->resolve("2");
$result = $masto->admin()->reports()->reopen("2");

$result = $masto->admin()->trends()->statuses([]);
$result = $masto->admin()->trends()->links([]);
$result = $masto->admin()->trends()->tags([]);

$result = $masto->admin()->canonical_email_blocks()->list();
$result = $masto->admin()->dimensions()->list(["keys" => ["languages", "sources", "servers", "space_usage", "software_versions"]]);
$result = $masto->admin()->measures()->list(
    [
        "keys" => ["active_users", "new_users"],
        "start_at" => \Carbon\Carbon::now()->subMonth()->format("Y-m-d"),
        "end_at" => \Carbon\Carbon::now()->format("Y-m-d"),
    ]
);

```

# Structure of code

## Instances

Methods return either Model, array or just void.

```
class Accounts
{
    // takes in the Maphpodon wrapper with GuzzleClient
    public function __construct(protected Maphpodon $maphpodon)
    {
    }
    
     /**
     * @link https://docs.joinmastodon.org/methods/accounts/#get
     * @param string $id
     * @return Account
     */
    public function get(string $id): Model|Account
    {
        return Mapper::mapJsonObjectToClass(
            $this->maphpodon->get(sprintf('v1/accounts/%s', $id), []),
            new Account()
        );
    }
    
    /**
     * @link https://docs.joinmastodon.org/methods/accounts/#statuses
     * @param string $id
     * @param array $params
     * @return Status[]
     */
    public function statuses(string $id, array $params = []): array
    {
        return Mapper::mapJsonObjectToClassArray(
            $this->maphpodon->get(sprintf('v1/accounts/%s/statuses', $id), ["query" => $params]),
            new Status()
        );
    }
```

## Models

The returning objects are mapped into models.
```
class Status extends Model
{
    // not nullable
    public string $id;
    // Carbon::parse
    public Carbon $created_at;
    // can be null
    public ?string $in_reply_to_id;
    public bool $sensitive;
    // this is mapped to Application model
    public Application $application;
    // check if we have mapper in $mapArrayToObjects and map array to those
    public array $media_attachments = [];
    // we have no mapper for this, just put json-objects to array
    public array $emojis = [];
    
    public array $mapArrayToObjects = [
        "media_attachments" => MediaAttachment::class,
```
## Exceptions

Created Interface ExceptionCatcher that can be overwritten with any Catcher that handles the GuzzleException. Default will just rethrow the Exception.
For an example created DevelopmentExceptionCatcher into helpers dir.

## Testing

There is a basic phpunit setup.

## Lorem Ipsum

Naming is done according the path. /api/v1/accounts is in entities/Accounts and /api/v1/accounts/follow is a follow function.

Have Fun!