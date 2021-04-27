<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\controllers\AppAdminController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {

        $modelSetting = \app\models\Setting::find()
                ->select(['id', 'param', 'value', 'default', 'label'])
                ->asArray()
                ->all();

        $this->setMeta(Yii::$app->name . ' | ' . Yii::t('lang', 'Admin panel'), Yii::$app->setting->get('SITE.KEYWORDS'), Yii::$app->setting->get('SITE.DESCRIPTION'));
        return $this->render('index', ['modelSetting' => $modelSetting]);
    }

    public function actionTest() {

        $this->setMeta(Yii::$app->name . ' | ' . Yii::t('lang', 'Admin panel'), Yii::$app->setting->get('SITE.KEYWORDS'), Yii::$app->setting->get('SITE.DESCRIPTION'));
        return $this->render('test');
    }

    public function actionFlush() {

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->cache->flush()) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function actionPjaxTime() {

        return date('H:i:s');
    }

    public function actionClearAssets() {

        if (Yii::$app->request->isAjax) {
            $dir = Yii::getAlias('@app/web/assets');
            if ($this->clear_dir($dir, '.gitignore')) {
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    protected function clear_dir($dir = '', $ignore = '') {

        if (!is_dir($dir)) {
            return false;
        }

        $list = scandir($dir);
        //unset($list[0], $list[1]);
        //$list = array_values($list);
        //debug($list);

        foreach ($list as $object) {
            if (($object != '.') && ($object != '..')) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $object)) {
                    $this->clear_dir($dir . DIRECTORY_SEPARATOR . $object);
                    rmdir($dir . DIRECTORY_SEPARATOR . $object);
                } else {
                    if ($object != $ignore) {
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }
        }
        return true;
    }

}