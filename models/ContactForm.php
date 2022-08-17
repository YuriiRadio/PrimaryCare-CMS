<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model {

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $ip;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['body'], 'string', 'max' => 1024],
            // email has to be a valid email address
            ['email', 'email'],
            [['email', 'name', 'subject', 'body'], 'filter', 'filter' => 'trim'],
            ['body', 'validateBody'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['ip', 'ip'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'name' => Yii::t('lang', 'Name'),
            'email' => Yii::t('lang', 'E-mail'),
            'subject' => Yii::t('lang', 'Subject'),
            'body' => Yii::t('lang', 'Your message'),
            'verifyCode' => Yii::t('lang', 'Verification Code'),
            'ip' => Yii::t('lang', 'IP address')
        ];
    }

    public function validateBody($attribute, $params, $validator) {
        $pattern = "#porno|sex|penis|vagina|pussy|xxx#im";
        if (preg_match($pattern, $this->$attribute)) {
            $this->addError($attribute, Yii::t('lang', 'You have used prohibited words.'));
        }

        $pattern = "#ы|э#im";
        if (preg_match($pattern, $this->$attribute)) {
            $this->addError($attribute, 'Ruzke GO TO HU*.');
        }
    }

    public function contactEmail($email) {

        $arrEmail = explode(',', $email);
        $arrEmail = array_map('trim', $arrEmail);

        $subject = '';
        switch (safeString($this->subject)) {
            case 0:
                $subject = Yii::t('lang', 'Proposal');
                break;
            case 1:
                $subject = Yii::t('lang', 'Question');
                break;
            case 2:
                $subject = Yii::t('lang', 'Complaint');
                break;
            case 3:
                $subject = Yii::t('lang', 'Invoice / account');
                break;
            case 4:
                $subject = Yii::t('lang', 'Other...');
                break;
            default :
                $subject = Yii::t('lang', 'Other...');
        }
        //$test = \yii\helpers\StringHelper::truncateHtml("<html>");
        //$subject = $subject. '-'. Yii::$app->name;
        $from = 'site-robot@' . preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo());
        return Yii::$app->mailer
                ->compose(
                    ['html' => 'contactForm-html'],
                    [
                        'ip' => $this->ip,
                        'name' => safeString($this->name),
                        'email' => $this->email,
                        'body' => safeString($this->body),
                    ]
                )
                ->setTo($arrEmail)
                ->setFrom([$from => 'Site Robot - ' . preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo())])
                ->setSubject($subject)
                ->send();
    }

}