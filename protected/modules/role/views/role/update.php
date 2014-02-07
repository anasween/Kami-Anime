<?php
$this->title = Yum::t('Update role');

$this->breadcrumbs = array(
            Yum::t('Roles')=>array('index'),
            Yum::t('Update')
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'), Yum::t('Role') . ' ' . $model->id);
echo $this->renderPartial('_form', array('model'=>$model));
echo '</div>';