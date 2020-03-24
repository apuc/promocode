<?php

namespace app\controllers;

use app\models\Promocode;
use app\models\UsedPromocode;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class PromocodeController extends Controller
{
    /**
     * @param $code
     * @return int
     * @throws HttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUsePromocode($code) {
        if($model = Promocode::findOne(['code'=>$code])) {
            $model->usages++;
            $model->save();
            if($model->max_usages === $model->usages) {
                $used_model = new UsedPromocode();
                $used_model->load($model->attributes, '');
                $used_model->date_end = time();
                $used_model->save();
                $model->delete();
                return $used_model->discount_percent;
            }
            return $model->discount_percent;
        } else if ($model = UsedPromocode::findOne(['code'=>$code])) {
            throw new HttpException(410, 'Достигнуто максимальное количество использований');
        } else {
            throw new HttpException(410, 'Неверный промокод');
        }
    }

    /**
     * @return false|string|null
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreatePromocode() {
        if(!\Yii::$app->request->isPost)
            throw new NotFoundHttpException();
        $data = \Yii::$app->request->getBodyParams();
        if(!empty($data)) {
            $model = new Promocode();
            $model->code = Promocode::generateCode($data['type']);
            $model->discount_percent = $data['discount_percent'];
            $model->max_usages = $data['max_usages'];
            $model->date_add = time();
            if ($model->save())
                return $model->code;
            else
                throw new HttpException(410, 'Неверные данные');
        }
        throw new HttpException(410, 'Неверные данные');
    }
}
