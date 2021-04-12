<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('lang', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>
        <?php if (!is_null($model_db)) {
            echo $model_db['body'];
        }
        ?>
        <p>
            <span class="badge badge-info" style="font-size: 110%; margin-bottom: 5px;"><?= Yii::t('lang', 'If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.')?></span>
            <br />
            <span class="badge badge-warning" style="font-size: 120%; color: #a00"><?= Yii::t('lang', 'Your IP address: {remote_ip} will be saved!!!', ['remote_ip' => $model->ip]) ?></span>
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput([
                        'autofocus' => true,
                        'placeholder' => Yii::t('lang', 'Enter your name here'),
                    ]) ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('lang', 'Enter your email here')]) ?>
                <div class="row">
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <?= $form->field($model, 'subject')->dropDownList([
                                '0' => Yii::t('lang', 'Proposal'),
                                '1' => Yii::t('lang', 'Question'),
                                '2' => Yii::t('lang', 'Complaint'),
                                '3' => Yii::t('lang', 'Invoice / account'),
                                '4' => Yii::t('lang', 'Other...'),
                            ], [
                                'prompt' => ['text' => Yii::t('lang', 'Please select...'),
                                'options'=> ['disabled' => true]], 'options' =>[ '0' => ['Selected' => true]]
                            ])
                            #'prompt' => ['text' => 'Select', 'options'=> ['disabled' => true, 'selected' => true]]
                        ?>
                    </div>
                </div>
                    <?= $form->field($model, 'body')->textarea([
                        'rows' => 6,
                        'placeholder' => Yii::t('lang', 'Enter your message here')
                    ]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        //'template' => '<div class="row"><div class="col-sm-4 col-md-4 col-lg-4">{image}</div><div class="col-sm-8 col-md-8 col-lg-8">{input}</div></div>',
                        'template' => '{image}{input}',
                        'options' => ['placeholder' => Yii::t('lang', 'Enter verification code here')],
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('lang', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>