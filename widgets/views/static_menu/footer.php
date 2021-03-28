<?php if (!empty($model)) { foreach ($model as $menu) { ?>
&nbsp;|&nbsp;<a href="<?= yii\helpers\Url::to(['site/static', 'alias' => $menu['alias']]) ?>"><?= $menu['title'] ?></a>
<?php }} ?>