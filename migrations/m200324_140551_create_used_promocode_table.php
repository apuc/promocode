<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%used_promocode}}`.
 */
class m200324_140551_create_used_promocode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%used_promocode}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->comment('Код для получения скидки'),
            'discount_percent' => $this->tinyInteger()->unsigned()->notNull()->comment('Процент скидки'),
            'max_usages' => $this->integer()->unsigned()->notNull()->comment('Максимальное количество использований'),
            'date_end' => $this->integer()->unsigned()->notNull()->comment('Дата достижения лимита использований'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%used_promocode}}');
    }
}
