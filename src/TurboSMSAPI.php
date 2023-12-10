<?php

/**
 * turbosms.ua HTTP API implementation.
 *
 * @author Anton Kalochelitis <developing.w@gmail.com>
 * @version 2.0.1
 */

namespace DevelopingW\TurboSMSua;

/**
 * Class TurboSMSAPI
 */
class TurboSMSAPI extends TurboSMSConnect
{
    /**
     * @param string $apiKey
     * @throws \Exception
     */
    public function __construct($apiKey = '')
    {
        parent::__construct($apiKey);
    }

    /**
     * Send SMS
     *
     * @param string $num
     * @param string $text
     * @param string $sender
     * @param string $senderViber
     * @return mixed
     * @throws \Exception
     */
    public function messageSend($num, $text, $sender = 'MAGAZIN', $senderViber = '')
    {
        if (empty($num)) {
            throw new \LengthException('Number must be a string or array of strings');
        }

        if (empty($text)) {
            throw new \LengthException('Text is empty');
        }

        if (empty($sender)) {
            throw new \LengthException('Sender name is empty');
        }

        if (!(is_string($num) || is_array($num))) {
            throw new \Exception('$num must be string or array');
        }

        if (!is_string($text)) {
            throw new \Exception('$text not string');
        }

        if (!is_string($sender)) {
            throw new \Exception('$sender not string');
        }

        if (!is_string($senderViber)) {
            throw new \Exception('$senderViber not string');
        }

        $method = '/message/send.json';
        $data = [];

        if (is_array($num)) {
            $data['recipients'] = $this->phoneFormat($num);
        } else {
            $data['recipients'][] = $this->phoneFormat($num);
        }

        if ($this->start_time) {
            $data['start_time'] = $this->start_time;
        }

        if ($this->currentMode == 'sms' || $this->currentMode == 'hybrid') {
            $data['sms'] = [
                'sender' => $sender,
                'text' => $text,
                'is_flash' => ((!empty($this->is_flash)) ? $this->is_flash : '')
            ];
        }
        if ($this->currentMode == 'viber' || $this->currentMode == 'hybrid') {
            $data['viber'] = [
                'sender' => empty($senderViber) ? $sender : $senderViber,
                'text' => $text
            ];

            if ($this->ttl) {
                $data['viber']['ttl'] = $this->ttl;
            }

            if ($this->image_url) {
                $data['viber']['image_url'] = $this->image_url;
            }

            if ($this->caption) {
                $data['viber']['caption'] = $this->caption;
            }

            if ($this->action) {
                $data['viber']['action'] = $this->action;
            }

            if ($this->file_id) {
                $data['viber']['file_id'] = $this->file_id;
            }

            if ($this->count_clicks) {
                $data['viber']['count_clicks'] = $this->count_clicks;
            }

            if ($this->is_transactional) {
                $data['viber']['is_transactional'] = $this->is_transactional;
            }
        }

        $result = $this->request($method, $data);
        if (in_array($result->response_code == 0, $this->ok_responses)) {
            return (array)$result->response_result;
        } else {
            throw new \Exception($result->response_status);
        }
    }

    public function messageSendMulti()
    {

    }

    public function messageStatus()
    {

    }

    public function chatSenders()
    {

    }

    public function chatRecipients()
    {

    }

    public function chatSessions()
    {

    }

    public function chatMessages()
    {

    }

    public function chatSend()
    {

    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUserBalance()
    {
        $method = '/user/balance.json';
        $result = $this->request($method);
        if (in_array($result->response_code == 0, $this->ok_responses)) {
            return (array)$result->response_result;
        } else {
            throw new \Exception($result->response_status);
        }
    }

    public function fileAdd()
    {

    }

    public function fileDetails()
    {

    }

    /**
     * @return array
     */
    public function getDefaultSenders()
    {
        return [
            'TAXI',
            'SERVIS TAXI',
            'Dostavka24',
            'MAGAZIN',
            'IT Alarm',
            'AKCIYA',
            'BEAUTY',
            'Best-Shop',
            'BonusShop',
        ];
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getUserSenders()
    {
        $method = '/user/senders.json';
        $result = $this->request($method);
        if (in_array($result->response_code == 0, $this->ok_responses)) {
            return (array)$result->response_result;
        } else {
            throw new \Exception($result->response_status);
        }
    }
}