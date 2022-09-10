<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Users model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_DOCTOR = 3;
    const ROLE_LABORANT = 4;
    const ROLE_GUEST = 5;

    public $password;
    public $new_password;


    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],

            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_USER, self::ROLE_DOCTOR, self::ROLE_LABORANT, self::ROLE_GUEST]],

            [['username', 'password_hash'], 'required'],
            //[['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            ['username', 'unique'],
            ['email', 'email'],
            [['username', 'email'], 'trim'],

            //['password', 'required'],
            [['password', 'new_password'], 'filter', 'filter' => 'trim'],
            [['password', 'new_password'], 'string', 'min' => 8, 'max' => 100],

            [['ip', 'last_ip'], 'default', 'value' => '0.0.0.0'],
            [['ip', 'last_ip'], 'ip', 'expandIPv6' => true],

            ['wrong_logins', 'string', 'max' => 12],
            [['created_at', 'updated_at', 'wrong_logins'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('lang', 'ID'),
            'username' => Yii::t('lang', 'Username'),
            'password_hash' => Yii::t('lang', 'Password Hash'),
            'auth_key' => Yii::t('lang', 'Auth Key'),
            //'password_reset_token' => Yii::t('lang', 'Password Reset Token'),
            'email' => Yii::t('lang', 'E-mail'),
            'status' => Yii::t('lang', 'Status'),
            'role' => Yii::t('lang', 'Role'),
            'ip' => Yii::t('lang', 'IP'),
            'last_ip' => Yii::t('lang', 'Last IP'),
            'created_at' => Yii::t('lang', 'Created'),
            'updated_at' => Yii::t('lang', 'Updated'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        //$expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $expire = Yii::$app->setting->get('USER.PASSWORD_RESET_TOKEN_EXPIRE');
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
    */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
    */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
    */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    /**
     * Сheck is Admin
    */
    public function isAdmin() {
        return $this->role == self::ROLE_ADMIN ? true : false;
    }

    /**
     * Сheck is Doctor
    */
    public function isDoctor() {
        return $this->role == self::ROLE_DOCTOR ? true : false;
    }

    /**
     * Сheck is Laborant
    */
    public function isLaborant() {
        return $this->role == self::ROLE_LABORANT ? true : false;
    }

}