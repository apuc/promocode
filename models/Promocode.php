<?php

namespace app\models;

use app\services\GenerateCodeService;
use Yii;

/**
 * This is the model class for table "promocode".
 *
 * @property int $id
 * @property string $code Код для получения скидки
 * @property int $discount_percent Процент скидки
 * @property int $usages Количество использований
 * @property int $max_usages Максимальное количество использований
 * @property int $date_add Дата создания
 */
class Promocode extends \yii\db\ActiveRecord
{
    const TYPE_ANY = 1;
    const TYPE_NUMBER = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promocode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discount_percent', 'max_usages', 'code'], 'required'],
            [['discount_percent', 'usages', 'max_usages', 'date_add'], 'integer'],
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
            'usages' => 'Количество использований',
            'max_usages' => 'Максимальное количество использований',
            'date_add' => 'Дата создания',
        ];
    }

    public static function generateCode($type) {
        $result = null;
        switch ($type) {
            case self::TYPE_ANY:
                $result = GenerateCodeService::generateType1();
                break;
            case self::TYPE_NUMBER:
                $result = GenerateCodeService::generateType2();
                break;
        }
        if(self::findOne(['code'=>$result]))
            return self::generateCode($type);
        return $result;
    }
}
