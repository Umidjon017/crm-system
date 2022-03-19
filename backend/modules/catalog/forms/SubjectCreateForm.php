<?php

namespace backend\modules\catalog\forms;

use common\models\Subject;
use common\models\SubjectPrice;
use Yii;
use yii\base\Model;

class SubjectCreateForm extends Model
{
    public $name;
    public $status;
    public $price;

    public function rules()
    {
        return [
            [['name', 'status', 'price'], 'required'],
            [['status', 'price'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function saveData()
    {
        $subjectModel = Subject::create(
            $this->name,
            $this->status
        );

        $modelPrice = SubjectPrice::create(
            $subjectModel,
            $this->price
        );

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$modelPrice->save(false)) {
                throw new \Exception('Error while saving the data!');
            }
            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
            $transaction->commit();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('ui', "Error occurred. Please, try again!") . $e->getMessage());
            $transaction->rollBack();
            throw $e;
        }
    }
}
