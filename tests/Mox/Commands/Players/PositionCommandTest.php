<?php namespace Tests\Mox\Commands\Players;

use Mox\Commands\Players\PositionCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PositionCommandTest extends \PHPUnit_Framework_TestCase
{
  public function testExecuteAsPositionQB()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'QB',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Trevone Boykin', $output);
  }

  public function testExecuteAsPositionWR()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'WR',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Julio Jones', $output);
  }

  public function testExecuteAsPositionRB()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'RB',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('LeSean McCoy', $output);
  }

  public function testExecuteAsPositionTE()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'TE',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Rob Gronkowski', $output);
  }

  public function testExecuteAsPositionK()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'K',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Stephen Gostkowski', $output);
  }

  public function testExecuteAsPositionDEF()
  {
    $application = new Application();
    $application->add(new PositionCommand);

    $command = $application->find('player:position');
    $commandTester = new CommandTester($command);
    $commandTester->execute(array(
      'command' => $command->getName(),

      // pass arguments to the helper
      'position' => 'DEF',

      // prefix the key with a double slash when passing options,
      // e.g: '--some-option' => 'option_value',
    ));

    //the output of the command in the console
    $output = $commandTester->getDisplay();
    $this->assertContains('Seattle Seahawks', $output);
  }
}
