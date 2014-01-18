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
            $this->widget('bootstrap.widgets.BsListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_comment', 
                'template'=>"{items}\n{pager}"
            )); 
        ?>
    </div>
</div>
