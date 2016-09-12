<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsKCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsKCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionK()
  {
    $application = new Application();
    $application->add(new ProjectionsKCommand);

    $command = $application->find('draft:projections:k');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Stephen Gostkowski   | NE   | 46           | 32          | 142            |', $output);
  }
}
