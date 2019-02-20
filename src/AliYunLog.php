<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2019/2/20
 * Time: 15:49
 */

namespace AliYunLog;

use Aliyun\SLS\Client;
use Aliyun\SLS\Exception;
use Aliyun\SLS\Models\LogItem;
use Aliyun\SLS\Models\PutLogsRequest;
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

    private function client()
    {
        if (!self::$_client instanceof Client) {
            self::$_client = new Client($this->endpoint, $this->accessKeyId, $this->accessKey, $this->token);
        }
        return self::$_client;
    }


    public function putLogs($project, $logstore)
    {
        $topic = 'TestTopic';
        $contents = array(
            'TestKey' => 'TestContent'
        );
        $logItem = new LogItem();
        $logItem->setTime(time());
        $logItem->setContents($contents);
        $logitems = array($logItem);
        $request = new PutLogsRequest($project, $logstore,$topic, null, $logitems);

        try {
            $response = $this->client()->putLogs($request);
            var_dump($response);
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }


}
