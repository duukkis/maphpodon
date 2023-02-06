<?php

namespace Maphpodon\helpers;

use Carbon\Carbon;
use Maphpodon\instances\Account;

class Mapper
{
    public static function map(\stdClass $json, mixed $obj): mixed
    {
        foreach($json as $key => $val) {
            if (property_exists($obj, $key)) {
                $obj = static::mapItem($obj, $key, $val);
            }
        }
        return $obj;
    }

    private static function mapItem(mixed $obj, $key, $val): mixed
    {
        $rp = new \ReflectionProperty($obj, $key);
        $type = $rp->getType()->getName();
        switch ($type) {
            case "int":
                $obj->$key = (int) $val;
                break;
            case "string":
                $obj->$key = $val;
                break;
            case "bool":
                $obj->$key = (bool) $val;
                break;
            case "Carbon\Carbon":
                $obj->$key = Carbon::parse($val);
                break;
            case "array":
/*                foreach ($val as $i => $item) {
                    mapItem($obj, $key, $val);
                    $obj->$key = Carbon::parse($val);
                }*/
                break;
            case "Maphpodon\instances\Account":
                $obj->$key = Account::build($val);
                break;
            default:
                die($type);
        }
        return $obj;
    }
}