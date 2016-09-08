<?php namespace Mox\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Mox\Models\Auction;

class AuctionValuesCommand extends Command {
  public function __construct()
  {
    parent::__construct();
  }

  public function configure()
  {
    $this->setName('auction:values')
      ->setDescription('Get auction values for players')
      ->addOption('ppr',
        null,
        InputOption::VALUE_REQUIRED,
        'Should it just be values for PPR leagues?',
        0);
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $table = new Table($output);
    $headers = ['Player', 'Team', 'Position', 'Avg. Price', 'Min. Price', 'Max Price'];
    $table->setHeaders($headers);
    if($input->getOption('ppr') == 1) {
      $data = file_get_contents($this->getDataDir()."/auctionvalues_ppr.json");
    } else {
      $data = file_get_contents($this->getDataDir()."/auctionvalues.json");
    }
    $auctionData = json_decode($data, TRUE);
    $table->setRows(self::map($auctionData['AuctionValues'], function($auction) {
      $av = new Auction($auction);
      return $av->toOutputArray();
    }));
    $table->render();
  }
}
