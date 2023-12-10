<?php

/**
 * turbosms.ua HTTP API implementation.
 *
 * @author Anton Kalochelitis <developing.w@gmail.com>
 * @version 2.0.1
 */

namespace DevelopingW\TurboSMSua;

/**
 * Class TurboSMSConnect
 */
class TurboSMSConnect
{
    protected $apiKey;
    protected static $apiUrl = 'https://api.turbosms.ua';
    protected $connectionType = 'curl';
    protected static $mods = ['sms', 'viber', 'hybrid'];
    protected $currentMode = 'sms';
    protected $start_time;
    protected $is_flash;
    protected $ttl;
    protected $image_url;
    protected $caption;
    protected $action;
    protected $file_id;
    protected $count_clicks;
    protected $is_transactional;
    protected $ok_responses = [0, 1, 800, 801, 802, 803];

    /**
     * @param string $apiKey
     * @throws \Exception
     */
    public function __construct($apiKey = '')
    {
        if (!is_string($apiKey)) {
            throw new \Exception('$apiKey not string');
        }

        if (!empty($apiKey)) {
            return $this->setApiKey($apiKey);
        } else {
            throw new \Exception('API key is empty!');
        }
    }

    /**
     * @param string $mode
     * @return $this
     * @throws \Exception
     */
    public function setMode($mode)
    {
        if (!is_string($mode)) {
            throw new \Exception('$mode not string');
        }

        if (!in_array($mode, self::$mods)) {
            throw new \Exception('Unknown send mode');
        }
        $this->currentMode = $mode;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     * @throws \Exception
     */
    protected function setApiKey($key)
    {
        if (!is_string($key)) {
            throw new \Exception('$key not string');
        }

        $this->apiKey = $key;

        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setStartTime(\DateTime $start_time)
    {
        $current_date = new \DateTime();
        if ($current_date > $start_time) {
            throw new \OutOfRangeException('Start date is in the past!');
        }

        if ($current_date->diff($start_time)->days > 14) {
            throw new \OutOfRangeException('Maximum scheduled date is no more 14 days from current date!');
        }

        $this->start_time = $start_time->format('Y-m-d H:i:s');

        return $this;
    }

    /**
     * Use for SMS message
     *
     * @param int $is_flash
     * @return $this
     * @throws \Exception
     */
    public function setIsFlash($is_flash = 1)
    {
        if (!is_int($is_flash)) {
            throw new \Exception('$mode not int');
        }

        $this->is_flash = $is_flash;

        return $this;
    }

    /**
     * Use for Viber message. Default value 3600 sec MIN - 60 MAX - 86400
     * @param int $ttl
     * @return $this
     * @throws \Exception
     */
    public function setTTL($ttl)
    {
        if (!is_int($ttl)) {
            throw new \Exception('$ttl not int');
        }

        if ($ttl < 60 || $ttl > 86400) {
            throw new \OutOfRangeException('TTL is out of range. Min = 60, Max = 86400');
        }

        $this->ttl = $ttl;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param $image_url
     * @return $this
     * @throws \Exception
     */
    public function setImage($image_url)
    {
        if (!is_string($image_url)) {
            throw new \Exception('$image_url not string');
        }
        $this->image_url = $image_url;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param string $caption
     * @return $this
     * @throws \Exception
     */
    public function setCaption($caption)
    {
        if (!is_string($caption)) {
            throw new \Exception('$caption not string');
        }
        $this->caption = $caption;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param string $action
     * @return $this
     * @throws \Exception
     */
    public function setAction($action)
    {
        if (!is_string($action)) {
            throw new \Exception('$caption not string');
        }
        $this->action = $action;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param int $file_id
     * @return $this
     * @throws \Exception
     */
    public function setFileId($file_id)
    {
        if (!is_int($file_id)) {
            throw new \Exception('$file_id not string');
        }
        $this->file_id = $file_id;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param int $count
     * @return $this
     * @throws \Exception
     */
    public function countClicks($count = 1)
    {
        if (!is_int($count)) {
            throw new \Exception('$count not string');
        }
        $this->count_clicks = $count;

        return $this;
    }

    /**
     * Use for Viber message
     *
     * @param int $trans
     * @return $this
     * @throws \Exception
     */
    public function isTransactional($trans = 1)
    {
        if (!is_int($trans)) {
            throw new \Exception('$trans not string');
        }
        $this->is_transactional = $trans;

        return $this;
    }

    public function setConnectionType($connectionType)
    {
        if (!is_string($connectionType)) {
            throw new \Exception('$connectionType not string');
        }

        $this->connectionType = $connectionType;

        return $this;
    }

    protected function getConnectionType()
    {
        return $this->connectionType;
    }

    /**
     * @param int $file_id id from uploadFile method
     *
     * @return mixed
     * @throws \Exception
     */
    public function getFileDetails($file_id)
    {
        if (!is_int($file_id)) {
            throw new \Exception('$num not int');
        }

        $method = '/file/details.json';
        $data = ['id' => $file_id];
        $result = $this->request($method, $data);

        if (in_array($result->response_code == 0, $this->ok_responses)) {
            return $result->response_result;
        } else {
            throw new \Exception($result->response_status);
        }
    }

    /**
     * @param string $file
     *
     * @return mixed
     * @throws \Exception
     */
    public function uploadFile($file)
    {
        if (!is_string($file)) {
            throw new \Exception('$file not string');
        }

        $method = '/file/add.json';
        if (base64_encode(base64_decode($file, true)) === $file) {
            $data = ['data' => $file];
        } else {
            $data = ['url' => $file];
        }

        $result = $this->request($method, $data);
        if (in_array($result->response_code == 0, $this->ok_responses)) {
            return $result->response_result;
        } else {
            throw new \Exception($result->response_status);
        }
    }

    protected function request($method, $params = null)
    {
        if (!is_string($method)) {
            throw new \Exception('$method not string');
        }

        $post = $params
            ? json_encode($params)
            : '';

        $header = [
            'Authorization: Basic ' . $this->getApiKey(),
            'Content-Type: application/json',
        ];

        $url = self::$apiUrl . $method;

        if ('curl' == $this->getConnectionType()) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $context = [
                'http' => [
                    'method' => count($params) ? "POST" : "GET",
                    'header' => implode("\r\n", $header),
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                    'content' => ((!empty($post)) ? $post : ''),
                ],
            ];

            $result = file_get_contents($url, false, stream_context_create($context));
        }

        return json_decode($result);
    }

    protected function phoneFormat($phone, $mask = '#', $codeSplitter = '0')
    {
        $format = array(
            '12' => '############', // for +38 0XX XX XXX XX or 38 0XX XX XXX XX
            '10' => '38##########' // for 0XX XX XXX XX
        );
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = substr($phone, strpos($phone, $codeSplitter));

        if (array_key_exists(strlen($phone), $format)) {
            $format = $format[strlen($phone)];
        } else {
            return $phone;
        }

        $pattern = '/' . str_repeat('([0-9])?', substr_count($format, $mask)) . '(.*)/';

        $format = preg_replace_callback(
            str_replace('#', $mask, '/([#])/'),
            function () use (&$counter) {
                return '${' . (++$counter) . '}';
            },
            $format
        );

        return ($phone) ? trim(preg_replace($pattern, $format, $phone, 1)) : false;
    }
}