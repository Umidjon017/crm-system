<?php

namespace backend\modules\client\controllers;

use backend\modules\client\forms\ClientCreateForm;
use backend\modules\client\forms\ClientUpdateForm;
use common\components\libs\MultipleModel;
use common\models\ClientPhone;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * This is the class for controller "ClientController".
 */
class ClientController extends \backend\modules\client\controllers\base\ClientController
{
    /**
     * Creates a  new Client model.
     * Creates a  new ClientPhone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $modelClient = new ClientCreateForm;
        $modelsPhone = [new ClientPhone];
        if ($modelClient->load(Yii::$app->request->post())) {

            $modelsPhone = MultipleModel::createMultiple(ClientPhone::class);
            Model::loadMultiple($modelsPhone, Yii::$app->request->post());

//            $modelClient->saveData();
            $valid = $modelClient->validate(false);
//            $valid = Model::validateMultiple($modelsPhone) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if (  $flag = $modelClient->saveData()){
                        foreach ($modelsPhone as $modelPhone) {
                            $modelPhone->client_id = $modelClient->client_id;
                            if (!($flag = $modelPhone->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $msg = $e->errorInfo[2] ?? $e->getMessage();
                    Yii::$app->session->setFlash('error', $msg);
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelsClient' => $modelClient,
            'modelsPhone' => (empty($modelsPhone)) ? [new ClientPhone] : $modelsPhone
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
        $modelClient = $this->findModel($id);
        $form=new ClientUpdateForm($modelClient);
        $modelsPhones = $modelClient->clientPhones;

        if ($form->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPhones, 'id', 'id');
            $modelsPhones = MultipleModel::createMultiple(ClientPhone::classname(), $modelsPhones);
            Model::loadMultiple($modelsPhones, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPhones, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPhones),
                    ActiveForm::validate($form)
                );
            }

            // validate all models
            $valid = $form->validate();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $form->saveData()) {
                        if (!empty($deletedIDs)) {
                            ClientPhone::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPhones as $modelsPhone) {

                            if (!($flag = $modelsPhone->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully updated!"));
                        return $this->redirect(['index']);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelsClient' => $form,
            'modelsPhone' => (empty($modelsPhones)) ? [new ClientPhone] : $modelsPhones
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
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(['index']);
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
