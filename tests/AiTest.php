<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-4
 * description:
 */


namespace Waimao\AI\Tests;


use Waimao\AI\AI;
use Waimao\AI\Contracts\DriverInterface;


class AITest extends TestCase
{

    public function testDriver()
    {
        $default = require __DIR__ . '/config/config.php';
        $config = $default['baidu'];
        $ai = new AI($config);
        $this->assertInstanceOf(AI::class, $ai);
        $ai = AI::baidu($config);
        $this->assertInstanceOf(DriverInterface::class, $ai);
        $config = $default['tencent'];
        $ai = AI::tencent($config);
        $this->assertInstanceOf(DriverInterface::class, $ai);
    }
}
