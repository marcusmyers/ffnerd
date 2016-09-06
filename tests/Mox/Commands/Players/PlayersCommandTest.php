<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PlayersCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PlayersCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecute()
  {
    $application = new Application();

    $application->add(new PlayersCommand);

    $command = $application->find('players');
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
    $this->assertContains('Josh Ferguson', $output);
  }
}
