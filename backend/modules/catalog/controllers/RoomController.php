<?php

namespace backend\modules\catalog\controllers;

use common\models\Room;
use common\models\search\RoomSearch;
use dmstr\bootstrap\Tabs;
use Yii;
use yii\helpers\Url;

/**
 * This is the class for controller "RoomController".
 */
class RoomController extends \backend\modules\catalog\controllers\base\RoomController
{
    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new RoomSearch;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Room;

        try {
            if ($model->load($_POST) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                return $this->redirect(['index', 'id' => $model->id]);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully updated!"));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully deleted!"));
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(['index']);
        }

// TODO: improve detection
        $isPivot = strstr('$id',',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['index']);
        }
    }
}
