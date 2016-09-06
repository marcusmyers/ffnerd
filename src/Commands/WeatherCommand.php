<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Models\Game;

class WeatherCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('weather')
         ->setDescription('Get weather for current week of nfl games');

  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    // $api_key = getenv('FFN_API_KEY');
    // $url = self::getFFNServiceUrl() . "/weather/json/$api_key";
    // $res = $this->client->request('GET', $url);

    // echo $res->getBody();
    $table = new Table($output);
    $weeksWeatherData = file_get_contents('weather.json');
    $weatherData = json_decode($weeksWeatherData, TRUE);
    $gameWeek = $weatherData['Week'];
    $games = $weatherData['Games'];
    $headers = ['Week', 'Away', 'Home', 'Date', 'Time', 'Station', 'Winner', 'Forecast', 'Low', 'High', 'Dome'];
    $table->setHeaders($headers);

    $weatherGames = self::map($games, function($game) {
      return new Game($game);
    });

    $table->setRows(self::map($weatherGames, function($game) {
      return $game->toWeatherOutputArray();
    }))->render();
  }
}
