<?php

namespace backend\modules\catalog\forms;

use common\models\Teacher;
use Yii;
use yii\base\Model;

class TeacherUpdateForm extends Model
{
    public $full_name;
    public $birth_date;
    public $gender;
    public $address;
    public $phone;
    public $status;

    public $photo_db;
    public $photo_file;
    public $subject_list;
    private $teacher;

    public function __construct(Teacher $teacher, $config = [])
    {
        $this->teacher = $teacher;

        $this->full_name = $teacher->full_name;
        $this->birth_date = $teacher->birth_date;
        $this->gender = $teacher->gender;
        $this->address = $teacher->address;
        $this->phone = $teacher->phone;
        $this->status = $teacher->status;
        $this->photo_db = $teacher->photo;
        $this->subject_list = $teacher->getSubjects()->select('id')->column();

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['full_name', 'gender', 'birth_date', 'phone', 'address', 'status'], 'required'],
            [['gender', 'status'], 'integer'],
            ['subject_list', 'safe'],
            [['full_name', 'phone', 'birth_date', 'address', 'photo_db'], 'string', 'max' => 255],
            [['photo_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function generatePhotoName()
    {
        return 'teacher_' . $this->teacher->id . '-' . (int)(microtime(true) * (1000)) . '.' . $this->photo_file->extension;
    }

    public function updatePhoto()
    {
        if ($this->teacher->isPhotoExists()) {
            $this->teacher->deletePhoto();
        }
        $this->uploadPhoto();
    }

    public function uploadPhoto()
    {
        if ($this->validate()) {
            $path = Teacher::getPhotoAlias();
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $photoName = $this->generatePhotoName();
            $this->photo_file->saveAs($path . $photoName);
            $this->photo_db = $photoName;
            return true;
        } else {
            return false;
        }
    }

    public function saveData()
    {
        $this->teacher->editData(
            $this->full_name,
            $this->gender,
            $this->birth_date,
            $this->phone,
            $this->photo_db,
            $this->address,
            $this->status,
        );

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->teacher->update() === false) {
                throw new \RuntimeException('Saving error!');
            }

            $this->teacher->unlinkAll('subjects', true);
            $this->teacher->addSubjects($this->subject_list);

            Yii::$app->session->setFlash('success', Yii::t('ui', "Data successfully created!"));
            $transaction->commit();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('ui', "Error occurred. Please, try again!") . $e->getMessage());
            $transaction->rollBack();
            throw $e;
        }
    }
}
