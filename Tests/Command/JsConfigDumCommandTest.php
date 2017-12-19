<?php
/**
 * Created by PhpStorm.
 * User: dwendlandt
 * Date: 04/02/16
 * Time: 09:03
 */

namespace Dawen\Bundle\ConfigToJsBundle\Tests\Command;

use Dawen\Bundle\ConfigToJsBundle\Command\JsConfigDumpCommand;
use PHPUnit\Framework\TestCase;

class JsConfigDumpCommandTest extends TestCase
{

    public function testDump()
    {
        $dumper = $this->getMockBuilder('Dawen\Bundle\ConfigToJsBundle\Component\ConfigDumper')
            ->disableOriginalConstructor()
            ->getMock();

        $input = $this->getMockBuilder('Symfony\Component\Console\Input\InputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $output = $this->getMockBuilder('Symfony\Component\Console\Output\OutputInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $dumpCommand = new JsConfigDumpCommand($dumper);

        //test instance
        $this->assertInstanceOf('Dawen\Bundle\ConfigToJsBundle\Command\JsConfigDumpCommand', $dumpCommand);
        $this->assertInstanceOf('Symfony\Component\Console\Command\Command', $dumpCommand);

        //generate expectations
        $outputPath = 'my/output/path.js';

        $dumper->expects($this->once())->method('getOutputPath')->willReturn($outputPath);
        $dumper->expects($this->once())->method('dump');
        $output->expects($this->once())->method('writeln')->with('Dumped config to ' . $outputPath);

        $dumpCommand->run($input, $output);
    }
}