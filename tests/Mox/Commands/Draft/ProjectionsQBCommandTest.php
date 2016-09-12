<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsQBCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsQBCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionQB()
  {
    $application = new Application();
    $application->add(new ProjectionsQBCommand);

    $command = $application->find('draft:projections:qb');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Cam Newton           | CAR  | 306         | 506      | 3854          | 27         | 12  | 125              | 599           | 8          | 4       | 338            |', $output);
  }
}
