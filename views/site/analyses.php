<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
//use yii\widgets\Pjax;
use yii\bootstrap4\Modal;

$this->title = Yii::t('lang', 'Analyses');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-analyses">
    <div class="row">
        <div class="col-4">
            <?php $form = ActiveForm::begin(['id' => 'analyses-form']); ?>
            <?php // echo  $form->field($model, 'declaration_number')->textInput(['maxlength' => true, 'autofocus' => true, 'placeholder' => Yii::t('lang', 'Enter here'),]) ?>
            <?= $form->field($model, 'declaration_number')->widget(\yii\widgets\MaskedInput::class, ['mask' => '[****-****-****]', 'options' => ['style' => 'font-size: 30px']]) ?>
            <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(),
                    [
                        'template' => '{image}{input}',
                        'options' => ['placeholder' => Yii::t('lang', 'Enter verification code here')],
                    ])
            ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('lang', 'Search'), ['class' => 'btn btn-primary', 'name' => 'analyses-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <?php if (!empty($orders)): ?>
    <script>
        function loadOrder(order_id) {
            var lang = document.getElementsByTagName("html")[0].getAttribute("lang").slice(0, 2);
            $.ajax({
                url: '/'+lang+'/site/analyses',
                data: {order_id: order_id},
                type: 'POST',
                success: function(response) {
                    let response_obj = JSON.parse(response);
//                    $('#analys-modal .modal-header > h5').html(response_obj.title);
//                    $('#analys-modal .modal-body').html(response_obj.content);
//                    $('#analys-modal').modal();
                    let analys_modal = $('#analys-modal');
                    analys_modal.children().children().children('.modal-header').children('h5').html(response_obj.title);
                    analys_modal.children().children().children('.modal-body').html(response_obj.content);
                    analys_modal.modal();
                },
                error: function() {
                    window.alert('Error analys-view!!!');
                }
            });
            return false;
        };

        function PrintElem(elem) {
            Popup($(elem).html());
        }

        function Popup(data) {
            let mywindow = window.open('', 'Print content', 'height=600,width=800');
            mywindow.document.write('<html><head><title>Print content</title>');
            mywindow.document.write('<link rel="stylesheet" href="<?= Yii::$app->urlManager->getHostInfo() ?>/css/bootstrap_united.min.css" type="text/css" />');
            mywindow.document.write('</head><body>');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10
            mywindow.print();
            mywindow.close();
            return true;
        }
    </script>
    <div class="row">
        <div class="col">
            <table class="table table-hover" style="background: #00cc66">
                <thead>
                    <th><b><?= Yii::t('lang', 'Order') . ' #' ?></b></th>
                    <th><b><?= Yii::t('lang', 'Patient') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Package numbers') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Created') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Updated') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Views') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Download') ?></b></th>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><b><?= $order['patient'] ?></b></td>
                        <td><?= $order['pac_nums'] ?></td>
                        <td><?= date('d.m.Y', $order['created_at']) ?></td>
                        <td><?= date('d.m.Y', $order['updated_at']) ?></td>
                        <td><?= $order['views'] ?></td>
                        <td><?= Html::button('<i class="bi bi-download"></i>&nbsp;' . Yii::t('lang', 'Download'), ['class' => 'btn btn-info', 'onclick' => 'loadOrder(' . $order['id'] .')']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr />
        </div>
    </div>
    <?php elseif(isset($orders)): ?>
        <h4 class="alert alert-warning"><?= Yii::t('lang', 'There are no records in the database') ?></h4>
        <hr />
    <?php endif; ?>

    <div class="row">
        <div class="col">
            <?php if (!is_null($model_static)) { echo $model_static['body']; } ?>
        </div>
    </div>

    <?php if (!empty($analyses_packages)): ?>
    <div class="row">
        <div class="col">
            <table class="table table-hover" style="background: #00cc66">
                <thead>
                    <th><b>#</b></th>
                    <th><b><?= Yii::t('lang', 'Package number') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Is free') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Title') ?></b></th>
                    <th><b><?= Yii::t('lang', 'Cost') ?></b></th>
                     <th><b><?= Yii::t('lang', 'Updated') ?></b></th>
                </thead>
                <?php $i = 1; foreach ($analyses_packages as $analys_package): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><b><?= $analys_package['pac_num'] ?></b></td>
                        <td><?= $analys_package['is_free'] ? Yii::t('lang', 'Yes') : Yii::t('lang', 'No') ?></td>
                        <td><?= $analys_package['title'] . '&nbsp;' . '(' . count(explode(',', $analys_package['analyses_ids'])) . ')' ?></td>
                        <td><?= $analys_package['cost'] ?></td>
                        <td><?= date("d.m.Y",$analys_package['updated_at']) ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            </table>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php
Modal::begin([
    'size' => Modal::SIZE_EXTRA_LARGE,
    'id' => 'analys-modal',
    'title' => 'Say hello...',
    'footer' => '<button type="button" class="btn btn-secondary" data-dismiss="modal">'.Yii::t('lang', 'Close').'</button>',
    //'toggleButton' => ['label' => 'click me'],
]);
echo 'Say hello...';
Modal::end();
?>