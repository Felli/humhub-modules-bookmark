<?php

namespace humhub\modules\bookmark;


use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\bookmark\models\Bookmark;
use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\content\components\ContentContainerActiveRecord;

/**
 * This module provides bookmark support for Content and Content Addons
 * Each wall entry will get a Bookmark Button and a overview of bookmarks.
 *
 * @since 0.5
 */
class Module extends ContentContainerModule
{

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function getContentContainerTypes()
    {
        return [
            User::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        foreach (Bookmark::find()->all() as $bookmark) {
            $bookmark->delete();
        }
        parent::disable();
    }

    /**
     * @inheritdoc
     */
    public function disableContentContainer(ContentContainerActiveRecord $container)
    {
//        won't delete any bookmark-items, because the ContentContainer is primary used for showing users bookmarked content
        parent::disableContentContainer($container);
    }


    public function getName()
    {
        return Yii::t('BookmarkModule.base', 'Bookmark');
    }

    public function getDescription()
    {
        return Yii::t('BookmarkModule.base', 'Adds a bookmark link for content.');
    }

    /**
     * @inheritdoc
     */
    public function getContentContainerName(ContentContainerActiveRecord $container)
    {
        return Yii::t('BookmarkModule.base', 'Bookmark');
    }

    /**
     * @inheritdoc
     */
    public function getContentContainerDescription(ContentContainerActiveRecord $container)
    {
        return Yii::t('BookmarkModule.base', 'Shows up your bookmarked content.');
    }

    /**
     * @inheritdoc
     */
    public function getNotifications()
    {
       return [
           'humhub\modules\bookmark\notifications\NewBookmark'
       ];
    }

    /**
     * @inheritdoc
     */
    public function getActivityClasses()
    {
       return [
           'humhub\modules\bookmark\activities\Bookmarked'
       ];
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if ($contentContainer instanceof User) {
            return [
                new permissions\ViewBookmarkStream(),
                new permissions\ManageBookmark(),
            ];
        }

        return [];
    }

    public function getConfigUrl()
    {
        return Url::to([
            '/bookmark/config'
        ]);
    }

    public function getContentContainerConfigUrl(ContentContainerActiveRecord $container)
    {
        return $container->createUrl('/bookmark/container-config');
    }

}
