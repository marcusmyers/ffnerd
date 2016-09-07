<?php namespace Tests\Mox\Commands;

use Mox\Commands\NFLTeamsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class NFLTeamsCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new NFLTeamsCommand);

    $command = $application->find('nflteam');
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
    $this->assertContains('| Abbr | Full Name            | Short Name    |', $output);
  }


  public function testTableDataSetCorrectlyWithNoArguments()
  {
    $application = new Application();

    $application->add(new NFLTeamsCommand);

    $command = $application->find('nflteam');
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
    $this->assertContains('| BUF  | Buffalo Bills        | Buffalo       |', $output);
  }

  public function testTableDataSetCorrectlyWhenPassingATeamName()
  {
    $application = new Application();

    $application->add(new NFLTeamsCommand);

    $command = $application->find('nflteam');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),

      // pass arguments to the helper
      'team' => 'BUF',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| BUF  | Buffalo Bills | Buffalo    |', $output);
  }

}
