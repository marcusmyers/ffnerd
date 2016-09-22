<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyQBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyQBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionQBWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyQBCommand);

    $command = $application->find('projections:weekly:qb');
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
    $this->assertContains('| 2    | Drew Brees         | 41.7 | 28.9     | 332.4    | 2.3          | 0.7           | 2.1 | 5.5     | 0.1      | 0.3    | 0.0             | 0.0         | 0.0         | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 |', $output);
  }
}
