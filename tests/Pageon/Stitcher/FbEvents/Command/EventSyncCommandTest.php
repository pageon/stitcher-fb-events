<?php

namespace Pageon\Stitcher\FbEvents\Command;

use Brendt\Stitcher\App;
use Pageon\Test\CommandTestCase;
use Symfony\Component\Filesystem\Filesystem;

class EventSyncCommandTest extends CommandTestCase
{
    public function setUp() {
        $fs = new Filesystem();
        $fs->mirror(__DIR__ . '/../../../../_src', __DIR__ . '/../../../../src');

        App::init('./tests/config.yml');
    }

    public function tearDown() {
        $fs = new Filesystem();

        if ($fs->exists(__DIR__ . '/../../../../src')) {
            $fs->remove(__DIR__ . '/../../../../src');
        }
    }

    /**
     * @test
     */
    public function it_can_sync_events() {
        $this->runCommand('fb:events:sync');

        $fs = new Filesystem();
        $this->assertTrue($fs->exists('./tests/src/data/_fb_events.yml'));
    }
    
}
