<?php

/**
 * turbosms.ua HTTP API implementation.
 *
 * @author Anton Kalochelitis <developing.w@gmail.com>
 * @version 2.0.1
 */

namespace DevelopingW\TurboSMSua;

/**
 *
 */
class TurboSMSAPI extends TurboSMSConnect
{
    public function messageSend()
    {

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
            return $result->response_result;
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
     * @return mixed
     * @throws \Exception
     */
//    public function getUserSenders()
//    {
//        $method = '/user/senders.json';
//        $result = $this->request($method);
//        if (in_array($result->response_code == 0, $this->ok_responses)) {
//            return $result->response_result;
//        } else {
//            throw new \Exception($result->response_status);
//        }
//    }
}