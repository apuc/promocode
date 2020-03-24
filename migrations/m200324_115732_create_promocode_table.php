<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%promocode}}`.
 */
class m200324_115732_create_promocode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%promocode}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(50)->notNull()->comment('Код для получения скидки'),
            'discount_percent' => $this->tinyInteger()->unsigned()->notNull()->comment('Процент скидки'),
            'usages' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('Количество использований'),
            'max_usages' => $this->integer()->unsigned()->notNull()->comment('Максимальное количество использований'),
            'date_add' => $this->integer()->unsigned()->notNull()->comment('Дата создания'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%promocode}}');
    }
}
