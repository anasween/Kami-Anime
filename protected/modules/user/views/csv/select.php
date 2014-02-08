<?php
$this->breadcrumbs = array(
		Yum::t('Users') => array('//user/user/admin'),
		Yum::t('Csv export'));

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('Export'));

echo BSHtml::beginFormBs('',array('//user/csv/export'));

echo CHtml::checkBoxList('profile_fields',
		array(), $profile_fields, array(
			'checkAll' => Yum::t('Select all'),
			));

$content = BSHtml::submitButton(Yum::t('Start export'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' => BSHtml::GLYPHICON_THUMBS_UP,
    ));

echo BSHtml::tag('div', array(), $content);

echo BSHtml::endForm();

echo '</div>';