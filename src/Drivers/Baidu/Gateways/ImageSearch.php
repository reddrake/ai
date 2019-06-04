<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-4
 * description:
 */


namespace Waimao\AI\Drivers\Baidu\Gateways;


class ImageSearch extends AbstractBaiduGateway
{

    public function resourcePath(): array
    {

        return [
            'rest', '2.0', 'realtime_search'
        ];
    }


    public function headers()
    {
        return [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
    }
}
