# Maphpodon

Things are coming
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
// $result = $masto->timelines()->public(["limit" => 10]);
// $result = $masto->timelines()->home(["limit" => 2]);
// $result = $masto->timelines()->tag("fish");

####### Statuses
// $result = $masto->statuses()->post(["status" => "testi"]);
// $result = $masto->statuses()->get($result->id);
// $result = $masto->statuses()->get("109825403503402367");
// $result = $masto->statuses()->delete("109823185566762882");
// $result = $masto->statuses()->reblogged_by("109825461095585733");
// $result = $masto->statuses()->favourited_by("109825461095585733");

####### Remote status favourite
// find a remote post, use resolve true! so it gets federated to local instance
// $result = $masto->search()->get(["q" => "https://mas.to/@duukkis/109818862518591984", "resolve" => true]);
/** @var \Maphpodon\instances\Status $status */
// $status = $result["statuses"][0];
// $result = $masto->statuses()->favourite($status->id);

####### Media handling
// $result = $masto->media()->post("./IMG_6298.jpg", null, ["description" => "testikuva"]);
// $result = $masto->media()->get("109825314440397270");
####### post with media
// $result = $masto->statuses()->post(["status" => "dippa", "media_ids" => ["109825314440397270"]]);
```
