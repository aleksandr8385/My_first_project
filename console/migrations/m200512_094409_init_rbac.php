<?php

use yii\db\Migration;

/**
 * Class m200512_094409_init_rbac
 */
class m200512_094409_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        /**
        * Права
        */
        // Права на создание поста
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'User can create a post';
        $auth->add($createPost);
        //Права на редактирование поста
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'User can update post';
        $auth->add($updatePost);

        // Создание роли Пользователь
        $user = $auth->createRole('user');
        $auth->add($user);
        // Создание роли Автор
        $author = $auth->createRole('author');
        $auth->add($author);
        // Создание роли Админ
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        /**
        * Связываем права и роли
        */
        // Автор может создавать посты
        $auth->addChild($author, $createPost);
        // Админ делает тоже что и автор
        $auth->addChild($admin, $author);
        // ... and ...
        // Админ может редактировать все посты
        $auth->addChild($admin, $updatePost);
        //Создали наше правило
        $rule = new \console\rbac\AuthorRule();
        $auth->add($rule);
        // Привязали правило к праву
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);
        // Получили право на редактирование поста
        $updatePost = $auth->getPermission('updatePost');
        // Получили роль автора
        $author = $auth->getRole('author');
        // Связали права редактирования поста с правилом
        $auth->addChild($updateOwnPost, $updatePost);
        // Связали роль автора с правилом
        $auth->addChild($author, $updateOwnPost);
    }
    /**
    * {@inheritdoc}
    */

    public function safeDown()
    {
    $auth = Yii::$app->authManager;
    $auth->removeAll();
    }
}
