<?php

namespace app\controllers;

use Yii;
use app\models\Article;
use yii\data\Pagination;

/**
 * Description of ArticleController
 *
 * @author Velizar
 */
class ArticleController extends AppController {

    public function actionIndex() {

        $query = Article::find()
                ->with('articleCategory')
                ->where(['status' => Article::STATUS_ACTIVE]);

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

        $article = null;
        if (!is_null($id)) {
            $id = (int) $id;
            $article = Article::find()
                    ->where('id = :id AND status = :status', [':id' => $id, ':status' => Article::STATUS_ACTIVE])
                    ->one();
        }

        if (!is_null($alias)) {
            $alias = clearGetData($alias);
            $article = Article::find()
                    ->where('alias = :alias AND status = :status', [':alias' => $alias, ':status' => Article::STATUS_ACTIVE])
                    ->one();
        }

        if (empty($article)) {
            throw new \yii\web\HttpException(404, Yii::t('lang', 'The requested page does not exist.'));
        }
        // Збільшуємо лічильник переглядів на 1
        $article->views = (int) $article->views + 1;
        $article->detachBehavior('TimestampBehavior');
        $article->save(false);

        $this->setMeta(Yii::$app->name. ' | ' . $article->title, $article->keywords, $article->description);
        if (isset($article->og_image)) {
            $this->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->request->hostInfo.$article->og_image]);
        }

        return $this->render('view', ['article' => $article]);
    }

}