<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Processor;

/**
 * Class Cron
 * @package Alekseon\LogDetails\Processor
 */
class Cron extends AbstractProcessor
{
    /**
     * @var string
     */
    protected $configCode = 'cron';

    /**
     * @param $record
     * @return mixed
     */
    public function process($record)
    {
        if ($schedule = $this->dataContainer->getCronSchedule()) {
            $record['extra']['cron'] = [
                'job_code' => $schedule->getJobCode(),
                'schedule_id' => $schedule->getId()
            ];
        }

        return $record;
    }
}
