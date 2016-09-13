<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\DynastyCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class DynastyCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsDynasty()
  {
    $application = new Application();
    $application->add(new DynastyCommand);

    $command = $application->find('draft:dynasty');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Odell Beckham Jr.       | NYG  | WR       | 8        |', $output);
  }
}
