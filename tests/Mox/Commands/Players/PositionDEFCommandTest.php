<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PositionDEFCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PositionDEFCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionDEF()
  {
    $application = new Application();
    $application->add(new PositionDEFCommand);

    $command = $application->find('player:position:def');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Seattle Seahawks', $output);
  }
}
