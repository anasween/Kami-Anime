<?php
$this->title = Yum::t('My inbox');

$this->breadcrumbs= array(
            Yum::t('Messages')=>array('index'),
            Yum::t('My inbox')
        );

echo Yum::renderFlash();

echo '<div class="well">';

echo BSHtml::pills(array(
    array(
        'label' => Yum::t('Admin inbox'), 
        'url' => array('/message/message/index'),
        'active' => true
    ),
    array(
        'label' => Yum::t('Sent messages'), 
        'url' => array('/message/message/sent')
    ),
    array(
        'label' => Yum::t('Write a message'), 
        'url' => array('/message/message/compose')
    ),
), array(
    'justified' => true
));

echo BSHtml::pageHeader(Yum::t('Messages'));

$this->widget('bootstrap.widgets.BsGridView', array(
        'id'=>'yum-message-grid',
        'dataProvider' => $model->search(),
        'columns'=>array(
            array(
                'type' => 'raw',
                'name' => Yum::t('From'),
                'value' => 'CHtml::link($data->from_user->username, array("//profile/profile/view","id" => $data->from_user_id))'
            ),
            array(
                'type' => 'raw',
                'name' => Yum::t('title'),
                'value' => 'CHtml::link($data->getTitle(), array("view", "id" => $data->id))',
            ),
            array(
                'name' => 'timestamp',
                'value' => '$data->getDate()',
            ),
            array(
                'class'=>'bootstrap.widgets.BsButtonColumn',
                'template' => '{view}{delete}',
            ),
        ),
    )
);

echo '</div>';