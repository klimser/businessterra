<?php

namespace common\models;

use common\components\extended\ActiveRecord;
use common\models\traits\InsertedUpdated;

/**
 * This is the model class for table "{{%email_queue}}".
 *
 * @property integer $id
 * @property string $template_html
 * @property string $template_text
 * @property string $params
 * @property string $sender
 * @property string $recipient
 * @property integer $subject
 * @property integer $state
 */
class EmailQueue extends ActiveRecord
{
    use InsertedUpdated;

    const STATUS_NEW = 0;
    const STATUS_SENDING = 1;
    const STATUS_SENT = 2;
    const STATUS_ERROR = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email_queue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_html', 'template_text', 'sender', 'recipient', 'subject'], 'required'],
            [['params'], 'string'],
            [['state'], 'integer'],
            [['template_html', 'template_text'], 'string', 'max' => 50],
            [['sender', 'recipient', 'subject'], 'string', 'max' => 255],
            ['state', 'in', 'range' => [self::STATUS_NEW, self::STATUS_SENDING, self::STATUS_SENT,self::STATUS_ERROR]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID записи',
            'template_html' => 'HTML-шаблон',
            'template_text' => 'Текстовый шаблон',
            'params' => 'Параметры для передачи в шаблон',
            'sender' => 'Отправитель',
            'recipient' => 'Получатель',
            'subject' => 'Тема',
            'state' => 'Статус отправки',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата обновления',
        ];
    }
}
