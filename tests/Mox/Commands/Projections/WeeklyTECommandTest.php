<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyTECommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyTECommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionTEWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyTECommand);

    $command = $application->find('projections:weekly:te');
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
    $this->assertContains('| 2    | Delanie Walker          | 0.0  | 0.0      | 0.0      | 0.0          | 0.0           | 0.1 | 0.0     | 0.0      | 0.0    | 5.7             | 70.8        | 0.3         | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 |', $output);
  }
}
