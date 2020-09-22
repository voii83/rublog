<?php

use yii\db\Migration;

/**
 * Class m200922_120133_blog_post_tag_table
 */
class m200922_120133_blog_post_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_post_tag}}', [
            'tag_id' => $this->integer()->notNull(),
            'blog_post_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey(
            'pk-blog_post_tag',
            '{{%blog_post_tag}}',
            ['tag_id', 'blog_post_id']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropPrimaryKey(
            'pk-blog_post_tag',
            '{{%blog_post_tag}}'
        );

        $this->dropTable('{{%blog_post_tag}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200922_120133_blog_post_tag_table cannot be reverted.\n";

        return false;
    }
    */
}
