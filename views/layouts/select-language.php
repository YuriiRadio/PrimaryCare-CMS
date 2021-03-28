<?php

use yii\bootstrap\Html;

if(\Yii::$app->language == 'uk-UA'):
    echo Html::a('English', array_merge(
        \Yii::$app->request->get(),
        [\Yii::$app->controller->route, 'language' => 'en']
    ));
else:
    echo Html::a('Українська', array_merge(
        \Yii::$app->request->get(),
        [\Yii::$app->controller->route, 'language' => 'uk']
    ));
endif;
