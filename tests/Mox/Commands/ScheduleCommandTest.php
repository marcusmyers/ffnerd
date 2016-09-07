<?php namespace Tests\Mox\Commands;

use Mox\Commands\ScheduleCommand;
use Mox\Models\Game;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ScheduleCommandTest extends \PHPUnit_Framework_TestCase
{

  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new ScheduleCommand);

    $command = $application->find('schedule');
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
    $this->assertContains('| Week | Away | Home | Date       | Time     | Station | Winner |', $output);
  }

  public function testTableDataSetCorrectlyWithNoArguments()
  {
    $application = new Application();

    $application->add(new ScheduleCommand);

    $command = $application->find('schedule');
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
    $this->assertContains('| 1    | LA   | SF   | 09/12/2016 | 10:20 PM | ESPN    |        |', $output);
  }


  public function testTableDataSetCorrectlyWhenPassingWeek2IsPassed()
  {
    $application = new Application();

    $application->add(new ScheduleCommand);

    $command = $application->find('schedule');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),

      // pass arguments to the helper
      '--week' => '2',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 2    | PHI  | CHI  | 09/19/2016 | 8:30 PM | ESPN    |        |', $output);
  }

  public function testTableDataSetCorrectlyWhenPassingFullFlag()
  {
    $application = new Application();

    $application->add(new ScheduleCommand);

    $command = $application->find('schedule');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),

      // pass arguments to the helper
      '--full' => '',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 17   | SEA  | SF   | 01/01/2017 | 4:25 PM  | FOX     |        |', $output);
  }
}
