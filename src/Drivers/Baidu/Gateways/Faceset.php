<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-6
 * description:
 */


namespace Waimao\AI\Drivers\Baidu\Gateways;


class Faceset extends AbstractBaiduGateway
{

    protected $image;
    protected $imageType;

    /**
     * @return array
     */
    public function resourcePath(): array
    {
        return [
            'rest', '2.0', 'face', 'v3', 'faceset', 'face'
        ];
    }


    /**
     * 获取用户人脸列表
     * @param array $options
     * @return array
     * @throws \Waimao\AI\Exceptions\Exception
     */
    public function get($options = [])
    {
        return $this->send('getlist', $options);
    }

    /**
     * 人脸删除
     * @param array $options
     * @return array
     * @throws \Waimao\AI\Exceptions\Exception
     */
    public function delete($options = [])
    {
        return $this->send('delete', $options);
    }
}
