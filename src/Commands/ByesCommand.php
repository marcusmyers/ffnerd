<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ByesCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('byes')
      ->setDescription('Get bye week teams')
      ->addArgument('week', InputArgument::OPTIONAL, 'Filter what week to return');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $week = $input->getArgument('week');
    $table = new Table($output);
    $headers = ['Week', 'Team'];
    $table->setHeaders($headers);
    $byeweeks = file_get_contents('byes.json');
    $byes = json_decode($byeweeks, TRUE);

    if($week != '') {
      $table->setRows($this->_getByeWeeksOutputArray($byes, $week))
        ->render();
    } else {
      $table->setRows($this->_getByeWeeksOutputArray($byes))
        ->render();
    }
  }

  private function _getByeWeeksOutputArray(Array $byes, String $search = '')
  {
    $arrReturn = [];
    if($search != '') {
      foreach($byes as $key=>$value){
        if("Bye Week $search" == $key) {
          $arrReturn = array_merge($arrReturn, $this->_getByeWeekGameData($value));
          break;
        }
      }
    } else {
      foreach($byes as $key=>$value){
        $arrReturn = array_merge($arrReturn, $this->_getByeWeekGameData($value));
      }
    }
    return $arrReturn;
  }

  private function _getByeWeekGameData(Array $game)
  {
    $arrGames = [];
    $arrCheck = ['team'=>'noname'];
    foreach($game as $key=>$value){
      $arrGames[] = array_diff_key($value, $arrCheck);
    }
    return $arrGames;
  }
}
