<?php namespace Mox\Commands\Rankings;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Weekly;

class WeeklyQBCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('rankings:weekly:qb')
      ->setDescription('Get list of weekly ranknings for quarterbacks')
      ->addArgument('week', InputArgument::OPTIONAL, 'Which week to get rankings for QB position', 1);
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $week = $input->getArgument('week');
    $table = new Table($output);
    $headers = ['Week', 'Name', 'Team', 'Position', 'Standard', 'Standard Low', 'Standard High', 'PPR', 'PPR Low', 'PPR High', 'Injury', 'Practice Status', 'Game Status', 'Last Update'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/weekly-rankings-QB-'.$week.'.json');
    $dataWeekly = json_decode($data, TRUE);
    $table->setRows(self::map($dataWeekly['Rankings'], function ($qbplayer){
      $qb = new Weekly($qbplayer);
      return $qb->toOutputArray();
    }));
    $table->render();
  }
}
