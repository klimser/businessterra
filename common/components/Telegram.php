<?php

namespace common\components;

use Longman\TelegramBot\TelegramLog;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Yii;
use yii\base\BaseObject;
use Longman\TelegramBot\Telegram as TelegramBot;
use yii\web\Request;

/**
 * @property TelegramBot|null $telegram
 */
class Telegram extends BaseObject
{
    private ?TelegramBot $bot = null;
    protected string $apiKey;
    protected string $botName;
    protected string $commandsPath;
    protected string $tablePrefix = '';
    protected string $webhookKey;

    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function setBotName(string $botName)
    {
        $this->botName = $botName;
    }

    public function setCommandsPath(string $commandsPath)
    {
        $this->commandsPath = $commandsPath;
    }

    public function setApiGateway(string $apiGateway)
    {
        $this->apiGateway = $apiGateway;
    }

    public function setWebhookKey(string $webhookKey)
    {
        $this->webhookKey = $webhookKey;
    }

    public function setTablePrefix(string $tablePrefix)
    {
        $this->tablePrefix = $tablePrefix;
    }

    public function initBot(): void
    {
        if ($this->bot === null) {
            $this->bot = new TelegramBot($this->apiKey, $this->botName);
            if ($this->tablePrefix) $this->bot->enableExternalMySql(Yii::$app->db->pdo, $this->tablePrefix);
            $this->bot->addCommandsPath(Yii::getAlias($this->commandsPath));
            $errorLogger = (new StreamHandler(Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_error.log', Logger::ERROR))
                ->setFormatter(new LineFormatter(null, null, true));

            if (YII_ENV === 'dev') {
                TelegramLog::initialize(
                    new Logger('telegram_bot_' . $this->botName, [
                        (new StreamHandler(Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_debug.log', Logger::DEBUG))
                            ->setFormatter(new LineFormatter(null, null, true)),
                        $errorLogger,
                    ]),
                    new Logger('telegram_bot_updates', [
                        (new StreamHandler(Yii::getAlias('@runtime/telegram') . '/' . $this->botName . '_update.log', Logger::INFO))
                            ->setFormatter(new LineFormatter('%message%' . PHP_EOL)),
                    ])
                );
            } else {
                TelegramLog::initialize(new Logger('telegram_bot_' . $this->botName, [$errorLogger]));
            }
        }
    }

    public function getTelegram(): TelegramBot
    {
        $this->initBot();
        return $this->bot;
    }

    public function checkAccess(Request $request): bool
    {
        if ($this->webhookKey) {
            return $request->getQueryParam('key') == $this->webhookKey;
        }
        return true;
    }
}
