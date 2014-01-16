<?php
$this->breadcrumbs = array(
            Yum::t('Translation')=>array('admin'),
            Yum::t('Manage'),
        );
?>

<h1><?php echo Yum::t('Manage Translations'); ?> </h1>

<?php $this->widget('bootstrap.widgets.BsGridView', array(
        'id'=>'category-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
            array(
                'name' => 'language',
                'filter' => Yum::getAvailableLanguages(),
                'header' => Yum::t('Language'),
            ),
            array('name' => 'message',
                'type' => 'raw'
            ),
            array('name' => 'category',
                'type' => 'raw'
            ),
            array('name' => 'translation',
                'type' => 'raw'
            ),
            array(
                'class'=>'bootstrap.widgets.BsButtonColumn',
                'template' => '{update}',
                'updateButtonUrl'=>'Yii::app()->controller->createUrl("update", array(
                    "message" => $data->message,
                    "category" => $data->category,
                    "language" => $data->language))',
            ),
        ),
    )
); ?>
<?php
    echo BSHtml::linkButton(Yum::t('Create new Translation'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        'url' => array('create')
    ));