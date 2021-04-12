<?php if (!empty($model)) { foreach ($model as $menu) { ?>
<li class="nav-item"><a class="nav-link<?php if (Yii::$app->request->get('alias') == $menu['alias']) {echo ' active';} ?>" href="<?= yii\helpers\Url::to(['site/static', 'alias' => $menu['alias']]) ?>"><?= $menu['title'] ?></a></li>
<?php }} ?>