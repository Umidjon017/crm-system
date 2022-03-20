<?php

namespace backend\modules\notification\controllers;

use backend\modules\notification\forms\NotificationCreateForm;
use backend\modules\notification\forms\NotificationUpdateForm;
use Yii;

/**
* This is the class for controller "NotificationController".
*/
class NotificationController extends \backend\modules\notification\controllers\base\NotificationController
{

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new NotificationCreateForm;

        try {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->saveData();
                Yii::$app->session->setFlash('success', Yii::t('ui', 'Data successfully created!'));
                return $this->redirect(['index']);
            } elseif (!\Yii::$app->request->isPost) {
                $form->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = $e->errorInfo[2] ?? $e->getMessage();
            $form->addError('_exception', $msg);
        }
        return $this->render('create', [
            'createForm' => $form
        ]);
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new NotificationUpdateForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->saveData();
            Yii::$app->session->setFlash('success', Yii::t('ui', 'Data successfully update!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'updateForm' => $form,
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', Yii::t('ui', 'Data successfully deleted!'));
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $msg = $e->errorInfo[2] ?? $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(['index']);
        }
    }
}
