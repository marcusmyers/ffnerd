<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PositionWRCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PositionWRCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionWR()
  {
    $application = new Application();
    $application->add(new PositionWRCommand);

    $command = $application->find('player:position:wr');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Julio Jones', $output);
  }
}
