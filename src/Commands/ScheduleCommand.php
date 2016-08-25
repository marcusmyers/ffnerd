<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Models\Game as Game;

class ScheduleCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('schedule')
      ->setDescription('Get full schedule')
      ->addOption('week', 'w', InputOption::VALUE_OPTIONAL, 'Filter what week to return', null)
      ->addOption('team', 't', InputOption::VALUE_OPTIONAL, 'Filter what team schedule to return', null)
      ->addOption('full', 'f', InputOption::VALUE_OPTIONAL, 'Get Full season schedule for all of NFL, default: false', false);
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $week = $input->getOption('week');
    $team = $input->getOption('team');
    $full = $input->getOption('full');
    $table = new Table($output);
    $headers = ['Week', 'Away', 'Home', 'Date', 'Time', 'Station', 'Winner'];
    $table->setHeaders($headers);
    $schedule_data = file_get_contents('schedule.json');
    $arrScheduleData = json_decode($schedule_data, TRUE);
    $schedules = $arrScheduleData['Schedule'];
    $currentWeek = $arrScheduleData['currentWeek'];
    if(!empty($week) || !$full){
      $week = $currentWeek;
      $table->setRows($this->_getScheduleFormattedArray($schedules, $week))
        ->render();
    } elseif(!empty($team)){
      $table->setRows($this->_getScheduleFormattedArray($schedules, $team))
        ->render();
    } else {
      $table->setRows($this->_getScheduleFormattedArray($schedules))
        ->render();
    }
  }

  private function _getScheduleFormattedArray(Array $schedules, String $search = '')
  {
    $arrGames = [];
    if(!empty($search)) {
      foreach($schedules as $schedule)
      {
        if($schedule['gameWeek'] == $search){
          $game = new Game($schedule);
          $arrGames[] = $game->toOutputArray();
        }
        if($schedule['awayTeam'] == $search || $schedule['homeTeam'] == $search) {
          $game = new Game($schedule);
          $arrGames[] = $game->toOutputArray();
        }
      }
    } else {
      foreach($schedules as $schedule)
      {
        $game = new Game($schedule);
        $arrGames[] = $game->toOutputArray();
      }
    }
    return $arrGames;
  }
}
