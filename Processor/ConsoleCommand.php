<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Processor;

/**
 * Class ConsoleCommand
 * @package Alekseon\LogDetails\Processor
 */
class ConsoleCommand extends AbstractProcessor
{
    /**
     * @var string
     */
    protected $configCode = 'command';

    /**
     * @param $record
     * @return mixed
     */
    public function process($record)
    {
        if ($command = $this->dataContainer->getConsoleCommand()) {
            $record['extra']['console'] = [
                'command' => $command,
            ];
        }

        return $record;
    }
}
