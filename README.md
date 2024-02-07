TurboSMS HTTP API library

API HELP: https://turbosms.ua/api.html

What is this? 
-------------

This library implements HTTP api for https://turbosms.ua service.

Installation
------------
```shell
composer require developingw/turbosmsua
```

Example usage Get Balance
------------
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

$balance = $smsApi->getUserBalance();

print_r($balance);
```
Result:
```
Array (
    [balance] => 2106.42
)
```

----

Example usage Default SMS Allow Senders for Test
------------

If you are testing, it is preferable to start the message with the word "Test".
------------
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

$senderList = $smsApi->getSMSDefaultSenders();

print_r($senderList);
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

----

Example usage Default Viber Allow Senders for Test
------------
If you are testing, it is preferable to start the message with the word "Test".
------------
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

$senderList = $smsApi->getViberDefaultSenders();

print_r($senderList);
```
Result:
```
Array (
    [
        
    ]
)
```

----

Example usage Message Send
------------
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

$message1 = $smsApi->messageSend('380001111111', 'TEXT Message');
$message2 = $smsApi->messageSend('380001111111', 'TEXT Message', 'MAGAZIN');

print_r($message1);
print_r($message2);
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
----

* For the messageSend method, there are fine-tuning settings.
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

// This message will be sent at the specified time.
$message1 = $smsApi
                ->setStartTime(\DateTime::createFromFormat('d.m.Y H:i', '10.12.2023 9:00'));
                ->messageSend('380001111111', 'TEXT Message');
                
// This message will be sent via Viber.
$message2 = $smsApi
                ->setMode('viber')
                ->messageSend('380001111111', 'TEXT Message', 'MAGAZIN');
                
// This message will be sent via Viber and SMS.
// With an additional condition, the maximum lifespan of the Viber message is 60 seconds.
$message3 = $smsApi
                ->setMode('hybrid')
                ->setTTL(60)
                ->messageSend('380001111111', 'TEXT Message', 'YOUR SENDER');

print_r($message1);
print_r($message2);
print_r($message3);
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
Array (
    [0] => stdClass Object (
		[phone] => 380001111111
		[message_id] => f9ag2d21-3381-8d3d-2fa8-01b9e0e4cf69
		[response_code] => 0
		[response_status] => OK
	)
)
```
----

Example usage Message Status
------------
```php
<?php

use DevelopingW\TurboSMSua\API;

$smsApi = new API($_ENV['TURBOSMS_KEY']);

$status = $smsApi->messageStatus('f3ab7c22-9481-8d1d-4fa6-00a9e0e6cf67'); 
$statusList = $smsApi->messageStatus(['f4ab7c22-2371-7d2d-4fa6-00a9e0e4cf68']);

print_r($status);
print_r($statusList);
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
            [sent] => 
            [updated] => 2023-12-11 15:02:00
            [status] => Queued
            [type] => sms
            [response_status] => OK
        )
    )
)
```

Methods ENG:
------------
***
* getSMSDefaultSenders - Get a list of Senders for SMS testing.
* getViberDefaultSenders - Get a list of Senders for Viber testing.
* messageSend - Send a SMS or Viber message.
* messageStatus - Check the status of the message.
***

Methods RUS:
------------
***
* getSMSDefaultSenders - Получить список Senders для теста СМС
* getViberDefaultSenders - Получить список Senders для теста Viber
* messageSend - Отправить сообщение СМС или Viber
* messageStatus - Проверить статус сообщения
***

Donate:
------------
***
* Bitcoin (BTC): bc1q7xnavcmr3lt4mpsp7xv740usggypxaa0djy9z9
* Raven (RVN): RRo5CR8gXLzoV3LHRjj7fRhMP1WxNwgWRY
* Neoxa (NEOX): GVoMxomCS6aS1oi4nzwBqFyukecgbm2oVu
***
