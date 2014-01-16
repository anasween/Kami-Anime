<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Update'),
        );
?>

<h1><?php echo Yum::t('Update Action') . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); 