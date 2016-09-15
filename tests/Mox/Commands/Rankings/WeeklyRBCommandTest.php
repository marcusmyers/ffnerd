<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyRBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyRBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionRB()
  {
    $application = new Application();
    $application->add(new WeeklyRBCommand);

    $command = $application->find('rankings:weekly:rb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Todd Gurley          | RB   | LA       | 15.20    | 14.30        | 18.00         | 17.40 | 16.90   | 20.51    |           |                 |              |             |', $output);
  }
}
