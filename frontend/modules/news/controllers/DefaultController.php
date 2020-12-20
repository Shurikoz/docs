<?php

namespace frontend\modules\news\controllers;

use frontend\modules\news\models\News;
use yii\web\Controller;
use yii\data\Pagination;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @param $y - год
     * @param $m - месяц
     * @param $t - тема
     * @param int $page
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex($y = null, $m = null, $t = null, $page = 1)
    {
        $news = (new News())->getNews($y, $m, $t, $page);
        $years = (new News())->getdateNews();
        $themes = (new News())->getCountThemes();

        return $this->render('index', [
            'news' => $news,
            'years' => $years,
            'themes' => $themes,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionPost($id)
    {
        $post = (new News())->getPost($id);
        $years = (new News())->getdateNews();
        $themes = (new News())->getCountThemes();
        return $this->render('post', [
            'post' => $post,
            'years' => $years,
            'themes' => $themes
        ]);
    }

}