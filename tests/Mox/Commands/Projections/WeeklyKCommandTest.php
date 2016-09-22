<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyKCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyKCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionKWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyKCommand);

    $command = $application->find('projections:weekly:k');
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
    $this->assertContains('| 2    | Justin Tucker        | 0.0  | 0.0      | 0.0      | 0.0          | 0.0           | 0.0 | 0.0     | 0.0      | 0.0    | 0.0             | 0.0         | 0.0         | 2.0 | 2.3 | 2.1 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 |', $output);
  }
}
