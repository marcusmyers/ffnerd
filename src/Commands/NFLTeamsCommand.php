<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NFLTeamsCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('nflteam')
      ->setDescription('Get nfl team')
      ->addArgument('team', InputArgument::OPTIONAL, 'Filter what team to return');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $team = $input->getArgument('team');
    $table = new Table($output);
    $headers = ['Abbr', 'Full Name', 'Short Name'];
    $table->setHeaders($headers);
    $nflteams = file_get_contents('nflteams.json');
    $league = json_decode($nflteams, TRUE)['NFLTeams'];
    if($team != ''){
      $table->setRows([$this->_getTeam($league, $team)])
        ->render();
    } else {
      $table->setRows($league)
        ->render();
    }
  }

  private function _getTeam($teams, $search) {
    foreach($teams as $key=>$val){
      if(in_array($search, $val)){
        return $teams[$key];
      }
    }
  }
}
