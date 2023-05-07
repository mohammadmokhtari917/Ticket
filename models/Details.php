<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "details".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $summary
 * @property string|null $description
 */
class Details extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'summary'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'summary' => 'Summary',
            'description' => 'Description',
        ];
    }
}
