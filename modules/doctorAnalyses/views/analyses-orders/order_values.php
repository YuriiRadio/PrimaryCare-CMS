<?php if (!empty($model->analyses_values)): ?>

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
                            <td><?= json_decode($model->analyses_values, true)[$analys['id']] ?></td>
                            <td><?= $analys['units'] ?></td>
                            <td><?= nl2br($analys['norm']) ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
            </table>

<?php debug(json_decode($model->analyses_values, true)); endif; ?>
