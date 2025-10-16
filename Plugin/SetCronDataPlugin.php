<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Plugin;

/**
 * Class SetCronDataPlugin
 * @package Alekseon\LogDetails\Plugin
 */
class SetCronDataPlugin
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
     * @param $schedule
     */
    public function beforeTryLockJob($schedule)
    {
        $this->dataContainer->setCronSchedule($schedule);
    }
}