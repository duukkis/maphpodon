<?php

namespace Maphpodon\helpers;

use Carbon\Carbon;
use InvalidArgumentException;
use Maphpodon\models\Account;
use Maphpodon\models\admin\AdminAccount;
use Maphpodon\models\admin\AdminCanonicalEmailBlock;
use Maphpodon\models\admin\AdminCohort;
use Maphpodon\models\admin\AdminDomainAllow;
use Maphpodon\models\admin\AdminDomainBlock;
use Maphpodon\models\admin\AdminIpBlock;
use Maphpodon\models\admin\AdminKey;
use Maphpodon\models\admin\AdminMeasure;
use Maphpodon\models\admin\AdminReport;
use Maphpodon\models\admin\AdminRole;
use Maphpodon\models\Application;
use Maphpodon\models\Card;
use Maphpodon\models\Configuration;
use Maphpodon\models\Contact;
use Maphpodon\models\Context;
use Maphpodon\models\Emoji;
use Maphpodon\models\FeatureTag;
use Maphpodon\models\Field;
use Maphpodon\models\History;
use Maphpodon\models\Instance;
use Maphpodon\models\Link;
use Maphpodon\models\MediaAttachment;
use Maphpodon\models\Mention;
use Maphpodon\models\MList;
use Maphpodon\models\Model;
use Maphpodon\models\Notification;
use Maphpodon\models\Poll;
use Maphpodon\models\PollOption;
use Maphpodon\models\Relationship;
use Maphpodon\models\Rule;
use Maphpodon\models\SearchResult;
use Maphpodon\models\Status;
use Maphpodon\models\StatusEdit;
use Maphpodon\models\StatusSource;
use Maphpodon\models\Tag;
use Maphpodon\models\Thumbnail;
use Maphpodon\models\Token;
use Maphpodon\models\Translation;

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
            $entity = $model::build($item, clone $model);
            array_push($result, $entity);
        }
        return $result;
    }

    public static function map(\stdClass $json, Model $obj): Model
    {
        foreach ($json as $key => $val) {
            if (property_exists($obj, $key)) {
                $obj = static::mapItem($obj, $key, $val);
            }
        }
        return $obj;
    }

    private static function mapItem(Model $obj, $key, $val): Model
    {
        // json contains object that is not mapped
        if (!property_exists($obj, $key)) {
            return $obj;
        }
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
                } else { // no type defined
                    $arr = [];
                    foreach ($val as $j => $sub) {
                        $arr[$j] = $sub;
                    }
                    $obj->$key = $arr;
                }
                break;
            default:
                if ($val == null) {
                    $obj->$key = $val;
                    return $obj;
                }
                switch ($type) {
                    case "Maphpodon\models\Account":
                        $obj->$key = Account::build($val, new Account());
                        break;
                    case "Maphpodon\models\Application":
                        $obj->$key = Application::build($val, new Application());
                        break;
                    case "Maphpodon\models\Card":
                        $obj->$key = Card::build($val, new Card());
                        break;
                    case "Maphpodon\models\Configuration":
                        $obj->$key = Configuration::build($val, new Configuration());
                        break;
                    case "Maphpodon\models\Contact":
                        $obj->$key = Contact::build($val, new Contact());
                        break;
                    case "Maphpodon\models\Context":
                        $obj->$key = Context::build($val, new Context());
                        break;
                    case "Maphpodon\models\Emoji":
                        $obj->$key = Emoji::build($val, new Emoji());
                        break;
                    case "Maphpodon\models\FeatureTag":
                        $obj->$key = FeatureTag::build($val, new FeatureTag());
                        break;
                    case "Maphpodon\models\Field":
                        $obj->$key = Field::build($val, new Field());
                        break;
                    case "Maphpodon\models\History":
                        $obj->$key = History::build($val, new History());
                        break;
                    case "Maphpodon\models\Instance":
                        $obj->$key = Instance::build($val, new Instance());
                        break;
                    case "Maphpodon\models\Link":
                        $obj->$key = Link::build($val, new Link());
                        break;
                    case "Maphpodon\models\MediaAttachment":
                        $obj->$key = MediaAttachment::build($val, new MediaAttachment());
                        break;
                    case "Maphpodon\models\Mention":
                        $obj->$key = Mention::build($val, new Mention());
                        break;
                    case "Maphpodon\models\MList":
                        $obj->$key = MList::build($val, new MList());
                        break;
                    case "Maphpodon\models\Notification":
                        $obj->$key = Notification::build($val, new Notification());
                        break;
                    case "Maphpodon\models\Poll":
                        $obj->$key = Poll::build($val, new Poll());
                        break;
                    case "Maphpodon\models\PollOption":
                        $obj->$key = PollOption::build($val, new PollOption());
                        break;
                    case "Maphpodon\models\Relationship":
                        $obj->$key = Relationship::build($val, new Relationship());
                        break;
                    case "Maphpodon\models\Rule":
                        $obj->$key = Rule::build($val, new Rule());
                        break;
                    case "Maphpodon\models\SearchResult":
                        $obj->$key = SearchResult::build($val, new SearchResult());
                        break;
                    case "Maphpodon\models\Status":
                        $obj->$key = Status::build($val, new Status());
                        break;
                    case "Maphpodon\models\StatusEdit":
                        $obj->$key = StatusEdit::build($val, new Status());
                        break;
                    case "Maphpodon\models\StatusSource":
                        $obj->$key = StatusSource::build($val, new Status());
                        break;
                    case "Maphpodon\models\Tag":
                        $obj->$key = Tag::build($val, new Tag());
                        break;
                    case "Maphpodon\models\Thumbnail":
                        $obj->$key = Thumbnail::build($val, new Thumbnail());
                        break;
                    case "Maphpodon\models\Token":
                        $obj->$key = Token::build($val, new Token());
                        break;
                    case "Maphpodon\models\Translation":
                        $obj->$key = Translation::build($val, new Translation());
                        break;
                    //----------------------------------------- admin items
                    case "Maphpodon\models\admin\AdminAccount":
                        $obj->$key = AdminAccount::build($val, new AdminAccount());
                        break;
                    case "Maphpodon\models\admin\AdminCanonicalEmailBlock":
                        $obj->$key = AdminCanonicalEmailBlock::build($val, new AdminCanonicalEmailBlock());
                        break;
                    case "Maphpodon\models\admin\AdminCohort":
                        $obj->$key = AdminCohort::build($val, new AdminCohort());
                        break;
                    case "Maphpodon\models\admin\AdminDomainAllow":
                        $obj->$key = AdminDomainAllow::build($val, new AdminDomainAllow());
                        break;
                    case "Maphpodon\models\admin\AdminDomainBlock":
                        $obj->$key = AdminDomainBlock::build($val, new AdminDomainBlock());
                        break;
                    case "Maphpodon\models\admin\AdminIpBlock":
                        $obj->$key = AdminIpBlock::build($val, new AdminIpBlock());
                        break;
                    case "Maphpodon\models\admin\AdminKey":
                        $obj->$key = AdminKey::build($val, new AdminKey());
                        break;
                    case "Maphpodon\models\admin\AdminMeasure":
                        $obj->$key = AdminMeasure::build($val, new AdminMeasure());
                        break;
                    case "Maphpodon\models\admin\AdminReport":
                        $obj->$key = AdminReport::build($val, new AdminReport());
                        break;
                    case "Maphpodon\models\admin\AdminRole":
                        $obj->$key = AdminRole::build($val, new AdminRole());
                        break;
                    default:
                        throw new InvalidArgumentException($type . " is not mapped");
                }
                break;
        }
        return $obj;
    }
}
