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

$doctors = \app\models\Doctor::find()
        ->joinWith('i18n', false, 'LEFT JOIN')
        ->select([\app\models\DoctorI18n::tableName() . '.name', \app\models\Doctor::tableName() . '.id'])
        ->where(['status' => \app\models\Doctor::STATUS_ACTIVE])
        ->indexBy('id')
        ->column();

?>

<?php
$js = <<<JS
jQuery(document).ready(function() {

  let packages_quantity = 0;  // Кількість вибраних пакетів
  let packages_sum = 0;       // Сума вибраних пакетів
  let our_patient = Boolean($("#our_patient").prop("checked")); // Пацієнт закладу

  function update_packages_quantity() {
    packages_quantity = 0;
    $("input:checkbox[data-num]").each(function(i) {
      if ($(this).prop("checked")) packages_quantity++;
    });
	  $('#packages_quantity').text(packages_quantity);
	}

  function update_packages_sum() {
    packages_sum = 0;
    $("input:checkbox[data-num]").each(function(i) {
      if (Number($(this).attr("data-is_free"))) { // Перекреслена ціна
        our_patient ? $(this).parent().prev().css("text-decoration", "line-through") : $(this).parent().prev().css("text-decoration", "none");
      }
      if (!our_patient && $(this).prop("checked")) {
        packages_sum += Number($(this).parent().prev().text());
      } else if ($(this).prop("checked") && !Number($(this).data("is_free"))) {
          packages_sum += Number($(this).parent().prev().text());
      }
    });
	  $('#packages_sum').text(packages_sum);
	}

	$("#our_patient").change(function() {
    ($(this).prop("checked")) ? our_patient = true : our_patient = false;
    update_packages_sum();
	});

  // Масив для збереження номерів пакетів
	let analyses_packages_nums = [];

  // Ініціалізація checkbox при завантаженні
  if($('#analysesorders-analyses_packages_nums').val()) {
    //analyses_packages_nums = JSON.parse("[" + $('#analysesorders-analyses_packages_nums').val() + "]");
    analyses_packages_nums = $('#analysesorders-analyses_packages_nums').val().trim().split(",");
    for (let i = 0; i < analyses_packages_nums.length; i++) {
      let current = $("input:checkbox[data-num="+analyses_packages_nums[i]+"]");
      current.prop('checked', true).parent().parent().css("background-color", "#00cc66");
    }
    update_packages_quantity();
    update_packages_sum();
  }

	$("input:checkbox[data-num]").click(function() {
	  if ($(this).prop("checked")) {
      analyses_packages_nums.push($(this).attr("data-num"));
      $(this).parent().parent().css("background-color", "#00cc66");
	  } else {
      analyses_packages_nums.splice(analyses_packages_nums.indexOf($(this).attr("data-num")), 1);
      $(this).parent().parent().css("background-color", "#FF9200");
	  }
	  analyses_packages_nums.sort();
	  $('#analysesorders-analyses_packages_nums').val(analyses_packages_nums.toString());
    update_packages_quantity();
    update_packages_sum()
	});

  //***************************************************************************************************************

	let analyses_values = {};
	if ($('#analysesorders-analyses_values').val()) {
	  analyses_values = JSON.parse(jQuery('#analysesorders-analyses_values').val());
	  for (let key in analyses_values) {
      if (analyses_values.hasOwnProperty(key)) { //key = key; value = obj[key]
        jQuery("input:text[data-id="+key+"]").val(analyses_values[key]).parent().parent().css("background-color", "#00cc66");
      }
	  }
	}

	$("input:text[data-id]").change(function() {
	  if ($(this).val().trim()) {
      analyses_values[$(this).attr("data-id")] = $(this).val();
      $(this).parent().parent().css("background-color", "#00cc66");
	  } else {
      delete(analyses_values[$(this).attr("data-id")]);
      $(this).parent().parent().css("background-color", "#FF9200");
	  }
    update_analyses_values();
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
            <?php
                // echo $form->field($model, 'status')->dropDownList([0 => Yii::t('lang', 'New'), 1 => Yii::t('lang', 'Edited'), 2 => Yii::t('lang', 'Done')])
                $statuses = [0 => Yii::t('lang', 'New'), 1 => Yii::t('lang', 'Edited'), 2 => Yii::t('lang', 'Done')];
                echo '<div class="form-group required">';
                    echo '<label for="analyses-orders-status">'. Yii::t('lang', 'Status') .'</label>';
                    echo Html::input('text', '', $statuses[$model->status], ['id' => 'analyses-orders-status', 'class' => 'form-control', 'readonly' => true]);
                echo '</div>';
            ?>
        </div>
        <div class="col-3">
            <?php
//                echo $form->field($model, 'doctor_id')->dropDownList($doctors);
            echo '<div class="form-group required">';
                echo '<label for="patients-doctor">'. Yii::t('lang', 'Doctor') .'</label>';
                echo Html::input('text', '', $doctors[$model->doctor_id], ['id' => 'patients-doctor', 'class' => 'form-control', 'readonly' => true]);
            echo '</div>';
            ?>
        </div>
        <div class="col-5">
            <?php
//            $url = \yii\helpers\Url::to(['/doctor-analyses/patients/patients-list']);
//            $dataList = Patients::find()->andWhere(['id' => $model->patient_id])->asArray()->all();
//            empty($dataList) ? $options = [] : $options = [$dataList[0]['id'] => ['our_patient' => $dataList[0]['our_patient']]];
//            $data = ArrayHelper::map($dataList, 'id', 'name');
//            echo $form->field($model, 'patient_id')->widget(Select2::classname(), [
//                'data' => $data,
//                'options' => [
//                    'placeholder' => Yii::t('lang', 'Patient search').'...',
//                    'options' => $options
//                ],
//                'pluginOptions' => [
//                    'allowClear' => true,
//                    'minimumInputLength' => 4,
//                    'language' => [
//                        'errorLoading' => new JsExpression("function() { return 'Waiting for results...'; }"),
//                    ],
//                    'ajax' => [
//                        'url' => $url,
//                        'dataType' => 'json',
//                        'data' => new JsExpression('function(params) { return { q:params.term }; }'),
//                    ],
//                    'escapeMarkup' => new JsExpression('function(markup) { return markup; }'),
//                    'templateResult' => new JsExpression('function(patients) { return patients.text + " " + patients.birth; }'),
//                    'templateSelection' => new JsExpression("function(patients) "
//                            . "{ console.log(patients); $('#analysesorders-patient_id option[our_patient]:selected').each(function(){ if (Number($(this).attr('our_patient'))) { $('#our_patient').trigger('click'); } });"
//                            . "if (typeof(patients.our_patient)!='undefined' && Number(patients.our_patient) && !$('#our_patient').prop('checked')) { $('#our_patient').trigger('click'); "
//                            . "} else if (typeof(patients.our_patient)!='undefined' && !Number(patients.our_patient) && $('#our_patient').prop('checked')) { "
//                            . "$('#our_patient').trigger('click'); } "
//                            . "return patients.text; "
//                            . "}"),
//                ],
//            ]);
            //                echo $form->field($model, 'doctor_id')->dropDownList($doctors);
            echo '<div class="form-group required">';
                echo '<label for="patient_id">'. Yii::t('lang', 'Patient') .'</label>';
                echo Html::input('text', '', $model->patient->name, ['id' => 'patient_id', 'class' => 'form-control', 'readonly' => true]);
            echo '</div>';
            ?>
        </div>
        <div class="col-2">
            <?php
                echo '<div class="form-group required">';
                    echo '<label for="our_patient">'. Yii::t('lang', 'Our patient') .'</label>';
                    echo Html::input('checkbox', null, null, ['id' => 'our_patient', 'class' => 'form-control', 'checked' => $model->patient->our_patient ? true : false, 'disabled' => true]);
                echo '</div>';
            ?>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="col-5">
            <?php // echo $form->field($model, 'analyses_packages_nums')->textInput(['maxlength' => true, 'readonly' => true]) ?>
            <?php echo $form->field($model, 'analyses_packages_nums')->textarea(['rows' => 2, 'readonly' => true]) ?>
        </div>
        <div class="col-3">
            <a class="btn btn-info" data-toggle="collapse" href="#collapse_analyses_packages" role="button" aria-expanded="true" <?= $model->isNewRecord ? 'style="display: none"' : '' ?>>
                <?= Yii::t('lang', 'Expand packages') ?>&nbsp;<i class="bi bi-arrow-down-circle"></i>
            </a>
        </div>
        <div class="col-2" style="font-size: 20px;"><b class="text-info"><?= Yii::t('lang', 'Packages') ?>:</b> <mark><span id="packages_quantity"></span></mark></div>
        <div class="col-2" style="font-size: 20px;"><b class="text-info"><?= Yii::t('lang', 'Sum') ?>:</b> <mark><span id="packages_sum"></span></mark></div>
    </div>

    <?php if (!empty($analyses_packages)): ?>
        <div class="row">
            <div class="col-12">
                <div class="collapse <?= $model->isNewRecord ? 'show' : '' ?>" id="collapse_analyses_packages">
                    <table class="table table-hover" <?= $model->isNewRecord ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
                        <thead>
                            <th><b>#</b></th>
                            <th><b><?= Yii::t('lang', 'Package number') ?></b></th>
                            <th><b><?= Yii::t('lang', 'Is free') ?></b></th>
                            <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                            <th><b><?= Yii::t('lang', 'Cost') ?></b></th>
                            <th><b><?= Yii::t('lang', 'Select') ?></b></th>
                            <th><b><?= Yii::t('lang', 'Updated') ?></b></th>
                        </thead>
                        <?php $i = 1; foreach ($analyses_packages as $analys_package): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><b><?= $analys_package['pac_num'] ?></b></td>
                                <td><?= $analys_package['is_free'] ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No') ?></td>
                                <td><?= $analys_package['title'] . '&nbsp;' . '(' . count(explode(',', $analys_package['analyses_ids'])) . ')' ?></td>
                                <td><?= $analys_package['cost'] ?></td>
                                <td><?= Html::input('checkbox', null, null, ['class' => 'form-control', 'data' => ['num' => $analys_package['pac_num'], 'is_free' => $analys_package['is_free']], 'disabled' => true]) ?></td>
                                <td><?= date("d.m.Y",$analys_package['updated_at']) ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-2">
            <?php echo $form->field($model, 'date_biomaterial')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-10">
            <?php if (!$model->isNewRecord) { echo $form->field($model, 'analyses_values')->textarea(['rows' => 2, 'readonly' => true]); } ?>
        </div>
    </div>

    <?php if (!empty($analyses)): ?>
        <div class="row">
            <div class="col-12">
                <table class="table table-hover" <?= $model->status === $model::STATUS_NEW || $model->status === $model::STATUS_EDITED ? 'style="background: #FF9200"' : 'style="background: #00cc66"' ?>>
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
