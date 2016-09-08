<?php namespace Mox\Commands\Players;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Player;

class PositionCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('player:position')
      ->setDescription('Get list of players by position')
      ->addArgument('position', InputArgument::REQUIRED, 'The position of the players to get a list of');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $position = $input->getArgument('position');
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
    }, $position);
    $table->setRows(self::map($filter, function($player) {
      return $player->toOutputArray();
    }))
      ->render();
  }
}
