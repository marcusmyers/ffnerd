<?php namespace Tests\Mox\Commands;

use Mox\Commands\DraftRankingsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class DraftRankingsCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new DraftRankingsCommand);

    $command = $application->find('draft:rankings');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),
      // pass arguments to helper
      // 'name' => 'value',

      // prefix the key with a double slash when passing options,
      // '--some-option' => 'value',
    ));

    $output = $commandTester->getDisplay();
    $this->assertContains('| Name                    | Position | Team | Bye Week | Stand. Dev. | NerdRank | Position Rank | Overall Rank |', $output);
  }

  public function testTableDataSetCorrectly()
  {
     $application = new Application();

    $application->add(new DraftRankingsCommand);

    $command = $application->find('draft:rankings');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),
      // pass arguments to helper
      // 'name' => 'value',

      // prefix the key with a double slash when passing options,
      // '--some-option' => 'value',
    ));

    $output = $commandTester->getDisplay();
    $this->assertContains('| Antonio Brown           | WR       | PIT  | 8        | 1.065       | 1.707    | 1             | 1            |', $output);

  }

  public function testTableDataSetCorrectlyForPPR()
  {
     $application = new Application();

    $application->add(new DraftRankingsCommand);

    $command = $application->find('draft:rankings');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),
      // pass arguments to helper
      // 'name' => 'value',

      // prefix the key with a double slash when passing options,
      '--ppr' => '1',
    ));

    $output = $commandTester->getDisplay();
    $this->assertContains('| Antonio Brown           | WR       | PIT  | 8        | 1.065       | 1.707    | 1             | 1            |', $output);

  }

}
