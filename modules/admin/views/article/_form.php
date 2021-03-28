<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1">
            <?= $form->field($model, 'status')->checkbox([ '0', '1', ]) ?>
        </div>
        <div class="col-sm-7 col-md-7 col-lg-7">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?php //echo $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>
            <div class="form-group field-article-category_id has-success">
                <label class="control-label" for="article-category_id"><?= Yii::t('lang', 'Category'); ?></label>
                <select id="article-category_id" class="form-control" name="Article[category_id]">
                    <?php //echo app\widgets\ArticleCategoryMenuWidget::widget(['tpl' => 'select_article', 'model' => $model]); ?>
                    <?php echo app\widgets\TreeMenuWidget::widget(['tpl' => 'select_tree_menu', 'className' => \app\models\ArticleCategory::className(), 'model' => $model]); ?>
                </select>
                <div class="help-block"></div>
            </div>
        </div>
    </div>
    <hr />

    <div>
        <!-- Навігація title-->
        <ul class="nav nav-tabs">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
            <li<?php if ($flagActive) { echo ' class="active"'; } ?>><a href="#<?= $i18nMessage->language.'_title' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a></li>
            <?php $flagActive = false; endforeach; ?>
        </ul>
        <!-- Вміст вкладок title-->
        <div class="tab-content">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_title' ?>">
                    <?php
                        echo $form->field($i18nMessage, "[$index]title")
                            ->textInput(['maxlength' => true])
                            ->label(Yii::t('lang', 'Title'));
                    ?>
                </div>
            <?php $flagActive = false; endforeach; ?>
        </div>
    </div>

    <hr />

    <div>
        <!-- Навігація body-->
        <ul class="nav nav-tabs">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
            <li<?php if ($flagActive) { echo ' class="active"'; } ?>><a href="#<?= $i18nMessage->language.'_body' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a></li>
            <?php $flagActive = false; endforeach; ?>
        </ul>
        <!-- Вміст вкладок body-->
        <div class="tab-content">
            <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_body' ?>">
                    <?php
                        echo $form->field($i18nMessage, "[$index]body")->widget(CKEditor::className(), [
                            'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
                                'preset' => 'full', # Набори інструментів basic, standard, full
                                'inline' => false,
                            ])
                        ]);
                    ?>
                </div>
            <?php $flagActive = false; endforeach; ?>
        </div>
    </div>

    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <?= $form->field($model, 'og_image')->textInput(['maxlength' => true])->label("og_image: (/web/uploads/...)") ?>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4">
            <!-- Навігація keywords-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li<?php if ($flagActive) { echo ' class="active"'; } ?>><a href="#<?= $i18nMessage->language.'_keywords' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a></li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок keywords-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_keywords' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]keywords")
                                ->textInput(['maxlength' => true])
                                ->label(Yii::t('lang', 'Keywords'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5">
            <!-- Навігація description-->
            <ul class="nav nav-tabs">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                <li<?php if ($flagActive) { echo ' class="active"'; } ?>><a href="#<?= $i18nMessage->language.'_description' ?>" data-toggle="tab"><?= Html::img('@web/images/flagicons/'.$i18nMessage->language.'.png').'&nbsp;'.$i18nMessage->language; ?></a></li>
                <?php $flagActive = false; endforeach; ?>
            </ul>
            <!-- Вміст вкладок description-->
            <div class="tab-content">
                <?php $flagActive = true; foreach ($i18nMessages as $index => $i18nMessage): ?>
                    <div class="tab-pane<?php if ($flagActive) { echo ' active'; } ?>" id="<?= $i18nMessage->language.'_description' ?>">
                        <?php
                            echo $form->field($i18nMessage, "[$index]description")
                                ->textarea(['maxlength' => true, 'rows' => 2])
                                ->label(Yii::t('lang', 'Description'));
                        ?>
                    </div>
                <?php $flagActive = false; endforeach; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('lang', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    $js = <<<JS
     jQuery(document).ready(function() {
        $('#articlei18n-1-title').on('change', function(){
            var article_title_en = document.getElementById("articlei18n-1-title").value.replace(/[ \t]{1,}/g, '-').trim().toLowerCase();
            var alias = document.getElementById("article-alias");

            alias.value = article_title_en;
        });
    });

JS;

    $this->registerJs($js);
    ?>

<script>
//    jQuery(document).ready(function() {
//        $('#articlei18n-1-title').on('change', function(){
//            var article_title_en = document.getElementById("articlei18n-1-title").value.replace(/[ \t]{1,}/g, '-').trim().toLowerCase();
//            var alias = document.getElementById("article-alias");
//
//            alias.value = article_title_en;
//        });
//    });
</script>

    <?php ActiveForm::end(); ?>

</div>