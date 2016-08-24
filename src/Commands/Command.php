<?php namespace Mox\Commands;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\Client;

class Command extends SymfonyCommand {

  const NFL_SCHEDULE_URL = "http://www.nfl.com/ajax/scorestrip?";
  const FFN_SERVICE_URL = "http://www.fantasyfootballnerd.com/service/";

  protected $client;

  public function __construct()
  {
    $this->client = new Client();
    parent::__construct();
  }

  public static function getNFLScheduleUrl($year, $week, $seasonType) {
    return self::NFL_SCHEDULE_URL . "season=$year&seasonType=$seasonType&week=$week";
  }

  public static function getFFNServiceUrl() {
    return self::FFN_SERVICE_URL;
  }
}
