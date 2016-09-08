<?php namespace Tests\Mox\Commands;

use Mox\Commands\AuctionValuesCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class AuctionValuesCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new AuctionValuesCommand);

    $command = $application->find('auction:values');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),

      // pass arguments to the helper
      // 'username' => 'Wouter',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Player                  | Team | Position | Avg. Price | Min. Price | Max Price |', $output);
  }

  public function testTableDataSetCorrectlyForNonPPRLeagues()
  {
    $application = new Application();

    $application->add(new AuctionValuesCommand);

    $command = $application->find('auction:values');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Antonio Brown           | PIT  | WR       | 66         | 60         | 72        |', $output);
  }

  public function testTableDataSetCorrectlyForPPRLeagues()
  {
    $application = new Application();
    $application->add(new AuctionValuesCommand);

    $command = $application->find('auction:values');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'   => $command->getName(),
      '--ppr' => '1',
    ));

    $output = $commandTester->getDisplay();
    $this->assertContains('| Oakland Raiders         | OAK  | DEF      | 0          | 0          | 1         |', $output);
  }
}
