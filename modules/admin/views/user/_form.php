<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->checkbox(['0', '1']) ?>

    <?php
    $model->isNewRecord ? $options = ['options' =>
        [\app\models\User::ROLE_USER => ['Selected' => true]]] : $options = [];

    echo $form->field($model, 'role')->dropDownList([
        \app\models\User::ROLE_ADMIN => 'Admin',
        \app\models\User::ROLE_USER => 'User'
        ], $options);
    ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php
        if ($model->role == \app\models\User::ROLE_ADMIN) {
            echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
        }
    ?>

    <?php echo $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
