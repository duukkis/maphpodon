<?php

namespace Maphpodon\models\admin;

use Maphpodon\models\Model;

class AdminCanonicalEmailBlock extends Model
{
    public string $id;
    public string $canonical_email_hash;
}
