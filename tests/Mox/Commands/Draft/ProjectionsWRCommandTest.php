<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsWRCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsWRCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionWR()
  {
    $application = new Application();
    $application->add(new ProjectionsWRCommand);

    $command = $application->find('draft:projections:wr');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Antonio Brown         | PIT  | 4                | 24            | 0          | 1       | 124        | 1694            | 10           | 230            |', $output);
  }
}
