# Form Easy Mail

[![TYPO3 10](https://img.shields.io/badge/TYPO3-10-orange.svg)](https://get.typo3.org/version/10)
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-orange.svg)](https://get.typo3.org/version/11)

> Simplifies the form mail finishers in TYPO3 by enforcing default sender settings.

## About The Project

Form Easy Mail is a TYPO3 extension that enhances the default form mail finishers by automatically enforcing system-defined sender settings. This prevents common issues caused by user misconfiguration of email settings in forms.

### Features

* Automatically uses the system's default mail sender address
* Uses the website title from site configuration as the sender name
* Works with both EmailToSender and EmailToReceiver finishers
* Compatible with TYPO3 v10 and v11

## Installation

### Requirements

* TYPO3 CMS 10.x or 11.x

### Installation Steps

1. Install via composer:
   ```
   composer require fucodo/form-easy-mail
   ```

2. Activate the extension in the Extension Manager or via command line:
   ```
   vendor/bin/typo3 extension:activate form_easy_mail
   ```

That's it! No further configuration is needed for the extension itself.

## Mail Configuration

For the extension to work properly, you need to ensure your TYPO3 mail configuration is set up correctly. This is done in your site's `LocalConfiguration.php` or `AdditionalConfiguration.php` file:

```php
$GLOBALS['TYPO3_CONF_VARS']['MAIL'] = [
    'defaultMailFromAddress' => 'noreply@yourdomain.com',
    'defaultMailFromName' => 'Your Website Name',
    'transport' => 'smtp', // Options: 'smtp', 'sendmail', 'mail'

    // For SMTP transport
    'transport_smtp_server' => 'smtp.yourdomain.com:25',
    'transport_smtp_username' => 'username', // if required
    'transport_smtp_password' => 'password', // if required
    'transport_smtp_encrypt' => 'tls', // Options: '', 'ssl', 'tls'

    // For sendmail transport
    'transport_sendmail_command' => '/usr/sbin/sendmail -t -i',
];
```

### Transport Options

1. **SMTP**: Recommended for production environments
   - Requires valid SMTP server settings
   - Most reliable option for email delivery

2. **Sendmail**: Alternative for Linux/Unix servers
   - Uses the server's sendmail command
   - Requires proper server configuration

3. **Mail**: Basic option (PHP mail function)
   - Simplest to set up but less reliable
   - Not recommended for production environments

## How It Works

The extension overrides the default TYPO3 form email finishers to enforce the sender settings defined in your TYPO3 configuration. This prevents issues where form submissions might fail due to invalid sender addresses entered by users or configured incorrectly in the form setup.

## License

Distributed under the GPL-2.0+ License. See `composer.json` for more information.

## Contact

Kay Strobach - ks@fucodo.de

Project Link: [http://fucodo.de/](http://fucodo.de/)
