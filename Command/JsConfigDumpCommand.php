<?php
/**
 * Created by PhpStorm.
 * User: dwendlandt
 * Date: 03/02/16
 * Time: 23:28
 */

namespace Dawen\Bundle\ConfigToJsBundle\Command;

use Dawen\Bundle\ConfigToJsBundle\Component\ConfigDumperInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JsConfigDumpCommand extends Command
{
    /**
     * @var ConfigDumperInterface
     */
    private $dumper;

    /**
     * JsConfigDumpCommand constructor.
     *
     * @param ConfigDumperInterface $dumper
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(ConfigDumperInterface $dumper)
    {
        parent::__construct();

        $this->dumper = $dumper;
    }

    /**
     * @see Command
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this
            ->setName('config:js:dump')
            ->setDescription('Dumps defined config to js file');
    }

    /**
     * @see Command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     *
     * @throws \Dawen\Bundle\ConfigToJsBundle\Component\ConfigDumperException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->dumper->dump();

        $output->writeln('Dumped config to ' . $this->dumper->getOutputPath());
    }
}