<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['username', 'password'], 'filter', 'filter' => 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('lang', 'Username'),
            'password' => Yii::t('lang', 'Password'),
            'rememberMe' => Yii::t('lang', 'Remember Me'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('lang', 'Incorrect username or password.'));
                # Фіксуємо хибні паролі
                if (!empty($user)) {
                    $wrong_logins = (int) substr($user->wrong_logins, 0, 1);
                    if ($wrong_logins < 9) {
                        $user->wrong_logins = $wrong_logins + 1;
                        $user->wrong_logins = $user->wrong_logins . '_' . time();
                    } else {
                        $user->wrong_logins = $wrong_logins . '_' . time();
                        Yii::$app->session->setFlash('error', Yii::t('lang', 'Sign in is temporarily blocked, please try later!!!'));
                    }
                    $user->detachBehavior('TimestampBehavior');
                    $user->save(false);
                }
                #END Фіксуємо хибні паролі
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {

            if (!empty($this->getUser()->wrong_logins) && ((int) substr($this->getUser()->wrong_logins, 0, 1)) < 9) {
                $this->getUser()->wrong_logins = '';
            }

            if (!empty($this->getUser()->wrong_logins) && ((int) substr($this->getUser()->wrong_logins, 0, 1)) == 9) {
                $timestamp_wrong_logins = (int) substr($this->getUser()->wrong_logins, strrpos($this->getUser()->wrong_logins, '_') + 1);
                $expire = (int) Yii::$app->setting->get('USER.PASSWORD_WRONG_EXPIRE');
                if (($timestamp_wrong_logins + $expire) <= time()) {
                    $this->getUser()->wrong_logins = '';
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('lang', 'Sign in is temporarily blocked, please try later!!!'));
                    return false;
                }
            }

            # Мій код для генерації auth_key, в новій версії Yii2 (2.0.13.1) можна відключити
            if ($this->rememberMe) {
                $this->getUser()->generateAuthKey();
                //$this->getUser()->save();
            }# End мій код

            $this->getUser()->last_ip = $this->getUser()->ip;
            $this->getUser()->ip = Yii::$app->request->userIP;
            $this->getUser()->detachBehavior('TimestampBehavior');
            $this->getUser()->save();

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
