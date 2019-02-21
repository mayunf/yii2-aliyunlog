<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2019/2/20
 * Time: 15:49
 */

namespace mayunfeng\AliYunLog;

use Aliyun\Log\Client;
use Aliyun\Log\Models\Request;
use yii\base\Component;

class AliYunLog extends Component
{
    public $endpoint;
    public $accessKeyId;
    public $accessKey;
    public $project;
    public $logStore;
    public $token = '';

    private static $_client;

    public function client()
    {
        if (!self::$_client instanceof Client) {
            self::$_client = new Client($this->endpoint, $this->accessKeyId, $this->accessKey, $this->token);
        }
        return self::$_client;
    }


    public function __call($method, $arguments)
    {
        if (!empty($arguments) && $arguments[0] instanceof Request) {
            return $this->client()->$method($arguments[0]);
        }

        throw new \Exception('Method `' . $method . '` not found');

    }


}
