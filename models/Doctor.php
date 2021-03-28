<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "doctors".
 *
 * @property string $id
 * @property int $status
 * @property string $doctor_specialization_id
 * @property string $doctor_category_id
 * @property string $department_id
 * @property string $experience
 * @property string $email
 * @property string $phone
 * @property img_src varchar(50)
 * @property img_src_small varchar(50)
 * @property string $schedule !!!NEW
 * @property int $number_patients !!!NEW
 * @property int $allowed_number_patients !!!NEW
 * @property string $views
 * @property string $created_at
 * @property string $updated_at
 */
class Doctor extends \yii\db\ActiveRecord {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'doctors';
    }

    public function behaviors() {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public function getI18n() {
        return $this->hasOne(DoctorI18n::className(), ['parent_table_id' => 'id'])
                        ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    public function getInstitute() {
        return $this->i18n->institute;
    }

    public function getBody() {
        return $this->i18n->body;
    }

    public function getSpecialization() {
        return $this->hasOne(DoctorSpecializationI18n::className(), ['parent_table_id' => 'doctor_specialization_id'])
                ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getCategory() {
        return $this->hasOne(DoctorCategoryI18n::className(), ['parent_table_id' => 'doctor_category_id'])
                ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getDepartment() {
        return $this->hasOne(DepartmentI18n::className(), ['parent_table_id' => 'department_id'])
                ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getImage() {
        return $this->img_src ? $this->img_src : $this->img_src = 'no-image.png';
    }

    public function getImageSmall() {
        return $this->img_src_small ? $this->img_src_small : $this->img_src_small = 'no-image.png';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['status', 'doctors_specialty_id', 'docrors_categories_id', 'department_id', 'experience', 'email', 'phone', 'created_at', 'updated_at'], 'required'],
            [['status', 'doctor_specialization_id', 'doctor_category_id', 'department_id', 'experience', 'email', 'phone'], 'required'],
            [['doctor_specialization_id', 'doctor_category_id', 'department_id', 'experience', 'views', 'created_at', 'updated_at'], 'integer'],
            [['status'], 'string', 'max' => 1],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['img_src', 'img_src_small'], 'string'],
            [['schedule'], 'string', 'max' => 20],
            [['number_patients'], 'integer', 'max' => 3000],
            [['allowed_number_patients'], 'integer', 'max' => 3000],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, bmp', 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'doctor_specialization_id' => Yii::t('lang', 'Specialization'),
            'doctor_category_id' => Yii::t('lang', 'Category'),
            'department_id' => Yii::t('lang', 'Department'),
            'experience' => Yii::t('lang', 'Experience'),
            'email' => Yii::t('lang', 'Email'),
            'phone' => Yii::t('lang', 'Phone'),
            'schedule' => Yii::t('lang', 'Schedule'),
            'number_patients' => Yii::t('lang', 'Number of patients'),
            'allowed_number_patients' => Yii::t('lang', 'Allowed number of patients'),
            'views' => Yii::t('lang', 'Views'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            #************************************************
            'name' => Yii::t('lang', 'Name'),
            'institute' => Yii::t('lang', 'Institute'),
            'body' => Yii::t('lang', 'Text'),
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            #Виконувальний код
            if ($this->imageFile = UploadedFile::getInstance($this, 'imageFile')) {
                $this->saveResizeImage($this->imageFile->tempName);
            }
            #End Виконувальний код
            return true;
        }
        return false;
    }

    /**
     * Upload image
     * @param type $model
     * @param type $tempName Temp name uploda file
     * @return boolean
     */
    public function saveResizeImage($tempName) {

        $image_info = getimagesize($tempName);
        if (($image_info['mime'] == 'image/gif') || ($image_info['mime'] == 'image/jpeg') || ($image_info['mime'] == 'image/png') || ($image_info['mime'] == 'image/bmp')) {

            # Директорії для завантаження фото
            $dir = Yii::getAlias('uploads/doctor-fotos/');
            $upload_dir_image = $dir;
            $upload_dir_image_small = $dir . 'small/';

            # Встановлюємо яке буде розширення у файла - $img_ext
            switch ($image_info['mime']) {
                case 'image/bmp' : $img_ext = ".bmp";
                    break;
                case 'image/gif' : $img_ext = ".gif";
                    break;
                case 'image/jpeg': $img_ext = ".jpg";
                    break;
                case 'image/png' : $img_ext = ".png";
                    break;
            }

            # Створюємо імя для файла
            $time_random = time() . mt_rand(0000, 9999);
            $image_src = $this->id . '-' . $time_random . $img_ext;
            $image_src_small = $this->id . '-' . $time_random . '-small' . $img_ext;

            $upload_image = $upload_dir_image . $image_src;
            $upload_image_small = $upload_dir_image_small . $image_src_small;

            # Розмір головної картинки
            $width = Yii::$app->setting->get('DOCTOR_IMG_WIDTH');
            $height = Yii::$app->setting->get('DOCTOR_IMG_HEIGHT');

            # Розмір зменшеної картинки
            $width_small = Yii::$app->setting->get('DOCTOR_IMG_WIDTH_SMALL');
            $height_small = Yii::$app->setting->get('DOCTOR_IMG_HEIGHT_SMALL');

            switch ($image_info['mime']) {
                case 'image/bmp' : $image = imagecreatefromwbmp($tempName);
                    break;
                case 'image/gif' : $image = imagecreatefromgif($tempName);
                    break;
                case 'image/jpeg': $image = imagecreatefromjpeg($tempName);
                    break;
                case 'image/png' : $image = imagecreatefrompng($tempName);
                    break;
            }

            # Для $upload_image
            # Воконуємо розрахунки
            if ($image_info[0] < $width and $image_info[1] < $height) {
                //"Picture is too small!"
                return false;
            }
            $ratio = min($width / $image_info[0], $height / $image_info[1]);
            $width = $image_info[0] * $ratio;
            $height = $image_info[1] * $ratio;
            $x = 0;

            $new = imagecreatetruecolor($width, $height);

            if ($image_info['mime'] == "image/gif" or $image_info['mime'] == "image/png") {
                imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
                imagealphablending($new, false);
                imagesavealpha($new, true);
            }

            imagecopyresampled($new, $image, 0, 0, $x, 0, $width, $height, $image_info[0], $image_info[1]);

            switch ($image_info['mime']) {
                case 'image/bmp' : imagewbmp($new, $upload_image);
                    break;
                case 'image/gif' : imagegif($new, $upload_image);
                    break;
                case 'image/jpeg': imagejpeg($new, $upload_image);
                    break;
                case 'image/png' : imagepng($new, $upload_image);
                    break;
            }

            # Тепер для $upload_image_small
            # Воконуємо розрахунки
            $ratio = min($width_small / $image_info[0], $height_small / $image_info[1]);
            $width_small = $image_info[0] * $ratio;
            $height_small = $image_info[1] * $ratio;
            $x = 0;

            # Звільняємо память
            imagedestroy($new);

            $new = imagecreatetruecolor($width_small, $height_small);

            if ($image_info['mime'] == "image/gif" or $image_info['mime'] == "image/png") {
                imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
                imagealphablending($new, false);
                imagesavealpha($new, true);
            }

            imagecopyresampled($new, $image, 0, 0, $x, 0, $width_small, $height_small, $image_info[0], $image_info[1]);

            switch ($image_info['mime']) {
                case 'image/bmp' : imagewbmp($new, $upload_image_small);
                    break;
                case 'image/gif' : imagegif($new, $upload_image_small);
                    break;
                case 'image/jpeg': imagejpeg($new, $upload_image_small);
                    break;
                case 'image/png' : imagepng($new, $upload_image_small);
                    break;
            }

            # Звільняємо память
            imagedestroy($new);
            imagedestroy($image);

            $this->img_src = $image_src;
            $this->img_src_small = $image_src_small;

            return true;
        } else {
            return false;
        }
    }

}
