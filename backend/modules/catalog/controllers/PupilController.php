<?php

namespace backend\modules\catalog\controllers;

use common\models\Pupil;
use common\models\search\PupilSearch;
use Yii;

/**
 * This is the class for controller "PupilController".
 */
class PupilController extends \backend\modules\catalog\controllers\base\PupilController
{
    /**
     * Lists all Pupil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PupilSearch;
        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Pupil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pupil;

        try {
            if ($model->load($_POST) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                return $this->redirect(['index']);
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Pupil model.
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
     * Deletes an existing Pupil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully deleted!"));
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(['index']);
        }
    }
}
