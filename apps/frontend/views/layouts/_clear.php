<?php

use common\models\WidgetText;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
$widget_Text = WidgetText::find()->where(['like', 'key', 'frontend.plugin.header'])->andWhere(['status'=>WidgetText::STATUS_ACTIVE])->all();
$widget_Text2 = WidgetText::find()->where(['like', 'key', 'frontend.plugin.footer'])->andWhere(['status'=>WidgetText::STATUS_ACTIVE])->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <title><?php echo Html::encode($this->title) ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php
        foreach ($widget_Text as $text){
            echo $text->body;
        }
    ?>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php
foreach ($widget_Text2 as $text){
    echo $text->body;
}
$this->endBody()
?>
</body>
</html>
<?php $this->endPage() ?>
