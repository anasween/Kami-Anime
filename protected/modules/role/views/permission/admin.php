<?php
$this->breadcrumbs = array(
            Yum::t('Permissions')=>array('index'),
            Yum::t('Manage')
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage permissions'));

echo BSHtml::linkButton(Yum::t('Assign permission'), array(
    'color' => BSHtml::BUTTON_COLOR_SUCCESS,
    'icon' =>  BSHtml::GLYPHICON_PLUS,
    'url' => array('//role/permission/create')
));

$this->widget('bootstrap.widgets.BsGridView', 
    array(
        'id'=>'action-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns' => array(
            array(
                'name' => 'type',
                'value' => '$data->type',
                'filter' => array(
                    'type' => Yum::t('User'),
                    'role' => Yum::t('Role'),
                )
            ),
            array(
                'filter' => $rolefilter,
                'name' => 'principal_id',
                'value' => '$data->type == "user" ? $data->principal->username : @$data->principal_role->title'
            ), 
            array(
                'filter' => $rolefilter,
                'name' => 'subordinate_id',
                'value' => '$data->type == "user" ? $data->subordinate->username : @$data->subordinate_role->title'
            ), 
            array(
              'name' => 'action',
              'filter' => $actionfilter,
              'header' => Yum::t('Action'),
              'value' => '$data->Action->title',
            ),
            array(
              'name' => 'subaction',
              'filter' => $actionfilter,
              'header' => Yum::t('Subaction'),
              'value' => '$data->Subaction->title',
            ),
            'comment',
            'Action.comment',
            array(
                'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'bootstrap.widgets.BsButtonColumn',
                'template' => '{delete}',
            ),
        ),
    )
);
echo '</div>';