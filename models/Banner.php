<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "banners".
 *
 * @property $id int(10)
 * @property $status tinyint(1)
 * @property $position enum('top', 'bottom', 'left', 'right', 'center')
 * @property $url_link varchar(255)
 * @property $img_src varchar(50)
 * @property $to_date int(10)
 * @property $clicks int(10)
 * @property $created_at int(10)
 * @property $updated_at int(10)
 *
 */
class Banner extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;
    public $to_date_normal;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    public function behaviors() {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    public function getI18n() {
        return $this->hasOne(BannerI18n::className(), ['parent_table_id' => 'id'])
            ->where('language = :language', [':language' => Yii::$app->language]);
    }

    public function getName() {
        return $this->i18n->name;
    }

    public function getImage() {
        return $this->img_src ? $this->img_src : $this->img_src = 'no-image.png';
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            #Зберігаємо картинку
            if ($this->imageFile = UploadedFile::getInstance($this, 'imageFile')) {
                $this->saveResizeImage($this->imageFile->tempName);
            }
            #Зберігаємо картинку
            if ($insert) {
                //Yii::$app->session->setFlash('success', 'Запись добавлена!');
                $this->to_date = strtotime($this->to_date_normal);
            } else {
                //Yii::$app->session->setFlash('success', 'Запись обновлена!');
                if (!empty($this->to_date_normal)) {
                    $this->to_date = strtotime($this->to_date_normal);
                }
//                $arrTo_date_normal = explode('.', $this->to_date_normal);
//                $day = $arrTo_date_normal[0];
//                $month = $arrTo_date_normal[1];
//                $year = $arrTo_date_normal[2];
//                $this->to_date = gmmktime(0, 0, 0, $month, $day, $year);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['status', 'position', 'url_link', 'img_src', 'end_time_show', 'clicks', 'created_at', 'updated_at'], 'required'],
            [['status', 'to_date', 'clicks', 'created_at', 'updated_at'], 'integer'],
            [['position'], 'string'],
            ['position', 'in', 'range' => ['top', 'bottom', 'left', 'right', 'center']],
            [['url_link'], 'string', 'max' => 255],
            [['img_src'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, bmp', 'maxSize' => 1024 * 1024 * 1, 'maxFiles' => 1],
            [['clicks', 'created_at', 'updated_at'], 'safe'],
            [['to_date_normal'], 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('lang', 'ID'),
            'status' => Yii::t('lang', 'Status'),
            'position' => Yii::t('lang', 'Position'),
            'url_link' => Yii::t('lang', 'URL link'),
            'img_src' => Yii::t('lang', 'Img src'),
            'to_date' => Yii::t('lang', 'To date'),
            'to_date_normal' => Yii::t('lang', 'To date (normal)'),
            'clicks' => Yii::t('lang', 'Clicks'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
            //**************************************************
            'name' => Yii::t('lang', 'Name'),
            'to_date_normal_created' => Yii::t('lang', 'Created'),
        ];
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
            $dir = Yii::getAlias('uploads/banners/');
            $upload_dir_image = $dir;

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

            $upload_image = $upload_dir_image . $image_src;

            # Розмір головної картинки
            $width = Yii::$app->setting->get('BANNER.IMG_WIDTH');
            $height = Yii::$app->setting->get('BANNER.IMG_HEIGHT');

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

            # Звільняємо память
            imagedestroy($new);
            imagedestroy($image);

            $this->img_src = $image_src;

            return true;
        } else {
            return false;
        }
    }
}
