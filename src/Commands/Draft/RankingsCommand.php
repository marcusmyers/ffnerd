<?php namespace Mox\Commands\Draft;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Models\DraftRank;
use Mox\Commands\Command as Command;

class RankingsCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('draft:rankings')
      ->setDescription('Get draft rankings for entire nfl for standard and ppr leagues')
      ->addOption('ppr', null, InputOption::VALUE_REQUIRED, 'Get PPR draft rankings', 0);
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $ppr = $input->getOption('ppr');
    $table = new Table($output);
    $headers = ['Name', 'Position', 'Team', 'Bye Week', 'Stand. Dev.', 'NerdRank', 'Position Rank', 'Overall Rank'];
    $table->setHeaders($headers);

    if($ppr) {
      $data = file_get_contents($this->getDataDir().'/draft-rankings-ppr.json');
    } else {
      $data = file_get_contents($this->getDataDir().'/draft-rankings.json');
    }
    $dataDR = json_decode($data, TRUE);
    $table->setRows(self::map($dataDR['DraftRankings'], function($rank) {
      $draftRank = new DraftRank($rank);
      return $draftRank->toOutputArray();
    }))->render();
  }
}
