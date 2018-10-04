<?php

namespace console\controllers;

use common\components\telegram\Request;
use common\models\EmailQueue;
use Longman\TelegramBot\DB;
use yii;
use yii\console\Controller;

/**
 * MailController is used to send e-mails from queue.
 */
class MailController extends Controller
{
    /**
     * Search for a not sent e-mail and sends it.
     * @return int
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function actionSend()
    {
        $condition = ['state' => EmailQueue::STATUS_NEW];
        
        $toSend = EmailQueue::findOne($condition);

        $tryTelegram = false;
        if (array_key_exists('telegramAdminNotifier', \Yii::$app->components)) {
            \Yii::$app->telegramAdminNotifier->telegram;
            $subscribed = DB::selectChats([]);
            if (!empty($subscribed)) $tryTelegram = true;
        }
        
        while ($toSend) {
            $toSend->state = EmailQueue::STATUS_SENDING;
            $toSend->save();

            $params = $toSend->params ? json_decode($toSend->params, true) : [];

            $sendEmail = true;
            if ($tryTelegram) {
                $message = null;
                switch ($toSend->template_html) {
                    case 'order-html':
                        $message = "На сайте посетитель {$params['userName']} оставил заявку на занятие \"{$params['subjectName']}\".\n"
                            . '[Обработать заявку](https://cabinet.businessterra.uz/order/index)';
                        break;
                }
                if ($message) {
                    /** @var \Longman\TelegramBot\Entities\ServerResponse[] $results */
                    $results = Request::sendToActiveChats(
                        'sendMessage',
                        ['parse_mode' => 'Markdown', 'text' => $message],
                        [
                            'groups'      => true,
                            'supergroups' => true,
                            'channels'    => false,
                            'users'       => true,
                        ]
                    );
                    foreach ($results as $result) {
                        if ($result->isOk()) {
                            $sendEmail = false;
                            $toSend->state = EmailQueue::STATUS_SENT;
                            $toSend->save();
                            break;
                        }
                    }
                }
            }

            if ($sendEmail) {
                if (Yii::$app->mailer->compose(['html' => $toSend->template_html, 'text' => $toSend->template_text], $params)
                    ->setFrom(json_decode($toSend->sender, true))
                    ->setTo(json_decode($toSend->recipient, true))
                    ->setSubject($toSend->subject)
                    ->send()
                ) $toSend->state = EmailQueue::STATUS_SENT;
                else $toSend->state = EmailQueue::STATUS_ERROR;
                $toSend->save();
            }

            $toSend = EmailQueue::findOne($condition);
        }
        return yii\console\ExitCode::OK;
    }
}