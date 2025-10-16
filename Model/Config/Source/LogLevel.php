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

        $levels = \Monolog\Logger::getLevels();
        foreach ($levels as $level) {
            $options[$level] = \Monolog\Logger::getLevelName($level);
        }

        return $options;
    }
}