<?php

namespace backend\modules\group\controllers;

use backend\modules\group\forms\GroupCreateForm;
use backend\modules\group\forms\GroupUpdateForm;

use common\models\search\GroupSearch;
use Yii;

/**
 * This is the class for controller "GroupController".
 */
class GroupController extends \backend\modules\group\controllers\base\GroupController
{
    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionPendingList()
    {
        $searchModel = new GroupSearch;
        $dataProvider = $searchModel->searchPending(Yii::$app->request->get());

        return $this->render('pending-list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionInProcessList()
    {
        $searchModel = new GroupSearch;
        $dataProvider = $searchModel->searchInProcess(Yii::$app->request->get());

        return $this->render('in-process-list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionFinishedList()
    {
        $searchModel = new GroupSearch;
        $dataProvider = $searchModel->searchFinished(Yii::$app->request->get());

        return $this->render('finished-list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single GroupDays model.
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new GroupCreateForm();

        try {
            if ($form->load(Yii::$app->request->post()) && $form->validate()) {
                $form->saveData();
                Yii::$app->session->setFlash('success', Yii::t('ui', 'Data successfully created!'));
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
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new GroupUpdateForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->saveData();
            Yii::$app->session->setFlash('success', Yii::t('ui', 'Data successfully updated!'));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'updateForm' => $form,
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Group model.
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
