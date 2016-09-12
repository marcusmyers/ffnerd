<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\QB;

class ProjectionsQBCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:projections:qb')
      ->setDescription('Get list of draft projections for quarterbacks');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Name', 'Team', 'Completions', 'Attempts', 'Passing Yards', 'Passing TD', 'INT', 'Rushing Attempts', 'Rushing Yards', 'Rushing TD', 'Fumbles', 'Fantasy Points'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/draft-projections-QB.json');
    $dataDP = json_decode($data, TRUE);
    $table->setRows(self::map($dataDP['DraftProjections'], function ($draftplayer){
      $qb = new QB($draftplayer);
      return $qb->toOutputArray();
    }));
    $table->render();
  }
}
