<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "used_promocode".
 *
 * @property int $id
 * @property string $code Код для получения скидки
 * @property int $discount_percent Процент скидки
 * @property int $max_usages Максимальное количество использований
 * @property int $date_end Дата достижения лимита использований
 */
class UsedPromocode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'used_promocode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'discount_percent', 'max_usages', 'date_end'], 'required'],
            [['discount_percent', 'max_usages', 'date_end'], 'integer'],
            [['code'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код для получения скидки',
            'discount_percent' => 'Процент скидки',
            'max_usages' => 'Максимальное количество использований',
            'date_end' => 'Дата достижения лимита использований',
        ];
    }
}
