<?php namespace Mox\Commands\Players;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Player;

class PositionDEFCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('player:position:def')
      ->setDescription('Get list of defenses');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $playersData = file_get_contents($this->getDataDir().'/players.json');
    $arrPlayersData = json_decode($playersData, TRUE);
    $headers = ['Jersey','Name', 'Team', 'Position', 'Height', 'Weight', 'DOB', 'College' ];
    $table = new Table($output);
    $table->setHeaders($headers);
    $players = self::map($arrPlayersData['Players'], function($player) {
      return new Player($player);
    });
    $filter = self::filter($players, function($player, $position) {
      return $player->position == $position && $player->active == 1;
    }, 'DEF');
    $table->setRows(self::map($filter, function($player) {
      return $player->toOutputArray();
    }))
      ->render();
  }
}
