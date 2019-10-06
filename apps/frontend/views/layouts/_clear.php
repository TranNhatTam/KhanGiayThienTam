<?php

use common\models\WidgetText;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
$widget_Text = WidgetText::find()->where(['like', 'key', 'frontend.plugin.header'])->andWhere(['status' => WidgetText::STATUS_ACTIVE])->all();
$widget_Text2 = WidgetText::find()->where(['like', 'key', 'frontend.plugin.footer'])->andWhere(['status' => WidgetText::STATUS_ACTIVE])->all();
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
    foreach ($widget_Text as $text) {
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
foreach ($widget_Text2 as $text) {
    echo $text->body;
}
$this->endBody()
?>

<script>

    var tpj=jQuery;
    tpj.noConflict();

    tpj(document).ready(function() {

        var apiRevoSlider = tpj('#rev_slider_ishop').show().revolution(
            {
                sliderType:"standard",
                jsFileLocation:"include/rs-plugin/js/",
                sliderLayout:"fullwidth",
                dottedOverlay:"none",
                delay:9000,
                navigation: {},
                responsiveLevels:[1200,992,768,480,320],
                gridwidth:1140,
                gridheight:500,
                lazyType:"none",
                shadow:0,
                spinner:"off",
                autoHeight:"off",
                disableProgressBar:"on",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    disableFocusListener:false,
                },
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"off",
                    touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "ares",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '<div class="tp-title-wrap">	<span class="tp-arr-titleholder">{{title}}</span> </div>',
                        left: {
                            h_align: "left",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "center",
                            h_offset: 10,
                            v_offset: 0
                        }
                    }
                }
            });

        apiRevoSlider.bind("revolution.slide.onloaded",function (e) {
            SEMICOLON.slider.sliderParallaxDimensions();
        });

    }); //ready

</script>
</body>
</html>
<?php $this->endPage() ?>
