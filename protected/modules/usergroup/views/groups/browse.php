<?php
$this->breadcrumbs = array(
            Yum::t('Groups') => array('index'),
            Yum::t('Browse')
        );
?>
<h1> <?php echo Yum::t('Browse usergroups'); ?> </h1>

<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'layout' => BSHtml::FORM_LAYOUT_INLINE,
        'id' => 'searchForm',
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'htmlOptions' => array(
            'class' => 'well'
        ),
    )
);
echo $form->textFieldControlGroup($model, 'title');
echo BSHtml::submitButton(Yum::t('Search'), array(
    'color' => BSHtml::BUTTON_COLOR_INFO,
    'icon' =>  BSHtml::GLYPHICON_SEARCH,
));
 
$this->endWidget();
unset($form);
$this->widget('bootstrap.widgets.BsListView', array(
       'id'=>'usergroup-grid',
       'dataProvider'=>$model->search(),
       'itemView' => '_view',
       )); 