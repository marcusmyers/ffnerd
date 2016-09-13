<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsIDPCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsIDPCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionIDP()
  {
    $application = new Application();
    $application->add(new ProjectionsIDPCommand);

    $command = $application->find('draft:projections:idp');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| 1    | Lavonte David      | TB   | LB       | 6        |', $output);
  }
}
