<?php
$this->title = Yum::t('Create role');

$this->breadcrumbs = array(
            Yum::t('Roles')=>array('index'),
            Yum::t('Create')
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Create role'));
echo $this->renderPartial('_form', array('model'=>$model));
echo '</div>';