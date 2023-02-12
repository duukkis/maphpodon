<?php

include('./vendor/autoload.php');

use Maphpodon\Maphpodon;

$masto = new Maphpodon(
    "mastobotti.eu",
    "KEY",
    "SECRET",
);

if (isset($_GET["code"])) {
    $result = $masto->auth()->token(
        [
            "grant_type" => "authorization_code",
            "code" => $_GET["code"],
            "client_id" => $masto->clientKey,
            "client_secret" => $masto->clientSecret,
            "redirect_uri" => "http://10.0.0.12/mastoauth/",
            "scope" => "read write follow",
        ]
    );
    $masto->authToken = $result->access_token;
    // lets do this so we get username who was authorized
    $status = $masto->statuses()->post(["status" => "Bot authorized"]);
    $token = "/path_to_tokens/" . $status->account->username . ".token";
    if (!file_exists($result->access_token)) {
        file_put_contents($token, $result->access_token);
    }
    sleep(1);
    // then lets delete the one
    $masto->statuses()->delete($status->id);
    // and display the token
    echo file_get_contents($token) . PHP_EOL;
} else {
    $result = $masto->auth()->authorize(
        "read write follow",
        "http://10.0.0.12/mastoauth/",
        "false",
    );
    header("Location: " . $result);
    exit();
}