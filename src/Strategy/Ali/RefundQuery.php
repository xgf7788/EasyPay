<?php
namespace EasyPay\Strategy\Ali;


use Ant\Support\Arr;
use EasyPay\Exception\PayParamException;

/**
 * 支付宝退款查询功能
 *
 * Class RefundQuery
 * @package EasyPay\Strategy\Ali
 */
class RefundQuery extends BaseAliStrategy
{
    /**
     * {@inheritDoc}
     */
    protected function buildData()
    {
        if (!$this->payData['out_trade_no'] && !$this->payData['trade_no']) {
            throw new PayParamException("缺少订单号");
        }

        return parent::buildData();
    }

    /**
     * {@inheritDoc}
     */
    protected function getMethod()
    {
        return BaseAliStrategy::REFUND_QUERY;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequireParams()
    {
        return ['app_id','out_request_no'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getFillParams()
    {
        return [
            'app_id', 'method', 'format', 'charset', 'sign_type', 'sign',
            'timestamp', 'version', 'app_auth_token', 'biz_content'
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function buildBinContent()
    {
        $data = [
            // 商户唯一订单号
            'out_trade_no'          =>  $this->payData['out_trade_no'],
            // 支付宝唯一订单号
            'trade_no'              =>  $this->payData['trade_no'],
            // 标识一次退款请求
            'out_request_no'        =>  $this->payData['out_request_no'],
        ];

        Arr::removalEmpty($data);

        return $data;
    }
}