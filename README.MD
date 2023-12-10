turbosms.ua HTTP API library

API HELP: https://turbosms.ua/api.html

What is this?
-------------

This library implements HTTP api for turbosms.ua service.

Installation
------------
```shell
composer require developingw/turbosmsua
```

Example usage Get Balance
------------
```php
<?php

$smsApi = new API($_ENV['TURBOSMS_KEY']);

print_r($smsApi->getUserBalance());
```
Result:
```
Array (
    [balance] => 2106.42
)
```

Example usage Default Allow Senders
------------
```php
<?php

$smsApi = new API($_ENV['TURBOSMS_KEY']);

print_r($smsApi->getDefaultSenders());
```
Result:
```
Array (
    [
        'TAXI',
        'SERVIS TAXI',
        'Dostavka24',
        'MAGAZIN',
        'IT Alarm',
        'AKCIYA',
        'BEAUTY',
        'Best-Shop',
        'BonusShop',
    ]
)
```

Example usage Message Send
------------
```php
<?php

$smsApi = new API($_ENV['TURBOSMS_KEY']);

print_r($smsApi->messageSend('380001111111', 'TEXT Message'));
print_r($smsApi->messageSend('380001111111', 'TEXT Message', 'MAGAZIN'));
```
Result:
```
Array (
    [0] => stdClass Object (
		[phone] => 380001111111
		[message_id] => f3ab7c22-9481-8d1d-4fa6-00a9e0e6cf67
		[response_code] => 0
		[response_status] => OK
	)
)
Array (
    [0] => stdClass Object (
		[phone] => 380001111111
		[message_id] => f4ab7c22-2371-7d2d-4fa6-00a9e0e4cf68
		[response_code] => 0
		[response_status] => OK
	)
)
```

Example usage Message Send
------------
```php
<?php

$smsApi = new API($_ENV['TURBOSMS_KEY']);

print_r($smsApi->messageStatus('f3ab7c22-9481-8d1d-4fa6-00a9e0e6cf67');
print_r($smsApi->messageStatus(['f4ab7c22-2371-7d2d-4fa6-00a9e0e4cf68']);
```
Result:
```
Array (
    Array (
        [0] => stdClass Object (
            [message_id] => f3ab7c22-9481-8d1d-4fa6-00a9e0e6cf67
            [response_code] => 0
            [recipient] => 380001111111
            [sent] => 2023-12-12 16:00:52
            [updated] => 2023-12-12 16:01:00
            [status] => Delivered
            [type] => sms
            [response_status] => OK
        )
    )
)
Array (
    Array (
        [0] => stdClass Object (
            [message_id] => f4ab7c22-2371-7d2d-4fa6-00a9e0e4cf68
            [response_code] => 0
            [recipient] => 380001111111
            [sent] => 2023-12-11 15:01:52
            [updated] => 2023-12-11 15:02:00
            [status] => Delivered
            [type] => sms
            [response_status] => OK
        )
    )
)
```