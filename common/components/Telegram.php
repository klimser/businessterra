<?php

namespace common\components;

use common\components\telegram\Request;
use Longman\TelegramBot\TelegramLog;
use yii\base\BaseObject;
use common\components\telegram\Telegram as TelegramBot;

/**
 * @property TelegramBot $telegram
 */
class Telegram extends BaseObject
{
    protected $apiKey;
    protected $botName;
    protected $commandsPath;
    protected $apiGateway;
    protected $tablePrefix;
    protected $webhookKey;

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param mixed $botName
     */
    public function setBotName($botName)
    {
        $this->botName = $botName;
    }

    /**
     * @param mixed $commandsPath
     */
    public function setCommandsPath($commandsPath)
    {
        $this->commandsPath = $commandsPath;
    }

    /**
     * @param mixed $apiGateway
     */
    public function setApiGateway($apiGateway)
    {
        $this->apiGateway = $apiGateway;
    }

    /**
     * @param mixed $webhookKey
     */
    public function setWebhookKey($webhookKey)
    {
        $this->webhookKey = $webhookKey;
    }

    /**
     * @param mixed $tablePrefix
     */
    public function setTablePrefix($tablePrefix)
    {
        $this->tablePrefix = $tablePrefix;
    }

    private $bot;

    public function getTelegram(): TelegramBot
    {
        if ($this->bot === null) {
            $this->bot = new TelegramBot($this->apiKey, $this->botName);
            if ($this->tablePrefix) $this->bot->enableExternalMySql(\Yii::$app->db->pdo, $this->tablePrefix);
            $this->bot->addCommandsPath(\Yii::getAlias($this->commandsPath));
            if ($this->apiGateway) Request::setBaseUri($this->apiGateway);
            TelegramLog::initErrorLog(\Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_error.log');
            TelegramLog::initDebugLog(\Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_debug.log');
            TelegramLog::initUpdateLog(\Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_update.log');
        }
        return $this->bot;
    }

    public function checkAccess(\yii\web\Request $request): bool
    {
        if ($this->webhookKey) {
            return $request->getQueryParam('key') == $this->webhookKey;
        }
        return true;
    }
}