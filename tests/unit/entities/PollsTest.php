<?php

declare(strict_types=1);

namespace unit\entities;

use Maphpodon\entities\Polls;
use Maphpodon\models\Poll;
use Maphpodon\models\PollOption;
use Safe\Exceptions\FilesystemException;

use function Safe\file_get_contents;

final class PollsTest extends EntityTest
{
    /**
     * @return void
     * @throws FilesystemException
     */
    public function testVoteOnPoll(): void
    {
        $json = file_get_contents("./tests/unit/resources/post-v1-polls-6-votes.json");
        $polls = new Polls($this->getResponseClient($json));
        /** @var Poll $poll */
        $poll = $polls->vote("6", ["choices" => [0, 1]]);
        $this->assertEquals("6", $poll->id);
        $this->assertEquals("2023-02-16 07:47:15", $poll->expires_at->format("Y-m-d H:i:s"));
        $this->assertEquals([0,2], $poll->own_votes);
        /** @var PollOption $pollOption */
        $pollOption = $poll->options[1];
        $this->assertEquals("Two", $pollOption->title);
        $this->assertEquals(0, $pollOption->votes_count);
    }
}
