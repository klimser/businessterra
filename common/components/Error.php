<?php

namespace common\components;

use yii\base\Component;

class Error extends Component
{
    /**
     * @param string $module
     * @param string|mixed $content
     * @param bool $notifyAdmin
     * @return bool
     */
    public function logError($module, $content, bool $notifyAdmin = false)
    {
        if (!is_string($content)) $content = print_r($content, true);
        $error = new \common\models\Error();
        $error->module = $module;
        $error->content = $content;
        $result = $error->save();
        if ($result && $notifyAdmin) {
            \Yii::$app->mailQueue->add('Error occured on 5plus.uz website', \Yii::$app->params['adminEmail'], 'error-html', 'error-text', ['module' => $module, 'errorText' => $content]);
        }
        return $result;
    }
}