<?php

/**
 * turbosms.ua HTTP API implementation.
 *
 * @author Anton Kalochelitis <developing.w@gmail.com>
 * @version 2.1.0
 */

namespace DevelopingW\TurboSMSua;

class REQUEST_CODE
{
    protected static $EN = [
        '0' => "Request processed successfully.",
        '1' => "Successful result of the ping method call.",
        '103' => "Authentication token is missing.",
        '104' => "Request data is missing.",
        '105' => "Authentication failed, invalid token.",
        '106' => "User is blocked, API usage is not possible until unblocked.",
        '107' => "No active Viber session, session message sending is not possible.",
        '200' => "Sender message parameter is missing or empty.",
        '201' => "Text message parameter is missing or empty.",
        '202' => "Recipient list parameter is missing or empty.",
        '203' => "Insufficient balance to create a distribution.",
        '204' => "Message button parameters are missing or empty when required.",
        '205' => "Text parameter on the button in the message is missing or empty.",
        '206' => "URL parameter is missing or empty, where the message recipient will go when the button is clicked.",
        '300' => "Invalid request, check its structure and data correctness.",
        '301' => "Invalid authentication token.",
        '302' => "Invalid message sender.",
        '303' => "Invalid scheduled message sending date.",
        '304' => "Invalid message text value. Returned if a non-string value is passed or the character encoding is not UTF-8.",
        '305' => "Invalid recipient number, the system could not recognize the recipient's country and operator.",
        '306' => "Invalid ttl parameter value, the value must be an integer and not represented as a string.",
        '307' => "Invalid message_id parameter value, incorrect format.",
        '308' => "Invalid id parameter value when calling the file/details method, incorrect format.",
        '309' => "Invalid sender_id parameter value when calling the chat/recipients method, incorrect format.",
        '310' => "Invalid chat_id parameter value when calling the chat module methods, incorrect format.",
        '311' => "Invalid session_id parameter value when calling the chat/session method, incorrect format.",
        '312' => "Invalid pagination page parameter value.",
        '313' => "Invalid pagination rows parameter value.",
        '400' => "Unauthorized sender for the current user.",
        '401' => "The sender is allowed, but not activated at the moment (not paid for use in the current month, registration is not completed, etc.).",
        '402' => "Invalid image file type.",
        '403' => "Invalid scheduled message sending date (exceeds established limits).",
        '404' => "Recipient number is in the stoplist (for SMS) or the ignorelist (for Viber), sending is not possible.",
        '405' => "Invalid number of recipients.",
        '406' => "Invalid recipient country. The user does not have the ability to send messages to recipients from this country. To activate such an option, contact our customer support department.",
        '407' => "The recipient is already present in the distribution, duplicates are ignored.",
        '408' => "The text on the button is too long, only up to 30 characters are allowed.",
        '409' => "Invalid ttl parameter value (exceeds established limits).",
        '410' => "Invalid content in the transactional message. Only text can be sent in such messages, while buttons and images are prohibited.",
        '411' => "One of the parameters has an invalid value, contact our customer support department for details.",
        '412' => "The text contains prohibited fragments.",
        '413' => "The maximum message text length has been exceeded.",
        '414' => "Message data with the passed message_id is not available for the current user.",
        '415' => "It is prohibited to send transactional messages from a common sender.",
        '416' => "Template corresponding to the passed transactional message was not found.",
        '417' => "The file with the passed id does not exist or is not available for the current user.",
        '418' => "The specified uploaded file was not found or is empty.",
        '419' => "Unsupported file type.",
        '420' => "The file size exceeds the maximum allowed size of 3MB.",
        '421' => "The sender does not support sending messages of the specified type.",
        '422' => "It is prohibited to send more than 5 session messages in a row without the recipient's response.",
        '423' => "The filename in the Viber message is too long, only up to 25 characters are allowed.",
        '500' => "Failed to convert result data to JSON format, contact our customer support department for details.",
        '501' => "Failed to convert result data to XML format, contact our customer support department for details.",
        '502' => "Failed to recognize the request body (invalid format).",
        '503' => "Failed to send SMS message.",
        '504' => "Failed to send Viber message.",
        '505' => "Failed to save image.",
        '506' => "Failed to save file.",
        '800' => "Messages were successfully created and added to the sending queue. Some messages may undergo pre-moderation.",
        '801' => "Messages were successfully sent.",
        '802' => "Messages were successfully created and added to the sending queue, but some recipients did not make it to the distribution list, see details in the response.",
        '803' => "Messages were successfully sent, but some recipients did not make it to the distribution list, see details in the response.",
        '999' => "Error executing the request, contact the support department to clarify the details."
    ];

    protected static $RU = [
        '0' => "Запрос обработан успешно.",
        '1' => "Успешный результат вызова метода ping.",
        '103' => "Отсутствует токен аутентификации.",
        '104' => "Отсутствуют данные запроса.",
        '105' => "Аутентификация не пройдена, не верный токен.",
        '106' => "Пользователь заблокирован, работа с API невозможна до разблокировки.",
        '107' => "Отсутствует активная Viber сессия, отправка сессионного сообщения невозможна.",
        '200' => "Отсутствует или пустой параметр отправителя сообщения.",
        '201' => "Отсутствует или пустой параметр текста сообщения.",
        '202' => "Отсутствует или пустой список получателей сообщения.",
        '203' => "Не достаточно средств на балансе для создания рассылки.",
        '204' => "Отсутствуют или пустые параметры кнопки в сообщении, когда она обязательна.",
        '205' => "Отсутствует или пустой параметр текста на кнопке в сообщении.",
        '206' => "Отсутствует или пустой параметр URL адреса, куда перейдёт получатель сообщения при нажатии на кнопку.",
        '300' => "Неверный запрос, проверьте его структуру и корректность данных.",
        '301' => "Неверный токен аутентификации.",
        '302' => "Неверный отправитель сообщения.",
        '303' => "Неверная дата отложенной отправки сообщения.",
        '304' => "Недопустимое значение текста сообщения. Возвращается если передано не строковое значение или кодировка символов не входит в набор UTF-8.",
        '305' => "Недопустимый номер получателя, система не смогла распознать страну и оператора получателя.",
        '306' => "Недопустимое значение параметра ttl, значение должно быть целочисленным и не представлено в виде строки.",
        '307' => "Недопустимое значение параметра message_id, неверный формат.",
        '308' => "Недопустимое значение параметра id при вызове метода file/details, неверный формат.",
        '309' => "Недопустимое значение параметра sender_id при вызове метода chat/recipients, неверный формат.",
        '310' => "Недопустимое значение параметра chat_id при вызове методов модуля chat, неверный формат.",
        '311' => "Недопустимое значение параметра session_id при вызове метода chat/session, неверный формат.",
        '312' => "Недопустимое значение параметра пагинации page.",
        '313' => "Недопустимое значение параметра пагинации rows.",
        '400' => "Не разрешённый отправитель для текущего пользователя.",
        '401' => "Отправитель разрешён, но не активирован на данный момент (не оплачено использование в текущем месяце, не завершена регистрация и т.п.).",
        '402' => "Недопустимый тип файла изображения.",
        '403' => "Недопустимая дата отложенной отправки сообщения (выходит за пределы установленных ограничений).",
        '404' => "Номер получателя находится в стоплисте (для sms) или в игнорлисте (для Viber), отправка невозможна.",
        '405' => "Недопустимое количество получателей.",
        '406' => "Недопустимая страна получателя. У пользователя не активирована возможность отправлять сообщения получателям данной страны. Для активации такой возможности свяжитесь с нашим отделом поддержки клиентов.",
        '407' => "Получатель уже присутствует в рассылке, дубликаты игнорируются.",
        '408' => "Текст на кнопке слишком длинный, допускается не более 30 символов.",
        '409' => "Недопустимое значение параметра ttl (выходит за пределы установленных ограничений).",
        '410' => "Недопустимый контент в транзакционном сообщении. В таких сообщениях можно отправлять только текст, а кнопка и изображения запрещены.",
        '411' => "Какой-то из параметров имеет недопустимое значение, свяжитесь с нашим отделом поддержки клиентов для выяснения деталей.",
        '412' => "Текст содержит запрещённые фрагменты.",
        '413' => "Превышена допустимая длина текста сообщения.",
        '414' => "Данные сообщения с переданным message_id недоступны для текущего пользователя.",
        '415' => "Запрещено отправлять транзакционные сообщения от общего отправителя.",
        '416' => "Не найден шаблон, соответствующий переданному транзакционному сообщению.",
        '417' => "Файл с переданным id не существует или недоступен для текущего пользователя.",
        '418' => "Указанный загружаемый файл не найден или пустой.",
        '419' => "Неподдерживаемый тип файла.",
        '420' => "Размер файла превышает максимально допустимый размер 3Мб.",
        '421' => "Отправитель не поддерживает отправку сообщения указанного типа.",
        '422' => "Запрещено отправлять более 5 сессионных сообщений подряд без ответа получателя.",
        '423' => "Имя файла в Viber сообщении слишком длинное, допускается не более 25 символов.",
        '500' => "Не удалось сконвертировать данные результата в JSON формат, незамедлительно свяжитесь с нашим отделом поддержки клиентов для выяснения деталей.",
        '501' => "Не удалось сконвертировать данные результата в XML формат, незамедлительно свяжитесь с нашим отделом поддержки клиентов для выяснения деталей.",
        '502' => "Не удалось распознать тело запроса (неверный формат).",
        '503' => "Не удалось отправить SMS сообщение.",
        '504' => "Не удалось отправить Viber сообщение.",
        '505' => "Не удалось сохранить изображение.",
        '506' => "Не удалось сохранить файл.",
        '800' => "Сообщения успешно созданы и добавлены в очередь отправки. Некоторые сообщения могут попадать на предварительную модерацию.",
        '801' => "Сообщения успешно отправлены.",
        '802' => "Сообщения успешно созданы и добавлены в очередь отправки, но некоторые получатели не попали в список рассылки, детали смотрите в ответе.",
        '803' => "Сообщения успешно отправлены, но некоторые получатели не попали в список рассылки, детали смотрите в ответе.",
        '999' => "Ошибка выполнения запроса, свяжитесь с отделом поддержки для выяснения деталей.",
    ];

    protected static $UA = [
        '0' => "Запит оброблено успішно.",
        '1' => "Успішний результат виклику методу ping.",
        '103' => "Відсутній токен аутентифікації.",
        '104' => "Відсутні дані запиту.",
        '105' => "Aутентифікація не була пройдена, некоректний токен.",
        '106' => "Користувача заблоковано, робота з API недоступна до розблокування.",
        '107' => "Відсутня активна сесія Viber, надсилання сесійного повідомлення неможливе.",
        '200' => "Відсутній або пустий параметр відправника повідомлення.",
        '201' => "Відсутній або пустий параметр тексту повідомлення.",
        '202' => "Відсутній або пустий список отрмимувачів повідомлення.",
        '203' => "Недостатньо коштів на балансі для створення розсилки.",
        '204' => "Відсутні або пусті параметри кнопки в повідомленні, коли вона обов'язкова.",
        '205' => "Відсутній або пустий параметр тексту на кнопці в повідомленні.",
        '206' => "Відсутній або пустий параметр URL адреси, куди перейде отримувач, натиснувши на кнопку.",
        '300' => "Некоректний запит, перевірте його структуру і коректність даних.",
        '301' => "Некоректний токен аутентифікації.",
        '302' => "Некоректний відправник повідомлення.",
        '303' => "Некоректна дата відкладеної відправки повідомлення.",
        '304' => "Неприпустиме значення тексту повідомлення. Повертається, якщо передано не строкове значення чи кодування символів не входить в набір UTF-8.",
        '305' => "Неприпустимий номер отримувача, система не змогла розпізнати країну та оператора отримувача.",
        '306' => "Неприпустиме значення параметра ttl, значення має бути цілочисловим і передано не у вигляді строки.",
        '307' => "Неприпустиме значення параметра message_id, некоректний формат.",
        '308' => "Неприпустиме значення параметра id при визові методу file/details, некоректний формат.",
        '309' => "Неприпустиме значення параметра sender_id при визові методу chat/recipients, некоректний формат.",
        '310' => "Неприпустиме значення параметра chat_id при визові методів модуля chat, некоректний формат.",
        '311' => "Неприпустиме значення параметра session_id при визові методу chat/session, некоректний формат.",
        '312' => "Неприпустиме значення параметра пагинації page.",
        '313' => "Неприпустиме значення параметра пагинації rows.",
        '400' => "Недозволений відправник для поточного користувача.",
        '401' => "Відправник дозволений, але наразі не активований (не сплачено використання в поточному місяці, незавершена реєстрація та ін.).",
        '402' => "Неприпустимий тип файла зображення.",
        '403' => "Неприпустима дата відкладеної відпраки повідомлення (виходить за межі встановлених обмежень).",
        '404' => "Номер отримувача знаходиться в стоплісті (для sms) або в ігнорлісті (для Viber), відравка неможлива.",
        '405' => "Неприпустима кількість отримувачів.",
        '406' => "Неприпустима країна отримувача. У користувача не активована можливість відправляти повідомлення отримувачам цієї країни. Для активації такої можливості зв'яжіться з нашим відділом підтримки клієнтів.",
        '407' => "Отримувача вже включено до розсилки, дублікати ігноруються.",
        '408' => "Текст на кнопці занадто довгий, длопускаєтся не більше ніж 30 символів.",
        '409' => "Неприпустиме значення параметра ttl (виходить за межі встановлених обмежень).",
        '410' => "Неприпустимий контент в транзакційному повідомленні. В таких повідомленнях можна надсилати лише текст, а кнопка та зображення заборонені.",
        '411' => "Якийсь з параметрів має неприпустиме значення, зв'яжіться з нашим відділом підтримки клієнтів для уточнення деталей.",
        '412' => "Текст містить заборонені фрагменти.",
        '413' => "Перевищена допустима довжина тексту повідомлення.",
        '414' => "Дані повідомлення з переданим message_id недоступні для поточного користувача.",
        '415' => "Заборонено надсилати транзакційні повідомлення від загального відправника.",
        '416' => "Не знайдено шаблон, відповідний переданому транзакційному повідомленню.",
        '417' => "Файл з переданим id не існує або недоступний для поточного користувача.",
        '418' => "Зазначений завантажуваний файл не знайдений або порожній.",
        '419' => "Непідтримуваний тип файлу.",
        '420' => "Розмір файлу перевищує максимально допустимий розмір 3Мб.",
        '421' => "Відправник не підтримує відправку повідомлення вказаного типу.",
        '422' => "Заборонено надсилати більше ніж 5 сесійних повідомлень поспіль без відповіді отримувача.",
        '423' => "Ім'я файлу у Viber повідомленні занадто довге, допускається не більше 25 символів.",
        '500' => "Не вдалося зконвертувати дані результату в JSON формат, негайно зв'яжіться з нашим відділом підтримки клієнтів для уточнення деталей.",
        '501' => "Не вдалося зконвертувати дані результату в XML формат, негайно зв'яжіться з нашим відділом підтримки клієнтів для уточнення деталей.",
        '502' => "Не вдалося розпізнати тіло запиту (некоректний формат).",
        '503' => "Невдалося надіслати SMS повідомлення.",
        '504' => "Не вдалося надіслати Viber повідомлення.",
        '505' => "Не вдалося зберегти зображення.",
        '506' => "Не вдалося зберегти файл.",
        '800' => "Повідомлення успішно створені і додані в чергу на відправку. Деякі повідомлення можуть потрапляти на попередню модерацію.",
        '801' => "Повідомлення успішно надіслані.",
        '802' => "Повідомлення успішно створені і додані в чергу на відправку, однак деякі отримувачі не потрапили до списку розсилки, деталі дивіться у відповіді.",
        '803' => "Повідомлення успішно надіслані, однак деякі отримувачі не потрапили до списку розсилки, деталі дивіться у відповіді.",
        '999' => "Помилка виконання запиту, зв'яжіться з відділом підтримки для уточнення деталей."
    ];

    /**
     * @param $code
     * @return string
     * @throws \Exception
     */
    public static function getEN($code)
    {
        return self::getMessage($code, self::$EN);
    }

    /**
     * @param $code
     * @return string
     * @throws \Exception
     */
    public static function getRU($code)
    {
        return self::getMessage($code, self::$RU);
    }

    /**
     * @param $code
     * @return string
     * @throws \Exception
     */
    public static function getUA($code)
    {
        return self::getMessage($code, self::$UA);
    }

    /**
     * @param int $code
     * @param $languageArray
     * @return mixed
     * @throws \Exception
     */
    private static function getMessage($code, $languageArray)
    {
        if (!is_int($code)) {
            throw new \Exception('$code must be an integer.');
        }

        if (!isset($languageArray[$code])) {
            throw new \Exception("Error code $code not found.");
        }

        return $languageArray[$code];
    }
}