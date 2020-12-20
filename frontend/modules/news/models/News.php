<?php

namespace frontend\modules\news\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $news_id
 * @property string $date
 * @property int $theme_id
 * @property string $text
 * @property string $title
 *
 * @property Themes $theme
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'theme_id', 'text', 'title'], 'required'],
            [['date'], 'safe'],
            [['theme_id'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['theme_id'], 'exist', 'skipOnError' => true, 'targetClass' => Themes::className(), 'targetAttribute' => ['theme_id' => 'theme_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'date' => 'Date',
            'theme_id' => 'Theme ID',
            'text' => 'Text',
            'title' => 'Title',
        ];
    }

    /**
     * Вывод новостей
     * @param $y - год
     * @param $m - месяц
     * @param $t - тема
     * @var $count - всего новостей
     * @return array
     * @throws \yii\db\Exception
     */
    public function getNews($y, $m, $t, $page)
    {
        $countNews = 5;
        $news = ($page * $countNews) - $countNews;
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else {
            $page = 1;
        }
        if ($y == null && $m == null && $t == null) {
            $query = Yii::$app->db->createCommand('SELECT *, (SELECT theme_title FROM themes WHERE theme_id = news.theme_id) as theme FROM news ORDER BY date DESC LIMIT ' .  $news . ',' . $countNews)->queryAll();

            // $count - для подсчета общего количества записей
            $count = Yii::$app->db->createCommand('SELECT COUNT(*) AS count FROM news')->queryAll();

        } elseif ($y != null && $m == null) {
            $query = Yii::$app->db->createCommand('SELECT *, (SELECT theme_title FROM themes WHERE theme_id = news.theme_id) as theme FROM news WHERE YEAR(date) = ' . $y . ' ORDER BY date DESC')->queryAll();
        } elseif ($t != null) {
            $query = Yii::$app->db->createCommand('SELECT *, (SELECT theme_title FROM themes WHERE theme_id = news.theme_id) as theme FROM news WHERE theme_id = ' . $t . ' ORDER BY date DESC')->queryAll();
        } else {
            $query = Yii::$app->db->createCommand('SELECT *, (SELECT theme_title FROM themes WHERE theme_id = news.theme_id) as theme FROM news WHERE YEAR(date) = ' . $y . ' AND MONTHNAME(date) = \'' . $m . '\' ORDER BY date DESC')->queryAll();
        }
        return [$query, $count];
    }

    /**
     * Вывод годов, месяцев и количество публикаций по месяцам
     * @param $y
     * @param $m
     * @return array
     * @throws \yii\db\Exception
     */
    public function getDateNews()
    {
        $query = Yii::$app->db->createCommand('SELECT YEAR(date) AS \'year\', MONTHNAME(date) AS \'month\', COUNT(*) as count FROM news GROUP BY YEAR(date), MONTHNAME(date) ORDER BY year DESC, MONTH(date) ASC')->queryAll();
        return $query;
    }

    /**
     * Вывод тем
     * @return array
     * @throws \yii\db\Exception
     */
    public function getCountThemes()
    {
        $query = Yii::$app->db->createCommand('SELECT theme_id, theme_title, (SELECT count(*) FROM news WHERE theme_id = t.theme_id) AS count FROM themes t')->queryAll();
        return $query;
    }

    /**
     * Вывод выбранного поста (новости)
     * @param $id
     * @return array
     * @throws \yii\db\Exception
     */
    public function getPost($id)
    {
        $query = Yii::$app->db->createCommand('SELECT *, (SELECT theme_title FROM themes WHERE theme_id = news.theme_id) as theme FROM news WHERE news_id = ' . $id)->queryOne();
        return $query;
    }

    /**
     * Gets query for [[Theme]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Themes::className(), ['theme_id' => 'theme_id']);
    }
}
