<?php

namespace Pageon\Stitcher;

use Brendt\Stitcher\App;
use Brendt\Stitcher\Application\Console;
use Brendt\Stitcher\Plugin\Plugin;
use Pageon\Stitcher\FbEvents\Command\EventSyncCommand;

class FbEventsPlugin implements Plugin
{
    public function __construct(Console $console, EventSyncCommand $syncCommand) {
        $console->add($syncCommand);
    }

    /**
     * Get the location of your plugin's `config.yml` file.
     *
     * @return null|string
     */
    public static function getConfigPath() {
        return __DIR__ . '/../../config.yml';
    }

    /**
     * Get the location of your plugin's `services.yml` file.
     *
     * @return null|string
     */
    public static function getServicesPath() {
        return __DIR__ . '/../../services.yml';
    }
}
