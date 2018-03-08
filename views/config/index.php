<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */
/* @var $this yii\web\View */
/* @var $model \humhub\modules\bookmark\models\forms\ConfigForm */

use yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<div class="panel panel-default">

    <div class="panel-heading"><?= Yii::t('BookmarkModule.forms', '<strong>Bookmark</strong> module configuration'); ?></div>

    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <h4>
            <?= Yii::t('BookmarkModule.forms', 'Bookmark view settings'); ?>
        </h4>

        <div class="help-block">
            <?= Yii::t('BookmarkModule.forms', 'Here you can change the view settings for bookmarks.') ?>
        </div>

        <?= $form->field($model, 'seeBookmarkCount')->checkbox(); ?>
        <?= $form->field($model, 'showFullWidth')->checkbox(); ?>

        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'data-ui-loader' => '']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
