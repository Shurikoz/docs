<?php

namespace frontend\modules\admin\models;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property int $theme_id
 * @property string $theme_title
 *
 * @property News[] $news
 */
class Themes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'themes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theme_id', 'theme_title'], 'required'],
            [['theme_id'], 'integer'],
            [['theme_title'], 'string', 'max' => 255],
            [['theme_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'theme_id' => 'Theme ID',
            'theme_title' => 'Theme Title',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['theme_id' => 'theme_id']);
    }
}
