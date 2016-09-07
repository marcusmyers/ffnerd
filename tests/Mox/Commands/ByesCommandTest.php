<?php namespace Tests\Mox\Commands;

use Mox\Commands\ByesCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ByesCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testTableHeadersAreSetCorrectly()
  {
    $application = new Application();

    $application->add(new ByesCommand);

    $command = $application->find('byes');
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
    $this->assertContains('| Week | Team                 |', $output);
  }

  public function testTableDataSetCorrectly()
  {
    $application = new Application();

    $application->add(new ByesCommand);

    $command = $application->find('byes');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command'  => $command->getName(),
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 13   | Cleveland Browns     |', $output);
  }


}
