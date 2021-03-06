<?php

namespace frontend\controllers;

use common\components\extended\Controller;
use common\models\Webpage;
use common\models\Page;
use yii\base\ViewNotFoundException;
use yii\web\NotFoundHttpException;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    /**
     * Displays a single Page model.
     * @param string $id
     * @param $webpage Webpage
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id, $webpage)
    {
        $page = $this->findModel($id);
        if (!$page->isActive()) throw new NotFoundHttpException('Page is not exists');

        $params = [
            'page' => $page,
            'webpage' => $webpage,
        ];
        try {
            return $this->render('view-' . $page->id, $params);
        } catch (ViewNotFoundException $e) {
            return $this->render('view', $params);
        }
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
