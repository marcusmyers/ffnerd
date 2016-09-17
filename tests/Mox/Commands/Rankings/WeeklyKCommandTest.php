<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyKCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyKCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionK()
  {
    $application = new Application();
    $application->add(new WeeklyKCommand);

    $command = $application->find('rankings:weekly:k');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Dan Bailey           | K    | DAL      | 10.20    | 7.50         | 12.00         | 10.20 | 7.50    | 12.00    |        |                 |             |             |', $output);
  }
}
