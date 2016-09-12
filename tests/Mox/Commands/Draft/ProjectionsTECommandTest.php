<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsTECommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsTECommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionWR()
  {
    $application = new Application();
    $application->add(new ProjectionsTECommand);

    $command = $application->find('draft:projections:te');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Rob Gronkowski          | NE   | 0                | 0             | 0          | 0       | 81         | 1079            | 11           | 174            |', $output);
  }
}
