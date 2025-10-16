<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Processor;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Monolog\Logger;

/**
 * Class AbstractProcessor
 * @package Alekseon\LogDetails\Processor
 */
class AbstractProcessor
{
    /**
     * @var
     */
    protected $configCode;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Alekseon\LogDetails\Model\DataContainer
     */
    protected $dataContainer;

    /**
     * AbstractProcessor constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Alekseon\LogDetails\Model\DataContainer $dataContainer
    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->dataContainer = $dataContainer;
    }

    /**
     * @param $record
     * @return bool
     */
    public function canAddDetails($record)
    {
        $enable = (bool) $this->getConfigValue('enable');

        if (!$enable) {
            return false;
        }

        $allowedLevels = explode(',', (string)$this->getConfigValue('log_level'));
        if (!in_array($record['level'], $allowedLevels)) {
            return false;
        }

        return true;
    }

    /**
     * @param $code
     * @return mixed
     */
    protected function getConfigValue($code)
    {
        if ($this->configCode) {
            return $this->scopeConfig->getValue('alekseon_log_details/' . $this->configCode . '/' . $code);
        }
    }

    /**
     * @param $record
     */
    public function addDetails($record)
    {
        if ($this->canAddDetails($record)) {
            $record = $this->process($record);
        }

        return $record;
    }
}