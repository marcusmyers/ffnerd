<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\TiersCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class TiersCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteOfTiersCommand()
  {
    $application = new Application();
    $application->add(new TiersCommand);

    $command = $application->find('player:tiers');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Antonio Brown           | PIT  | WR       | 1    |', $output);
  }
}
