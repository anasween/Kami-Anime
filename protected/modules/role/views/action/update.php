<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Update'),
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'), Yum::t('Action'));
echo $this->renderPartial('_form', array('model'=>$model)); 
echo '</div>';