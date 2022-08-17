<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Patients;
//use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysesOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$js = <<<JS
jQuery(document).ready(function(){

  var analyses_packages_ids = [];
  if($('#analysesorders-analyses_packages_ids').val()) {
    //analyses_packages_ids = JSON.parse("[" + $('#analysesorders-analyses_packages_ids').val() + "]");
    let value = $('#analysesorders-analyses_packages_ids').val();
    analyses_packages_ids = value.trim().split(",");
    for (let i = 0; i < analyses_packages_ids.length; i++) {
      $("input:checkbox[data-id="+analyses_packages_ids[i]+"]").prop('checked', true);
    }
  }

  $("input:checkbox[data-id]").click(function(){
      if ($(this).prop("checked")) {
        analyses_packages_ids.push($(this).attr("data-id"));
      } else {
        analyses_packages_ids.splice(analyses_packages_ids.indexOf($(this).attr("data-id")), 1);
      }
      analyses_packages_ids.sort();
      $('#analysesorders-analyses_packages_ids').val(analyses_packages_ids.toString());
  });

  var analyses_values = {};
  if ($('#analysesorders-analyses_values').val()) {
    analyses_values = JSON.parse(jQuery('#analysesorders-analyses_values').val());
    for (let key in analyses_values) {
      if (analyses_values.hasOwnProperty(key)) { //key = key; value = obj[key]
        jQuery("input:text[data-id="+key+"]").val(analyses_values[key]).parent().parent().css("background-color", "#00cc66");
      }
    }
  }

  $("input:text[data-id]").change(function(){
  	//jQuery(this).each(function(i){
  	if ($(this).val().trim()) {
		analyses_values[$(this).attr("data-id")] = $(this).val();
		update_analyses_values();
		//$(this).css("background-color", "#00cc66");
		$(this).parent().parent().css("background-color", "#00cc66");
    } else {
    	delete(analyses_values[$(this).attr("data-id")]);
        update_analyses_values();
    	$(this).parent().parent().css("background-color", "#FF9200");
    }
    //});
  });

  function update_analyses_values() {
  	$('#analysesorders-analyses_values').val(JSON.stringify(analyses_values));
  }

});
JS;
$this->registerJs($js);
?>

<div class="analyses-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row align-items-center">
        <div class="col-2">
            <div class="custom-control custom-switch">
                <?= $form->field($model, 'status')->dropDownList([0 => Yii::t('lang', 'New'), 1 => Yii::t('lang', 'Edited'), 2 => Yii::t('lang', 'Done')]) ?>
            </div>
        </div>
        <div class="col-3">
            <?php
            echo $form->field($model, 'doctor_id')->dropDownList(\app\models\Doctor::find()
                ->joinWith('i18n')
                ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
                ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
                ->indexBy('id')
                ->column());
            ?>
        </div>
        <div class="col-5">
            <?php
            $url = \yii\helpers\Url::to(['/admin/patients/patients-list']);
            $dataList = Patients::find()->andWhere(['id' => $model->patient_id])->all();
            $data = ArrayHelper::map($dataList, 'id', 'name');
//            debug($data, 1);
            echo $form->field($model, 'patient_id')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Search for a patient ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => $url,
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(patients) { return patients.text + " " + patients.birth; }'),
                    'templateSelection' => new JsExpression('function (patients) { return patients.text; }'),
                ],
            ]);
            ?>
        </div>
        <div class="col-2">
            <?php
                echo $form->field($model, 'date_biomaterial')->textInput(['type' => 'date'])
            ?>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-8">
            <?php echo $form->field($model, 'analyses_packages_ids')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-2" id="package_quantity">(В розробці)Пакетів: 10</div>
        <div class="col-2" id="package_sum">(В розробці)на суму: 1000</div>
    </div>

    <?php if (!empty($analyses_packages)): ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover" <?= $model->isNewRecord ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
                    <thead>
                        <th><b>#</b></th>
                        <th><b><?= Yii::t('lang', 'Id') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Is free') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Package number') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Cost') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Select') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Updated') ?></b></th>
                    </thead>
                    <?php $i = 1; foreach ($analyses_packages as $analys_package): ?>
                        <tr>
                            <td><b><?= $i ?></b></td>
                            <td><?= $analys_package['id'] ?></td>
                            <td><?= $analys_package['is_free'] ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No') ?></td>
                            <td><b><?= $analys_package['pac_num'] ?></b></td>
                            <td><?= $analys_package['title'] . '&nbsp;' . '(' . count(explode(',', $analys_package['analyses_ids'])) . ')' ?></td>
                            <td><?= $analys_package['cost'] ?></td>
                            <td><?= Html::input('checkbox', null, null, ['data' => ['id' => $analys_package['id']]]) ?></td>
                            <td><?= date("d.m.Y",$analys_package['updated_at']) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$model->isNewRecord) { echo $form->field($model, 'analyses_values')->textarea(['rows' => 3, 'readonly' => true]); } if (!empty($analyses)): ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover" <?= $model->status === 0 ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
                    <thead>
                        <th><b>#</b></th>
                        <th><b><?= Yii::t('lang', 'Category') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Id') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Value') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Units') ?></b></th>
                        <th><b><?= Yii::t('lang', 'Normal') ?></b></th>
                    </thead>
                        <?php $i = 1; foreach ($analyses as $analys): ?>
                            <tr>
                                <td><b><?= $i ?></b></td>
                                <td><?= $analys['cat_title'] ?></td>
                                <td><?= $analys['id'] ?></td>
                                <td><?= $analys['title'] ?></td>
                                <td><?= Html::input('text', null, null, ['data' => ['id' => $analys['id']]]) ?></td>
                                <td><?= $analys['units'] ?></td>
                                <td><?= nl2br($analys['norm']) ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <?php // echo debug($analyses_packages); ?>
    <?php // echo debug($analyses); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
//Modal::begin([
//    'id' => 'doctor-modal',
//    'size' => Modal::SIZE_EXTRA_LARGE,
//    'title' => 'Hello world',
//    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">'.Yii::t('lang', 'Close').'</button>',
//    'toggleButton' => ['label' => 'click me'],
//]);
//
//echo 'Say hello...';
//
//Modal::end();
?>
