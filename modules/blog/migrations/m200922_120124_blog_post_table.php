<?php

use yii\db\Migration;

/**
 * Class m200922_120124_blog_post_table
 */
class m200922_120124_blog_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_post}}', [
            'id' => $this->primaryKey(),
            'crated_at' => $this->dateTime(),
            'created_by' => $this->integer()->notNull(),
            'published' => $this->boolean()->defaultValue(false),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-blog_post-created_by-author-id',
            '{{%blog_post}}',
            'created_by',
            '{{%author}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-blog_post-created_by-author-id',
            '{{%blog_post}}'
        );

        $this->dropTable('{{%blog_post}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200922_120124_blog_post_table cannot be reverted.\n";

        return false;
    }
    */
}
