<?php

namespace backend\controllers;

use backend\controllers\traits\Active;
use common\models\Module;
use common\models\Webpage;
use yii;
use common\models\Page;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends AdminController
{
    use Active;

    protected $accessRule = 'managePages';

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find()->orderBy(['title' => SORT_ASC]),
            'pagination' => ['pageSize' => 50,],
            'sort' => [
                'defaultOrder' => ['title' => SORT_ASC],
                'attributes' => ['title'],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function actionCreate()
    {
        return $this->processPageData(new Page());
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws yii\db\Exception
     */
    public function actionUpdate($id)
    {
        return $this->processPageData($this->findModel($id));
    }

    /**
     * @param Page $page
     * @return string|yii\web\Response
     * @throws \Exception
     */
    public function processPageData(Page $page)
    {
        if (Yii::$app->request->isPost) {
            $isNew = $page->isNewRecord;
            $transaction = Page::getDb()->beginTransaction();
            try {
                if (!$page->load(Yii::$app->request->post())) \Yii::$app->session->addFlash('error', 'Form data not found');
                elseif (!$page->save()) {
                    $page->moveErrorsToFlash();
                    $transaction->rollBack();
                } else {
                    if (!$page->webpage_id) {
                        $webpage = new Webpage();
                        $webpage->module_id = Module::getModuleIdByControllerAndAction('page', 'view');
                        $webpage->record_id = $page->id;
                    } else {
                        $webpage = $page->webpage;
                    }

                    if (!$webpage->load(Yii::$app->request->post())) {
                        \Yii::$app->session->addFlash('error', 'Form data not found');
                        $transaction->rollBack();
                    } elseif (!$webpage->save()) {
                        $webpage->moveErrorsToFlash();
                        $transaction->rollBack();
                    } else {
                        if (!$page->webpage_id) $page->link('webpage', $webpage);

                        $transaction->commit();
                        Yii::$app->session->addFlash('success', $isNew ? 'Страница добавлена' : 'Страница обновлена');
                        return $this->redirect(['update', 'id' => $page->id]);
                    }
                }
            } catch(\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }

        return $this->render('update', [
            'page' => $page,
            'module' => Module::getModuleByControllerAndAction('page', 'view'),
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws yii\db\Exception
     */
    public function actionDelete($id)
    {
        $page = $this->findModel($id);
        $transaction = Page::getDb()->beginTransaction();
        try {
            if (!$page->delete()) {
                $page->moveErrorsToFlash();
                $transaction->rollBack();
            } else {
                $transaction->commit();
            }
        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->redirect(['index']);
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
