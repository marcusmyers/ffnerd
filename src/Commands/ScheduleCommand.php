<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Models\Game;

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
    $schedules = self::map($arrScheduleData['Schedule'], function($schedule) {
      return new Game($schedule);
    });
    $currentWeek = $arrScheduleData['currentWeek'];
    if(!empty($week) || !$full){
      $week = $currentWeek;
      $filter = self::filter($schedules, function($game, $week) {
        return $game->gameWeek == $week;
      }, $week);
      $table->setRows(self::map($filter, function($game) {
        return $game->toOutputArray();
      }))
        ->render();
    } elseif(!empty($team)){
      $filter = self::filter($schedules, function($game, $team) {
        return $game->awayTeam == $team || $game->homeTeam == $team;
      }, $team);
      $table->setRows(self::map($filter, function($game) {
        return $game->toOutputArray();
      }
      ))
        ->render();
    } else {
      $table->setRows(self::map($schedules, function($game) {
        return $game->toOutputArray();
      }))
        ->render();
    }
  }
}
