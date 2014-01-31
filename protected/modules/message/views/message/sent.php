<?php
$this->title = Yum::t('Sent messages');

$this->breadcrumbs = array(
            Yum::t('Messages')=>array('index'),
            Yum::t('Sent messages')
        );
?>
<h2><?php echo Yum::t('Sent messages'); ?></h2>
<?php
echo '<div class="item">';

echo BSHtml::pills(array(
    array(
        'label' => Yum::t('Admin inbox'), 
        'url' => array('/message/message/index')
    ),
    array(
        'label' => Yum::t('Sent messages'), 
        'url' => array('/message/message/sent'),
        'active' => true
    ),
    array(
        'label' => Yum::t('Write a message'), 
        'url' => array('/message/message/compose')
    ),
), array(
    'justified' => true
));

$this->widget('bootstrap.widgets.BsGridView', array(
        'id'=>'yum-sent-message-grid',
        'dataProvider' => $model->search(true),
        'columns'=>array(
            array(
                'name' => 'to_user_id',
                'type' => 'raw',
                'value' => 'isset($data->to_user) ? CHtml::link($data->to_user->username, array("//profile/profile/view", "id" => $data->to_user->username)) : ""',
            ),
            array(
                'type' => 'raw',
                'name' => 'title',
                'value' => 'CHtml::link($data->title, array("view", "id" => $data->id))',
            ),
            array(
                'name' => 'timestamp',
                'value' => '$data->getDate()',
            ),
            array(
                'class'=>'bootstrap.widgets.BsButtonColumn',
                'template' => '{view}',
            ),
        ),
    )
); 

echo '</div>';