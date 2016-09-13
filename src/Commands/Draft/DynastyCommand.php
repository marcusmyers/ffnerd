<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Commands\Command as Command;
use Mox\Models\IDPDynasty;

class DynastyCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:dynasty')
      ->setDescription('Get list of draft projections for dynasty drafts');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Rank', 'Name', 'Team', 'Position', 'Bye Week'];
    $table->setHeaders($headers);
    $data = file_get_contents($this->getDataDir().'/dynasty.json');
    $dataDynasty = json_decode($data, TRUE);
    $table->setRows(self::map($dataDynasty['Dynasty'], function ($draftplayer){
      $idp = new IDPDynasty($draftplayer);
      return $idp->toOutputArray();
    }));
    $table->render();
  }
}
