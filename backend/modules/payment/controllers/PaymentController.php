<?php

namespace backend\modules\payment\controllers;

use common\models\Payment;
use common\models\search\PaymentSearch;
use dmstr\bootstrap\Tabs;
use Yii;
use yii\helpers\Url;

/**
 * This is the class for controller "PaymentController".
 */
class PaymentController extends \backend\modules\payment\controllers\base\PaymentController
{

    /**
     * Creates a new Payment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payment;

        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                return $this->redirect(['index']);
            } elseif (!Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Payment model.
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
     * Deletes an existing Payment model.
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

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIncome()
    {
        $searchModel  = new PaymentSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('income', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionOutcome()
    {
        $searchModel  = new PaymentSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('outcome', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
