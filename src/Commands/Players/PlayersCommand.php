<?php namespace Mox\Commands\Players;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Player;

class PlayersCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('players')
      ->setDescription('Get full list of players');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $playersData = file_get_contents($this->getDataDir().'/players.json');
    $arrPlayersData = json_decode($playersData, TRUE);
    $headers = [ 'Jersey', 'Name', 'Team', 'Position', 'Height', 'Weight', 'DOB', 'College' ];
    $table = new Table($output);
    $table->setHeaders($headers);
    $players = self::map($arrPlayersData['Players'], function($player) {
      return new Player($player);
    });
    $table->setRows(self::map($players, function($player) {
      return $player->toOutputArray();
    }))
      ->render();
  }
}
