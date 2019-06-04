<?php
/**
 * author: crisen
 * email: crisen@crisen.org
 * date: 18-12-4
 * description:
 */


namespace Waimao\AI\Contracts;


interface  DriverInterface
{


    /**
     * choose which gateway
     * @param $name
     * @return mixed
     */
    public function gateway($name);
}
