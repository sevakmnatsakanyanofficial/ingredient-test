<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dish_ingredient}}`.
 */
class m190312_123028_create_dish_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dish_ingredient}}', [
            'id' => $this->primaryKey(),
            'dish_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `dish_id`
        $this->createIndex(
            'idx-dish_ingredient-dish_id',
            'dish_ingredient',
            'dish_id'
        );

        // add foreign key for table `dish_id`
        $this->addForeignKey(
            'fk-dish_ingredient-dish_id',
            'dish_ingredient',
            'dish_id',
            'dish',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        // creates index for column `ingredient_id`
        $this->createIndex(
            'idx-dish_ingredient-ingredient_id',
            'dish_ingredient',
            'ingredient_id'
        );

        // add foreign key for table `ingredient_id`
        $this->addForeignKey(
            'fk-dish_ingredient-ingredient_id',
            'dish_ingredient',
            'ingredient_id',
            'ingredient',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dish_ingredient}}');
    }
}
