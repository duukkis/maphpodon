<?php

declare(strict_types=1);

namespace unit\entities;

use Maphpodon\entities\Statuses;
use Maphpodon\models\Status;
use Safe\Exceptions\FilesystemException;

use function Safe\file_get_contents;

final class StatusesTest extends EntityTest
{
    /**
     * @return void
     * @throws FilesystemException
     */
    public function testGet(): void
    {
        $json = file_get_contents("./tests/unit/resources/get-v1-statuses-109825403503402367.json");
        $statuses = new Statuses($this->getResponseClient($json));
        /** @var Status $status */
        $status = $statuses->get("109825403503402367");
        $this->assertEquals("109825403503402367", $status->id);
        $this->assertFalse($status->favourited);
        $this->assertEquals("Web", $status->application->name);
        $this->assertEquals("2023-02-04 00:00:00", $status->account->created_at->format("Y-m-d H:i:s"));
        $this->assertEquals(3, $status->account->roles[0]->id);
    }
}
