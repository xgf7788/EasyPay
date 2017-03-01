<?php
namespace EasyPay\Strategy\Ali;

use Ant\Support\Arr;

/**
 * Class QrPay
 * @package EasyPay\Strategy\Ali
 */
class QrPay extends BaseAliStrategy
{
    /**
     * {@inheritDoc}
     */
    protected function getMethod()
    {
        return BaseAliStrategy::QR_PAY;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequireParamsList()
    {
        return ['app_id','subject','out_trade_no','total_amount'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getApiParamsList()
    {
        return [
            'app_id','method','format','charset','sign_type','sign',
            'timestamp','version','notify_url','app_auth_token','biz_content'
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function buildBinContent()
    {
        $data = [
            // 唯一订单号
            'out_trade_no'          =>  $this->payData['out_trade_no'],
            // 收款支付宝用户ID
            'seller_id'             =>  $this->payData['seller_id'],
            // 交易金额,单位为元,精确到分
            'total_amount'          =>  $this->payData['total_amount'],
            // 可打折金额. 参与优惠计算的金额，单位为元
            'discountable_amount'   =>  $this->payData['discountable_amount'],
            // 不可打折金额. 不参与优惠计算的金额，单位为元
            'undiscountable_amount' =>  $this->payData['undiscountable_amount'],
            // 买家支付宝账号
            'buyer_logon_id'        =>  $this->payData['buyer_logon_id'],
            // 商品的标题
            'subject'               =>  $this->payData['subject'],
            // 交易的具体描述信息
            'body'                  =>  $this->payData['body'],
            // 业务扩展参数(详细参数参考支付宝文档)
            'extend_params'         =>  $this->payData['extend_params'],
            // 订单过期时间
            'timeout_express'       =>  $this->payData['timeout_express'],
            // 描述分账信息(详细参数参考支付宝文档)
            'royalty_info'          =>  $this->payData['royalty_info'],
            // 二级商户信息(详细参数参考支付宝文档)
            'sub_merchant'          =>  $this->payData['sub_merchant'],
            // 支付宝店铺的门店ID
            'alipay_store_id'       =>  $this->payData['alipay_store_id'],
        ];

        Arr::removalEmpty($data);

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    protected function handleData($data)
    {
        return parent::handleData($data)['qr_code'];
    }
}