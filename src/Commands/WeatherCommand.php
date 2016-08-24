<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WeatherCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('weather')
         ->setDescription('Get weather for nfl games');

  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $api_key = getenv('FFN_API_KEY');
    $url = self::getFFNServiceUrl() . "/weather/json/$api_key";
    $res = $this->client->request('GET', $url);

    echo $res->getBody();
  }
}
