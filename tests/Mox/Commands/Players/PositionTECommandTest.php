<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PositionTECommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PositionTECommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionTE()
  {
    $application = new Application();
    $application->add(new PositionTECommand);

    $command = $application->find('player:position:te');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Rob Gronkowski', $output);
  }
}
