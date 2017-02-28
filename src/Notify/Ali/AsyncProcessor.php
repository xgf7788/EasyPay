<?php
namespace EasyPay\Notify\Ali;


use EasyPay\DataManager\Ali\Data;
use EasyPay\Interfaces\AsyncNotifyProcessorInterface;

class AsyncProcessor implements AsyncNotifyProcessorInterface
{
    public function getNotify()
    {
        if (empty($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('�޷�����������');
        }

        $data = new Data($_GET);
        $data->verifySign();

        return $data;
    }

    /**
     * �첽��Ϣ�����ɹ�
     *
     * @param $result
     */
    public function success($result = null)
    {

    }

    /**
     * �첽��Ϣ����ʱ�����쳣
     *
     * @param \Exception $exception
     */
    public function fail(\Exception $exception)
    {

    }

    /**
     * ��ȡ�첽֪ͨ����Ӧ����
     *
     * @param $message
     */
    public function replyNotify($message)
    {

    }
}