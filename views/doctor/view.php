<?php

use yii\helpers\Html;

//$this->title = $model->i18n->title;
//$this->title = $model['title'];
//$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lang', 'Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = @$model->name;

?>
<div class="row">

    <div class="col-12 col-md-6">
        <div class="card">
            <?= Html::img('@web/web/uploads/doctor-fotos/'.$model->image, ['alt' => @$model->name, 'class' => 'card-img-top doctor-view-img']) ?>
        </div>
    </div>
    <?php
        # 23.03.2020 хочу добавити скрипт для збільшення картинки по кліку
        # http://www.web.cofp.ru/vse-o-sajtakh/sozdanie-sajta/javascript/jquery/154-uvelichenie-izobrazheniya-pri-nazhatii-na-nego
    ?>
    <style>
        .minimized {margin:30px; float:left; cursor:pointer; max-height:100px; max-width:200px;}
        .popup {position: absolute; height:100%; width:100%; top:0; left:0; display:none; text-align:center;}
        .popup_bg {background:rgba(0,0,0,0.6); position:absolute; z-index:1; height:100%; width:100%; }
        .popup_img {position: relative; margin:0 auto; z-index:2; text-align: center; max-height:94%; max-width:94%; margin:10% 0% 0% 0%;}
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() { //Чекаємо завантаження сторінки
            $(".minimized").click(function(){   //Подія кліку на зменшене зображення
                var img = $(this);  //Отримуємо зображення на яке клікнули
                var src = img.attr('src'); //Шляш до картинки
                $("body").append("<div class='popup'>"+ //Додаємо в тіло документа розмітку вспливаючого вікна
                                 "<div class='popup_bg'></div>"+ //Блок, фон затемнений
                                 "<img src='"+src+"' class='popup_img' />"+ //Збільшене зображення
                                 "</div>");
                $(".popup").fadeIn(800);            //Повільно виводимо зображення
                $(".popup_bg").click(function(){    //Подія кліку на затемнений фон
                    $(".popup").fadeOut(800);       //Повільно забираємо вспливаюче вікно
                    setTimeout(function() {         //Таймер
                        $(".popup").remove();       //Видаляємо розмітку вспливаючого вікна
                    }, 800);
                });
            });
        });
        });
    </script>
    <!--Кінець скрипта-->
    <div class="col-12 col-md-6">
        <table class="table table-hover doctor-view-table">
            <tr>
                <td><b><?= Yii::t('lang', 'Specialization') ?>:</b></td>
                <td><?= @$model->specialization->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Category') ?>:</b></td>
                <td><?= @$model->category->name ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Experience') ?>:</b></td>
                <td><?= $model->experience.Yii::t('lang', 'Y.') ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Work place') ?>:</b></td>
                <td><?= Html::a(@$model->department->name, ['department/view', 'id' => $model->department_id]) ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Schedule') ?>:</b></td>
                <td><?= @$model->schedule ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Education') ?>:</b></td>
                <td><?= @$model->institute ?></td>
            </tr>

            <tr>
                <td><b>Особистий номер телефону <font color="red">(Увага!!! інформація доступна на період карантину.)</font>:</b></td>
                <td><?= @$model->phone ?></td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Number of patients') ?>:</b></td>
                <td>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" aria-valuenow="<?= $model->number_patients ?>"
                            aria-valuemin="0" aria-valuemax="<?= $model->allowed_number_patients ?>" style="width:100%">
                            <?= Yii::t('lang', 'Total')?>: <?= $model->number_patients ?>
                        </div>
                    </div>
                    <?php
                    if ($model->number_patients - $model->allowed_number_patients > 0) {
                        $patients_success = $model->allowed_number_patients;
                    } else {
                        $patients_success = $model->number_patients;
                    }

                    $ten_percent = $model->allowed_number_patients / 100 * 10;
                    if ($patients_success + $ten_percent < $model->number_patients) {
                        $patients_warning = $ten_percent;
                    } else {
                        if ($model->number_patients - $model->allowed_number_patients > 0) {
                            $patients_warning = $model->number_patients - $model->allowed_number_patients;
                        } else {
                            $patients_warning = 0;
                        }
                    }

                    if ($patients_success + $patients_warning < $model->number_patients) {
                        $patients_danger = $model->number_patients - $model->allowed_number_patients - $ten_percent;
                    } else {
                        $patients_danger = 0;
                    }

                    $patients_success_percent = round($patients_success / ($patients_success + $patients_warning + $patients_danger ? $patients_success + $patients_warning + $patients_danger : 1) * 100, 2, PHP_ROUND_HALF_UP);
                    $patients_warning_percent= round($patients_warning / ($patients_success + $patients_warning + $patients_danger ? $patients_success + $patients_warning + $patients_danger : 1) * 100, 2, PHP_ROUND_HALF_UP);
                    $patients_danger_percent= round($patients_danger / ($patients_success + $patients_warning + $patients_danger ? $patients_success + $patients_warning + $patients_danger : 1) * 100, 2, PHP_ROUND_HALF_UP);
                    ?>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width:<?= $patients_success_percent ?>%">
                            <?= $patients_success ?>
                        </div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width:<?= $patients_warning_percent ?>%">
                            <?= $patients_warning ?>
                        </div>
                        <div class="progress-bar bg-danger" role="progressbar" style="width:<?= $patients_danger_percent ?>%">
                            <?= $patients_danger ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><b><?= Yii::t('lang', 'Updated') ?>:</b></td>
                <td><?= date("d.m.Y", $model->updated_at) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="bi bi-eye-fill"></i><?= $model->views ?></td>
            </tr>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
                <tr>
                    <td colspan="2">
                        <?php
                            $link = Html::a(Yii::t('lang', 'Update'), ['admin/doctor/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                            $options = ['class' => 'text-right'];
                            echo Html::tag('div', $link, $options);
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
         </table>
    </div>

    <?php if(!empty(@$model->body)): ?>
        <div class="col-12">
        <table class="table table-hover">
            <tr>
                <td><b><?= Yii::t('lang', 'Body') ?>:</b></td>
                <td><?= @$model->body ?></td>
            </tr>
        </table>
        </div>
    <?php endif; ?>

</div>
