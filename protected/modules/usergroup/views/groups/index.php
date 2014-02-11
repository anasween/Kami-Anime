<?php
$this->breadcrumbs = array(
            Yum::t('Groups') => array('index'),
            Yum::t('Browse')
        );

$this->title = Yum::t('Usergroups');

echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Usergroups'));

echo BSHtml::buttonGroup(array(
    array(
       'label' => Yum::t('Search'),
       'url' => array('browse'),
       'icon' => BSHtml::GLYPHICON_SEARCH,
       'color' => BSHtml::BUTTON_COLOR_INFO,
       'type' => BSHtml::BUTTON_TYPE_LINK
    ),
    array(
       'label' => Yum::t('Manage'),
       'url' => array('admin'),
       'visible' => Yii::app()->user->can('groups', 'admin'),
       'icon' => BSHtml::GLYPHICON_TH,
       'color' => BSHtml::BUTTON_COLOR_PRIMARY,
       'type' => BSHtml::BUTTON_TYPE_LINK
    ),
    array(
       'label' => Yum::t('Create new Usergroup'),
       'color' => BSHtml::BUTTON_COLOR_SUCCESS,
       'icon' =>  BSHtml::GLYPHICON_PLUS,
       'url' => array('//usergroup/groups/create'),
       'visible' => Yii::app()->user->can('groups', 'create'),
       'type' => BSHtml::BUTTON_TYPE_LINK
   ),
),array(
    'type' => BSHtml::BUTTON_TYPE_LINK
));

$this->widget('bootstrap.widgets.BsListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			)); 

echo '</div>';