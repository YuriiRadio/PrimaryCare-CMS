<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleCategory;
use yii\data\Pagination;

/**
 * Description of ArticleCategoryController
 *
 * @author Velizar
 */
class ArticleCategoryController extends AppController {

    public function actionIndex() {
//        $articles = Article::find()
//                ->with('i18n')
//                ->with('articleCategory')
//                ->where(['status' => Article::STATUS_ACTIVE])
//                ->limit(9)
//                ->all();

        $query = Article::find()
                ->with('i18n')
                ->with('articleCategory')
                ->where(['status' => Article::STATUS_ACTIVE]);
                //->limit(9)
                //->all();

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE
        ]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['articles' => $articles, 'pages' => $pages]);
    }

    public function actionView($id = null, $alias = null) {

        $article_category = null;
        if (!is_null($id)) {
            $id = (int) $id;
            $article_category = ArticleCategory::find()
                    ->where('id = :id AND status = :status', [':id' => $id, ':status' => ArticleCategory::STATUS_ACTIVE])
                    ->one();
        }

        if (!is_null($alias)) {
            $alias = clearGetData($alias);
            $article_category = ArticleCategory::find()
                    ->where('alias = :alias AND status = :status', [':alias' => $alias, ':status' => ArticleCategory::STATUS_ACTIVE])
                    ->one();
        }

        if (empty($article_category)) {
            throw new \yii\web\HttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }

        $article_categories = ArticleCategory::find()
                ->select(['id', 'alias', 'parent_id'])
                ->indexBy('id')
                ->asArray()
                ->all();

        $query = Article::find()
                ->with('i18n')
                ->with('articleCategory')
                ->where(['IN', 'category_id', $this->getSubCatArray($article_category->id, $article_categories)]);

        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE
        ]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta(Yii::$app->name. ' | ' . $article_category->name, $article_category->keywords, $article_category->description);
        return $this->render('view', ['articles' => $articles, 'article_category' => $article_category, 'pages' => $pages]);
    }

    protected function getSubCatArray($id, $data = []) {

        $keys = array();    // Тут буде масив ключів
        $keys[] = $id;      // Додаємо перший ключ в масив де будемо шукати

        // Це шедевр :) 10.11.2016 21:00 - Velizar
//        while ($category = each($data)) {
//            if (in_array($category['value']['parent_id'], $keys)) {
//                $keys[] = $this->getSubCatArray($category['value']['id'], $data)[0];
//            }
//        }
        #18.11.2019
        foreach ($data as $category) {
            if (in_array($category['parent_id'], $keys)) {
                $keys[] = $this->getSubCatArray($category['id'], $data)[0];
            }
        }
        return $keys;
    }

}