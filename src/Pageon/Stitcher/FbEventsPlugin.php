<?php

namespace Pageon\Stitcher;

use Brendt\Stitcher\App;
use Brendt\Stitcher\Application\Console;
use Brendt\Stitcher\Plugin\Plugin;

class FbEventsPlugin implements Plugin
{
    /**
     * @return void
     */
    public function init() {
        /** @var Console $console */
        $console = App::get('app.console');

        $console->add(App::get('fb.events.command.sync'));
    }

    /**
     * Get the location of your plugin's `config.yml` file.
     *
     * @return null|string
     */
    public function getConfigPath() {
        return __DIR__ . '/../../config.yml';
    }

    /**
     * Get the location of your plugin's `services.yml` file.
     *
     * @return null|string
     */
    public function getServicesPath() {
        return __DIR__ . '/../../services.yml';
    }
}
