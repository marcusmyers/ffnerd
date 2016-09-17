<?php namespace Tests\Mox\Commands\Rankings;

use Mox\Commands\Rankings\WeeklyWRCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeeklyWRCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionWR()
  {
    $application = new Application();
    $application->add(new WeeklyWRCommand);

    $command = $application->find('rankings:weekly:wr');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Julio Jones           | WR   | ATL      | 14.40    | 10.00        | 18.60         | 21.90 | 16.83   | 26.60    | Ankle      |                 | Questionable | 2016-09-12  |', $output);
  }
}
