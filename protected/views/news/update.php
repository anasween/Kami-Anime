<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Upadate'),   
        );

?><h1><?php echo Yum::t('Update new') . $model->title; ?></h1>
<div class="row">
    <div class="col-md-12">
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>	
    </div>
</div>