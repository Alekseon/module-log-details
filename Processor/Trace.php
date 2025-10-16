<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Processor;

/**
 * Class Trace
 * @package Alekseon\LogDetails\Processor
 */
class Trace extends AbstractProcessor
{
    /**
     * @var string
     */
    protected $configCode = 'trace';

    /**
     * @param $record
     * @return mixed
     */
    public function process($record)
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        $i = 6;

        while (isset($trace[$i])) {
            if (isset($trace[$i]['function']) && isset($trace[$i]['class'])) {
                break;
            }
            $i++;
        }

        if (isset($trace[$i])) {
            $record['extra']['trace'] = [
                'file' => isset($trace[$i - 1]['file']) ? $trace[$i - 1]['file'] : null,
                'line' => isset($trace[$i - 1]['line']) ? $trace[$i - 1]['line'] : null,
                'class' => isset($trace[$i]['class']) ? $trace[$i]['class'] : null,
                'function' => isset($trace[$i]['function']) ? $trace[$i]['function'] : null,
            ];
        }

        return $record;
    }
}
