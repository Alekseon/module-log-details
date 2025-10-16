# Alekseon Log Details

<h1 align="center">
<br/>
  <img src="https://camo.githubusercontent.com/4d67fed5db38ac07528df9de30fb18a8e16cd5f15affad82ce09edf9a67dc460/68747470733a2f2f692e696d6775722e636f6d2f62326f636c48412e706e67" alt="Magento 2 Log Details" width="400">
  <br>
  Alekseon_LogDetails
  <br>
</h1>

<h4 align="center">Enhanced logging module for Magento 2 that adds contextual information to system logs</h4>

<p align="center"><i>Get better insights from your Magento 2 logs with additional context about web requests, cron jobs, and console commands</i></p>

## Features

### 🌐 Web Request Context
- **IP Address**: Track which IP addresses are generating log entries
- **User Agent**: See what browsers/clients are involved in logged events
- **Referer**: Understand the source of web requests
- **Request URI**: Know which endpoints are generating logs

### ⏰ Cron Job Context
- **Job Code**: Identify which cron job generated the log entry
- **Schedule ID**: Reference the specific cron schedule instance

### 🖥️ Console Command Context
- **Command Name**: Track which CLI command generated the log entry
- **Execution Context**: Understand the source of command-line logs

### 🔍 Trace Logging
- **Debug Information**: Enhanced trace logging for development and debugging
- **Stack Trace Context**: Better understanding of code execution flow

## Installation

In your Magento 2 root directory, install this package via composer:

```bash
composer require alekseon/log-details
bin/magento setup:upgrade
bin/magento setup:static-content:deploy (if needed)
bin/magento cache:flush
```

## Configuration

1. Navigate to **Stores > Configuration > Advanced > System > Alekseon Log Details**
2. Configure the following settings:
   - **Enable Web Context**: Add web request details to logs
   - **Enable Cron Context**: Add cron job details to logs
   - **Enable Console Context**: Add CLI command details to logs
   - **Enable Trace Context**: Add trace information for debugging

## How It Works

This module integrates with Magento 2's logging system using Monolog processors. It automatically adds contextual information to log entries without requiring any changes to your existing logging code.

### Log Entry Enhancement

**Before:**
```
[2025-01-16 10:00:00] main.INFO: Customer login successful [] []
```

**After:**
```
[2025-01-16 10:00:00] main.INFO: Customer login successful [] {
  "extra": {
    "uri": "/customer/account/login/",
    "ip": "192.168.1.100",
    "user-agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
    "referer": "https://example.com/checkout"
  }
}
```

## Technical Details

### Processors
- **Web Processor**: Adds HTTP request context (IP, User-Agent, Referer, URI)
- **Cron Processor**: Adds cron job context (Job Code, Schedule ID)
- **Console Processor**: Adds CLI command context
- **Trace Processor**: Adds debugging trace information

### Plugins
- **SetCronDataPlugin**: Captures cron schedule data for logging
- **SetConsoleCommandDataPlugin**: Captures console command data for logging

### Configuration
All processors can be individually enabled/disabled through the admin configuration panel.

## Support

**Magento Version Compatibility:**

| Module Ver. | Magento 2.4.4+ | Magento 2.4.5+ | Magento 2.4.6+ |
|-------------|:---------------:|:---------------:|:---------------:|
| 1.x         | ✅              | ✅              | ✅              |

## Development / Contribution

If you want to contribute please follow the below instructions:

1. Create an issue and describe your idea
2. [Fork this repository](https://github.com/alekseon/log-details/fork)
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Commit your changes
5. Publish the branch (`git push origin my-new-feature`)
6. Submit a new Pull Request for review

## Issue Tracking

For issues, please use the [issue tracker](https://github.com/alekseon/log-details/issues).

Issues help keep this project alive and strong, so let us know if you find anything!

## Dependencies

This module requires:
- **PHP**: 7.4 or higher
- **Magento Framework**: 102.0.0 or higher

## Use Cases

### Development & Debugging
- **API Debugging**: See which clients are calling your APIs
- **Performance Monitoring**: Track slow requests by IP and user agent
- **Error Analysis**: Understand the context of errors and exceptions

### Production Monitoring
- **Security Monitoring**: Track suspicious requests and their sources
- **Cron Job Monitoring**: Monitor which cron jobs are generating errors
- **User Behavior Analysis**: Understand user flows that lead to errors

### System Administration
- **Log Analysis**: Better filtering and searching of log files
- **Incident Response**: Faster identification of problem sources
- **System Health**: Enhanced visibility into system operations

## Examples

### Web Request Log Entry
```json
{
  "message": "Payment processing error",
  "context": [],
  "level": 400,
  "extra": {
    "uri": "/checkout/onepage/savePayment/",
    "ip": "203.0.113.1",
    "user-agent": "Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)",
    "referer": "https://example.com/checkout/"
  }
}
```

### Cron Job Log Entry
```json
{
  "message": "Cron job completed successfully",
  "context": [],
  "level": 200,
  "extra": {
    "cron": {
      "job_code": "catalog_product_alert",
      "schedule_id": "12345"
    }
  }
}
```

### Console Command Log Entry
```json
{
  "message": "Indexer reindex completed",
  "context": [],
  "level": 200,
  "extra": {
    "console": {
      "command": "indexer:reindex"
    }
  }
}
```

## License

[The Open Software License 3.0 (OSL-3.0)](https://opensource.org/licenses/OSL-3.0)

## About Alekseon

[Alekseon](https://alekseon.com) is a software development company specializing in Magento 2 extensions and custom e-commerce solutions. We create tools that help merchants build better, more secure online stores.

Visit our website to see our full range of Magento 2 extensions: https://alekseon.com