<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyDEFCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyDEFCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionDEF()
  {
    $application = new Application();
    $application->add(new WeeklyDEFCommand);

    $command = $application->find('rankings:weekly:def');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Seattle Seahawks     | DEF  | SEA      | 9.90     | 6.60         | 13.00         | 9.90 | 6.60    | 13.00    |        |                 |             |             |', $output);
  }
}
