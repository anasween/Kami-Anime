<?php
$this->breadcrumbs = array(
            Yum::t('Groups') => array('index'),
            Yum::t('Browse')
        );

$this->title = Yum::t('Usergroups'); ?>

<?php $this->widget('bootstrap.widgets.BsListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			)); ?>
<?php
    echo BSHtml::linkButton(Yum::t('Create new Usergroup'), array(
        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
        'icon' =>  BSHtml::GLYPHICON_PLUS,
        'url' => array('//usergroup/groups/create'),
    ));
?>