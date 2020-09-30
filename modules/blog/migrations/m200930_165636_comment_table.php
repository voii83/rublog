<?php

use yii\db\Migration;

/**
 * Class m200930_165636_comment_table
 */
class m200930_165636_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'text' => $this->text()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-comment-post_id-blog-post_id',
            '{{%comment}}',
            'post_id',
            '{{%blog_post}}',
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
            'fk-comment-post_id-blog-post_id',
            '{{%comment}}'
        );

        $this->dropTable('{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200930_165636_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
