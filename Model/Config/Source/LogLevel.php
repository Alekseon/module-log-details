<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Model\Config\Source;

use Psr\Log\LoggerInterface;

/**
 * Class LogLevel
 * @package Alekseon\LogDetails\Model\Config\Source
 */
class LogLevel implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * LogLevel constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = $this->toArray();
        $optionArray = [];

        foreach ($options as $value => $label) {
            $optionArray[] = [
                'value' => $value,
                'label' => $label
            ];
        }
        return $optionArray;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $options = [];

        // Use predefined log levels compatible with both old and new Monolog versions
        $levels = [
            100 => 'DEBUG',
            200 => 'INFO', 
            250 => 'NOTICE',
            300 => 'WARNING',
            400 => 'ERROR',
            500 => 'CRITICAL',
            550 => 'ALERT',
            600 => 'EMERGENCY'
        ];
        
        foreach ($levels as $level => $name) {
            $options[$level] = $name;
        }

        return $options;
    }
}