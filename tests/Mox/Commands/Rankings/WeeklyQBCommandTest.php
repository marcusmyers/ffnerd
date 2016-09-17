<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyQBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyQBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionQB()
  {
    $application = new Application();
    $application->add(new WeeklyQBCommand);

    $command = $application->find('rankings:weekly:qb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Andrew Luck          | QB   | IND      | 23.60    | 17.90        | 26.00         | 23.60 | 17.90   | 26.00    |            |                 |             |             |', $output);
  }

  public function testExecuteAsPositionQBWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyQBCommand);

    $command = $application->find('rankings:weekly:qb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'week' => 2

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 2    | Cam Newton           | QB   | CAR      | 23.70    | 21.20        | 28.00         | 23.70 | 21.20   | 28.00    |            |                 |             |             |', $output);
  }
}
