<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\LogDetails\Processor;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Header;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Alekseon\LogDetails\Model\DataContainer;

/**
 * Class Web
 * @package Alekseon\LogDetails\Processor
 */
class Web extends AbstractProcessor
{
    /**
     * @var string
     */
    protected $configCode = 'web';
    protected Header $httpHeader;
    /**
     * @var RemoteAddress
     */
    protected RemoteAddress $remoteIp;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param \Alekseon\LogDetails\Model\DataContainer $dataContainer
     * @param Header $httpHeader
     * @param RemoteAddress $remoteIp
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        DataContainer $dataContainer,
        Header $httpHeader,
        RemoteAddress $remoteIp
    ) {
        $this->httpHeader = $httpHeader;
        $this->remoteIp = $remoteIp;

        parent::__construct($scopeConfig, $dataContainer);
    }
    /**
     * @param $record
     * @return mixed
     */
    public function process($record)
    {
        if (isset($_SERVER["REQUEST_URI"])) {
            $record['extra']['uri'] = $_SERVER["REQUEST_URI"];
            $record['extra']['referer'] = $this->httpHeader->getHttpReferer();
            $record['extra']['user-agent'] = $this->httpHeader->getHttpUserAgent();
            $record['extra']['ip'] = $this->remoteIp->getRemoteAddress();
        } elseif (PHP_SAPI == 'cli') {
            $record['extra']['uri'] = 'CLI';
        }

        return $record;
    }
}
