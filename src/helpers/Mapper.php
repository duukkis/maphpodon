<?php

namespace Maphpodon\helpers;

use Carbon\Carbon;
use InvalidArgumentException;
use Maphpodon\models\Account;
use Maphpodon\models\Application;
use Maphpodon\models\Field;
use Maphpodon\models\MediaAttachment;
use Maphpodon\models\Mention;
use Maphpodon\models\Model;
use Maphpodon\models\Status;
use Maphpodon\models\Tag;

class Mapper
{
    public static function mapJsonObjectToClass(mixed $item, Model $model): Model
    {
        return $model::build($item, $model);
    }

    public static function mapJsonObjectToClassArray(array $items, Model $model): array
    {
        $result = [];
        foreach ($items as $i => $item) {
            $entity = $model::build($item, $model);
            array_push($result, $entity);
        }
        return $result;
    }

    public static function map(\stdClass $json, Model $obj): Model
    {
        foreach($json as $key => $val) {
            if (property_exists($obj, $key)) {
                $obj = static::mapItem($obj, $key, $val);
            }
        }
        return $obj;
    }

    private static function mapItem(Model $obj, $key, $val): Model
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
                if (isset($obj->mapArrayToObjects[$key])) {
                    foreach ($val as $j => $sub) {
                        /** @var Model $subitem */
                        $subitem = new $obj->mapArrayToObjects[$key]();
                        foreach ($sub as $subkey => $subval) {
                            $subitem = self::mapItem($subitem, $subkey, $subval);
                        }
                        array_push($obj->$key, $subitem);
                    }
                }
                break;
            case "Maphpodon\models\Account":
                $obj->$key = Account::build($val, new Account());
                break;
            case "Maphpodon\models\Application":
                $obj->$key = Application::build($val, new Application());
                break;
            case "Maphpodon\models\Field":
                $obj->$key = Field::build($val, new Field());
                break;
            case "Maphpodon\models\MediaAttachment":
                $obj->$key = MediaAttachment::build($val, new MediaAttachment());
                break;
            case "Maphpodon\models\Mention":
                $obj->$key = Mention::build($val, new Mention());
                break;
            case "Maphpodon\models\Status":
                $obj->$key = Status::build($val, new Status());
                break;
            case "Maphpodon\models\Tag":
                $obj->$key = Tag::build($val, new Tag());
                break;
            default:
                throw new InvalidArgumentException($type . " is not mapped");
        }
        return $obj;
    }

    public static function cleanParams(array $params, array $keep): array
    {
        return array_filter($params,
            function($v) use ($keep) {
                return in_array($v, $keep);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

}