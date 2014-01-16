<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            $model->title,
        );
?>
<div class="row">
    <div class="col-md-12">
        <?php
            $this->renderPartial('_shortView', array('model'=>$model));
            foreach ($comments as $comment)
            {
                $this->renderPartial('//comments/_view', array('model'=>$comment));
            }
        ?>
    </div>
</div>
