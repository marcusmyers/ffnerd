<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyDEFCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyDEFCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionDEFWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyDEFCommand);

    $command = $application->find('projections:weekly:def');
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
    $this->assertContains('| 2    | Seattle Seahawks     | 0.0  | 0.0      | 0.0      | 0.0          | 0.0           | 0.0 | 0.0     | 0.0      | 0.0    | 0.0             | 0.0         | 0.0         | 0.0 | 0.0 | 0.0 | 1.2 | 0.6 | 0.6 | 2.7 | 0.2 | 0.0 | 0.0 | 13.7 | 233.2 |', $output);
  }
}
