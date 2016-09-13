<?php namespace Mox\Commands\Players;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Player;

class TiersCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('player:tiers')
      ->setDescription('Get list of players based on tiers, peer-grouped listing of players');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Name', 'Team', 'Position', 'Tier'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/tiers.json');
    $dataTiers = json_decode($data, TRUE);
    $table->setRows(self::map($dataTiers, function($player){
      $playerTier = new Player($player);
      return $playerTier->toOutputArrayForTiers();
    }));
    $table->render();
  }
}
