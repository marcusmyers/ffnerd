<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsRBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsRBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionRB()
  {
    $application = new Application();
    $application->add(new ProjectionsRBCommand);

    $command = $application->find('draft:projections:rb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Todd Gurley          | LA   | 294              | 1323          | 10         | 2       | 34         | 280             | 1            | 222            |', $output);
  }
}
