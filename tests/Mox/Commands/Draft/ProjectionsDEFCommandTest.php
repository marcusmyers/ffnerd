<?php namespace Tests\Mox\Commands\Draft;

use Mox\Commands\Draft\ProjectionsDEFCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ProjectionsDEFCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionK()
  {
    $application = new Application();
    $application->add(new ProjectionsDEFCommand);

    $command = $application->find('draft:projections:def');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('| Denver Broncos       | DEN  | 44    | 18            | 11                | 3  | 2               | 121            |', $output);
  }
}
