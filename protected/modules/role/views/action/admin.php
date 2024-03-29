<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            Yum::t('Manage'),
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage Actions'));

echo BSHtml::linkButton(Yum::t('Create new action'), array(
    'color' => BSHtml::BUTTON_COLOR_SUCCESS,
    'icon' =>  BSHtml::GLYPHICON_PLUS,
    'url' => array('//role/action/create')
));

$this->widget('bootstrap.widgets.BsGridView', array(
    'id'=>'action-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'title',
        'comment',
        'subject',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.BsButtonColumn',
        ),
    ),
)); 

echo '</div>';