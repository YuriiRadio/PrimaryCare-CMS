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

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
//    public function contactEmail($email) {
////        $sender_info = '<br /><br /><hr />'
////                    . Yii::t('lang','Message from site').': '
////                    . '<a href="' . Yii::$app->urlManager->createAbsoluteUrl(['site/contact']) . '">'
////                        .Yii::$app->urlManager->createAbsoluteUrl(['site/contact'])
////                    . "<a>" . "<br />"
////                    . Yii::t('lang','Sender IP address').': <b>'.$this->ip.'</b>';
//        //$test = \yii\helpers\StringHelper::truncateHtml("<html>");
//        return Yii::$app->mailer
//            ->compose(
//                    ['html' => 'contactForm-html'],
//                    ['ip' => $this->ip, 'body' => safeString($this->body)]
//            )
//            ->setTo($email)
//            ->setFrom([$this->email => safeString($this->name)])
//            ->setSubject(safeString($this->subject))
//            //->setTextBody($this->body.$sender_info)
//            //->setHtmlBody(safeString($this->body).$sender_info)
//            ->send();
//    }

    public function contactEmail($email) {

        $arrEmail = explode(',', $email);
        $arrEmail = array_map('trim', $arrEmail);

        $subject = '';
        switch ($this->subject) {
            case 0:
                $subject = 'Пропозиція';
                break;
            case 1:
                $subject = 'Питання';
                break;
            case 2:
                $subject = 'Скарга';
                break;
            case 3:
                $subject = 'Фактура / рахунок';
                break;
            case 4:
                $subject = 'Інше...';
                break;
            default :
                $subject = 'Інше...';
        }
        //$subject = $subject. '-'. Yii::$app->name;
        $from = 'site-robot@'.preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo());
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
            //->setFrom([$this->email => safeString($this->name)])
            ->setFrom([$from => 'Site Robot - '.preg_replace('#^https?://#', '', Yii::$app->urlManager->getHostInfo())])
            ->setSubject(safeString($subject))
            ->send();
    }

}
