SmsSenderBundle
===============

This bundle integrates with [gergelypolonkai/smssender](https://github.com/gergelypolonkai/smssender) to send SMS messages through
[gergelypolonkai/smsgateway](https://github.com/gergelypolonkai/smsgateway).

## Installation

Simply add gergelypolonkai/smssender-bundle to your Symfony2 project's
composer.json file, and run

    php composer.phar update

## Configuration

Everything is configurable through the Symfony project's configuration files.
In YML format, the possibilities are:

    gergely_polonkai_sms_sender:

        # This must be set, as it has no default value
        sender_url: http://localhost/smsgateway

        # The username/password to use to login to SmsGateway. No default values
        # are available, either
        username: gateway-user
        password: gateway-password

        # This defaults to true. You should set this to false if you use
        # self-signed certificates
        verify_ssl: true

        # This is the default value. Currently SmsGateway requires this to be
        # be set to application/json
        content_type: application/json

        # The content-encoding of the data you send to the server. This must be
        # UTF-8 if you want to send an SMS with non-ascii characters.
        content-encoding: utf-8

        # This should be turned on only for debugging purposes. It makes CURL to
        # log every traffic it makes with SmsGateway.
        verbose_curl: false

## Usage

Everything is done via the gergely\_polonkai\_sms\_sender.sender service.

    $sender = $container->get('gergely_polonkai_sms_sender.sender');
    $sender->login();
    $sender->send('+155523456789', 'Hello world!', array());
    $sender->logout();
