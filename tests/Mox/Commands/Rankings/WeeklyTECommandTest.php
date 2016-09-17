<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyTECommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyTECommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionTE()
  {
    $application = new Application();
    $application->add(new WeeklyTECommand);

    $command = $application->find('rankings:weekly:te');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Jordan Reed             | TE   | WAS      | 9.80     | 8.00         | 11.40         | 15.10 | 14.00   | 17.40    |           |                 |              |             |', $output);
  }
}
