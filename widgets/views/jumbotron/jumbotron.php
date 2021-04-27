<?php
use yii\helpers\Html;
?>
<div class="jumbotron">
    <h1><?= Yii::t('lang', 'Congratulations!') ?></h1>
    <p><span style="font-size:44px"><?= Yii::$app->name ?></span></p>
    <p><?= Html::a('Медична реформа 2018', ['article/view', 'alias' => 'medical-reform-2018']) ?> | <?= Html::a(Yii::t('lang', 'How to choose a family doctor'), ['article/view', 'alias' => 'how-to-choose-a-family-doctor']) ?></p>
    <p><?= Html::a(Yii::t('lang', 'Last events'), ['article-category/view', 'alias' => 'events']) ?></p>

    <div class="card bg-info mx-auto" style="opacity: .75; max-width: 500px;">
        <div class="card-body">
            <table class="table table-borderless" style="color: #fff; margin-bottom: 0;">
                <thead>
                  <tr>
                    <th scope="col">Лікарі</th>
                    <th scope="col">Відділення</th>
                    <th scope="col">Декларації</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $doctors ?></td>
                    <td><?= $departments ?></td>
                    <td><?= $number_patients ?></td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
