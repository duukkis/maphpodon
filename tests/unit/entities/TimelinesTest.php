<?php

declare(strict_types=1);

namespace unit\entities;

use Maphpodon\entities\Timelines;
use Maphpodon\models\Status;
use Safe\Exceptions\FilesystemException;

use function Safe\file_get_contents;

final class TimelinesTest extends EntityTest
{
    /**
     * @return void
     * @throws FilesystemException
     */
    public function testPublicComeInRightOrder(): void
    {
        $json = file_get_contents("./tests/unit/resources/get-v1-timelines-public.json");
        $timelines = new Timelines($this->getResponseClient($json));
        $statuses = $timelines->public(["limit" => 10]);
        $this->assertEquals(10, count($statuses));
        /** @var Status $status */
        foreach ($statuses as $i => $status) {
            switch ($i) {
                case 0:
                case 4:
                case 5:
                case 8:
                case 9:
                    $this->assertEquals("kansanradio", $status->account->username);
                    break;
                case 1:
                case 7:
                    $this->assertEquals("munasaannos", $status->account->username);
                    break;
                case 2:
                    $this->assertEquals("ahdistaa", $status->account->username);
                    break;
                case 3:
                    $this->assertEquals("sananlasku", $status->account->username);
                    break;
                case 6:
                    $this->assertEquals("Nelipolvitrokee", $status->account->username);
                    break;
                default:
                    $this->assertEquals(-1, $i);
                    break;
            }
        }
    }
}
