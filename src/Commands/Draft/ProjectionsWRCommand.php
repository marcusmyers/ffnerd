<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\Skills;

class ProjectionsWRCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:projections:wr')
      ->setDescription('Get list of draft projections for wide receivers');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Name', 'Team', 'Rushing Attempts', 'Rushing Yards', 'Rushing TD', 'Fumbles', 'Receptions', 'Receiving Yards', 'Receiving TD', 'Fantasy Points'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/draft-projections-WR.json');
    $dataDP = json_decode($data, TRUE);
    $table->setRows(self::map($dataDP['DraftProjections'], function ($draftplayer){
      $WR = new Skills($draftplayer);
      return $WR->toOutputArray();
    }));
    $table->render();
  }
}
