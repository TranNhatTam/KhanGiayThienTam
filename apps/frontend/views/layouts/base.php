<?php

use common\models\Category;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>
    <header class="header">
        <?= $this->render('header') ?>
    </header>
<?php echo $content ?>
    <footer class="footer">
        <?= $this->render('footer') ?>
    </footer>
<?php $this->endContent() ?>