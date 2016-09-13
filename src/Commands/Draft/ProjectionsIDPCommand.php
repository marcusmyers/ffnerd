<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\IDP;

class ProjectionsIDPCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:projections:idp')
      ->setDescription('Get list of draft projections for individual defensive player');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Rank', 'Name', 'Team', 'Position', 'Bye Week'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/draft-idp.json');
    $dataIDP = json_decode($data, TRUE);
    $table->setRows(self::map($dataIDP['DraftIDP'], function ($draftplayer){
      $idp = new IDP($draftplayer);
      return $idp->toOutputArray();
    }));
    $table->render();
  }
}
