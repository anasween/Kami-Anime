<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            Yum::t('Create'),
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Create'), Yum::t('Action'));
echo $this->renderPartial('_form', array('model'=>$model)); 
echo '</div>';