<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-17
 * description:
 */

namespace Waimao\AI\Drivers\Tencent\Gateways;


use Waimao\AI\Client;
use Waimao\AI\Drivers\Tencent\Tencent;
use Waimao\AI\Drivers\Tencent\TencentResponse;
use Waimao\AI\Exceptions\Exception;

abstract class AbstractTencentGateway
{

    protected $client;
    protected $baseUrl = 'https://api.ai.qq.com/fcgi-bin';
    protected $driver;
    protected $params = [];


    public function __construct(Tencent $driver)
    {
        $this->client = new Client();
        $this->driver = $driver;
    }

    /**
     * 所有的路由都需要指定资源路径
     * @return array
     */
    abstract protected function resourcePath(): array;

    /**
     * @param $code
     * @return $this
     */
    public function base64($code)
    {
        $this->params['image'] = $code;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function url($url)
    {
        $content = file_get_contents($url);
        $this->params['image'] = base64_encode($content);
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function path($path)
    {
        $content = file_get_contents($path);
        $this->params['image'] = base64_encode($content);
        return $this;
    }


    /**
     * @param $action
     * @return string
     */
    protected function buildUrl($action): string
    {
        $uri = [];
        array_push($uri, $this->baseUrl);
        $uri = array_merge($uri, $this->resourcePath());
        array_push($uri, $action);
        return implode('/', $uri);
    }


    /**
     * @param array $res
     * @return TencentResponse
     */
    public function response($res = [])
    {
        return new TencentResponse(json_decode($res['content'], true));
    }

    /**
     * @param $action
     * @param array $options
     * @return TencentResponse
     * @throws Exception
     */
    public function send($action, $options = [])
    {
        $this->setAppId();
        $this->setTimeStamp();
        $this->setNonceStr();
        $data = array_merge($this->params, $options);
        $data['sign'] = $this->sign($data);
        $response = $this->client->post($this->buildUrl($action), $data);
        return $this->response($response);
    }


    private function setAppId()
    {
        $this->params['app_id'] = $this->driver->getAppId();
    }

    private function setTimeStamp()
    {
        $this->params['time_stamp'] = time();
    }

    private function setNonceStr()
    {
        $this->params['nonce_str'] = $this->driver->genNonceStr();
    }

    private function sign($data)
    {
        return $this->driver->sign($data);
    }
}
