<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Skills;

class ProjectionsRBCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:projections:rb')
      ->setDescription('Get list of draft projections for running backs');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Name', 'Team', 'Rushing Attempts', 'Rushing Yards', 'Rushing TD', 'Fumbles', 'Receptions', 'Receiving Yards', 'Receiving TD', 'Fantasy Points'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/draft-projections-RB.json');
    $dataDP = json_decode($data, TRUE);
    $table->setRows(self::map($dataDP['DraftProjections'], function ($draftplayer){
      $RB = new Skills($draftplayer);
      return $RB->toOutputArray();
    }));
    $table->render();
  }
}
