<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\forms\SubjectCreateForm;
use backend\modules\catalog\forms\SubjectUpdateForm;
use Yii;
use yii\helpers\Url;

/**
 * This is the class for controller "SubjectController".
 */
class SubjectController extends \backend\modules\catalog\controllers\base\SubjectController
{
    /**
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new SubjectCreateForm;

        try {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->saveData();
                Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                return $this->redirect(['index']);
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
     * Updates an existing Subject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new SubjectUpdateForm($model);

        try {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->saveData();
                Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully updated!"));
                return $this->redirect(['index']);
            }
        } catch (\Exception $e) {
            $msg = $e->errorInfo[2] ?? $e->getMessage();
            $form->addError('_exception', $msg);
        }

        return $this->render('update', [
            'updateForm' => $form,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully deleted!"));

            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

// TODO: improve detection
        $isPivot = strstr('$id', ',');
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
