<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\ArticleCategory;

/**
 * Description of MenuWidget
 *
 * @author Velizar
 */
class ArticleCategoryMenuWidget extends Widget {

    public $tpl; # article_cat_menu, select, select_article
    public $model;
    public $data;
    public $tree;
    public $menuHtml;

    public function init() {
        parent::init();
        if ($this->tpl === NULL) {
            $this->tpl = 'article_cat_menu';
        }
    }

    public function run() {
        # get cache
        if ($this->tpl == 'article_cat_menu') {
            $menu = Yii::$app->cache->get('article_cat_menu'.Yii::$app->language);
            if ($menu) {
                return $menu;
            }
        }

        $this->data = ArticleCategory::find()
                ->joinWith('i18n')
                ->select([ArticleCategory::tableName().'.id', 'parent_id', 'name'])
                ->indexBy('id')
                ->asArray()
                ->all();

        $this->tree = $this->getTree($this->data);
        $this->menuHtml = $this->getMenuHtml($this->tree);

        # set cache
        if ($this->tpl == 'article_cat_menu') {
            Yii::$app->cache->set('article_cat_menu'.Yii::$app->language, $this->menuHtml, Yii::$app->setting->get('CACHE.TIME_MENU'));
        }

        return $this->menuHtml;
    }

    protected function getTree($data) {
        $tree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) { // if (parent_id == 0)
                $tree[$id] = &$node;
            }
            else {
                $data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '') {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab) {
        ob_start();
        include(__DIR__ . '/views/article_cat_menu/' . $this->tpl . '.php');
        return ob_get_clean();
    }

}