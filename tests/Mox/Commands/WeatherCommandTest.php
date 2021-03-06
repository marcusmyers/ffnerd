<?php namespace Tests\Mox\Commands;

use Mox\Commands\WeatherCommand;
use Mox\Models\Game;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class WeatherCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new WeatherCommand);

    $command = $application->find('weather');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),

      // pass arguments to the helper
      // 'username' => 'Wouter',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Week | Away | Home | Date       | Time     | Station | Winner | Forecast                | Low | High | Dome |', $output);
  }

  public function testTableDataSetCorrectly()
  {
    $application = new Application();
    $application->add(new WeatherCommand);

    $command = $application->find('weather');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),
    ));

    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | LA   | SF   | 09/12/2016 | 10:20 PM | ESPN    |        | Mostly Sunny            | 58  | 76   | No   |', $output);
  }
}
