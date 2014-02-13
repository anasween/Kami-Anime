<?php

/* @var $this AnimeController */
/* @var $models Anime[] */

$this->breadcrumbs = array(
    Yum::t('Anime') => array('index'),
    Yum::t('Anime list')
);
?>
<div class="well">
    <?php echo BSHtml::pageHeader(Yum::t('Anime list'));
    $this->renderPartial('_item', array('models' => $models));
    ?>
</div>