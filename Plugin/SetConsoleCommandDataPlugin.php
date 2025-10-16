<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Plugin;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SetConsoleCommandDataPlugin
 * @package Alekseon\LogDetails\Plugin
 */
class SetConsoleCommandDataPlugin
{
    /**
     * @var \Alekseon\LogDetails\Model\DataContainer
     */
    protected $dataContainer;

    /**
     * SetCronDataPlugin constructor.
     * @param \Alekseon\LogDetails\Model\DataContainer $dataContainer
     */
    public function __construct(
        \Alekseon\LogDetails\Model\DataContainer $dataContainer
    )
    {
        $this->dataContainer = $dataContainer;
    }

    /**
     * @param $application
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return array
     */
    public function beforeRun($command, InputInterface $input, OutputInterface $output)
    {
        $firstArgument = $input->getFirstArgument();
        $this->dataContainer->setConsoleCommand($firstArgument);
        return [$input, $output];
    }
}
