<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PositionRBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PositionRBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionRB()
  {
    $application = new Application();
    $application->add(new PositionRBCommand);

    $command = $application->find('player:position:rb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('LeSean McCoy', $output);
  }
}
