<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            Yum::t('Create'),    
        );
?><h1><?php echo Yum::t('Create new') ?></h1>
<div class="row">
    <div class="col-md-12">
	<?php $this->renderPartial('_form', array('model'=>$model)); ?>	
    </div>
</div>

