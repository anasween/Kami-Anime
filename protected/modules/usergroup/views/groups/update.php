<?php
$this->breadcrumbs = array(
            Yum::t('Usergroups')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Update')
        );
?>

<h1> <?php echo Yum::t('Update Usergroup'); ?> #<?php echo $model->id; ?> </h1>
<?php
$this->renderPartial('_form', array(
			'model'=>$model));