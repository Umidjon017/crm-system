<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\forms\TeacherCreateForm;
use backend\modules\catalog\forms\TeacherUpdateForm;
use common\models\search\TeacherSearch;
use common\models\Teacher;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the class for controller "TeacherController".
 */
class TeacherController extends \backend\modules\catalog\controllers\base\TeacherController
{
    /**
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch;
        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new TeacherCreateForm;

        try {
            if ($form->load(Yii::$app->request->post())) {
                $form->photoFile = UploadedFile::getInstance($form, 'photoFile');
                if ($form->validate()) {
                    $form->uploadPhoto();
                    $form->saveData();
                    Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
                    return $this->redirect(['index']);
                } elseif (!Yii::$app->request->isPost) {
                    $form->load($_GET);
                }
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
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new TeacherUpdateForm($model);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->photo_file = UploadedFile::getInstance($form, 'photo_file');

            if ($form->photo_file !== null) {
                $form->updatePhoto();
            }

            $form->saveData();
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully updated!"));
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'teacherModel' => $model,
                'updateForm' => $form
            ]);
        }

    }

    /**
     * Displays a single Teacher model.
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
     * Deletes an existing Teacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try {
            $model->delete();
            $model->deletePhoto();
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully deleted!"));
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

    }
}
