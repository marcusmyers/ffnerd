<?php namespace Tests\Mox\Commands\Projections;

use Mox\Commands\Projections\WeeklyWRCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyWRCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionWRWeek2()
  {
    $application = new Application();
    $application->add(new WeeklyWRCommand);

    $command = $application->find('projections:weekly:wr');
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
    $this->assertContains('| 2    | Julio Jones           | 0.0  | 0.0      | 0.0      | 0.0          | 0.0           | 0.0 | 0.1     | 0.0      | 0.1    | 7.8             | 104.4       | 0.7         | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 | 0.0 |', $output);
  }
}
