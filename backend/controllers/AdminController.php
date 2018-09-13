<?php

namespace backend\controllers;

use common\components\extended\Controller;
use yii;

class AdminController extends Controller
{
    /** @var string|null Если на весь контроллер применяется одно правило доступа */
    protected $accessRule = null;
    
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) return false;

        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
            return false;
        }
        if ($this->accessRule) {
            if (Yii::$app->user->can($this->accessRule)) return true;
            else throw new yii\web\ForbiddenHttpException('Access denied!');
        }
        return true;
    }
}