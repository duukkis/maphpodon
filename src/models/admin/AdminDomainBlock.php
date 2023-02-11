<?php

namespace Maphpodon\models\admin;

use Carbon\Carbon;
use Maphpodon\models\Model;

class AdminDomainBlock extends Model
{
    public string $id;
    public string $domain;
    public Carbon $created_at;
    public string $severity;
    public ?bool $reject_media;
    public ?bool $reject_reports;
    public ?bool $private_comment;
    public ?bool $public_comment;
    public ?bool $obfuscate;
}
