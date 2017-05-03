<?php

namespace Pageon\Stitcher\FbEvents\Command;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class EventSyncCommand extends Command
{

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var array
     */
    private $pages;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $srcDir;

    public function __construct(string $accessToken, string $srcDir, array $pages = []) {
        parent::__construct('fb:events:sync');

        $this->accessToken = $accessToken;
        $this->srcDir = $srcDir;
        $this->pages = $pages;
        $this->client = new Client();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $since = Carbon::now()->subDays(7)->timestamp;
        $until = Carbon::now()->addDays(7)->timestamp;
        $events = [];

        foreach ($this->pages as $page) {
            $uri = (new Uri("https://graph.facebook.com/v2.9/{$page}/events/attending/"))->withQuery(implode('&', [
                'fields=id,name,description,place,timezone,start_time',
                "access_token={$this->accessToken}",
                "since={$since}",
                "until={$until}",
            ]));

            $response = $this->client->get($uri);

            if ($response->getStatusCode() !== 200) {
                $output->writeln("Could not find events for page {$page}.");

                continue;
            }

            $pageEvents = json_decode($response->getBody()->getContents(), true)['data'];
            foreach ($pageEvents as $pageEvent) {
                $events[$pageEvent['id']] = $pageEvent;
            }

            $output->writeln("Synced events for page {$page}.");
        }

        $fs = new Filesystem();
        $eventFile = "{$this->srcDir}/data/_fb_events.yml";
        $fs->dumpFile($eventFile, Yaml::dump(['entries' => $events], 10));
        $output->writeln("Events saved in {$eventFile}.");
    }

}
