<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-4
 * description:
 */


namespace Waimao\AI\Drivers\Baidu;


use Waimao\AI\Drivers\Baidu\Gateways\AbstractBaiduGateway;


class Speech extends AbstractBaiduGateway
{


    public function resourcePath(): array
    {
        return [
            'rest', '2.0', 'image-classify', 'v3'
        ];
    }
}
