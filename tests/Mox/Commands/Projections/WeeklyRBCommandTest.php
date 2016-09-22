<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyRBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyRBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionRBWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyRBCommand);

    $command = $application->find('projections:weekly:rb');
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
    $this->assertContains('| 2    | Adrian Peterson      | 0.0  | 0.0      | 0.0      | 0.0          | 0.0           | 18.8 | 84.3    | 0.6      | 0.2    | 2.0             | 14.5        | 0.0         | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 |', $output);
  }
}
