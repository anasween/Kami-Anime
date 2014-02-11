<?php 
$this->breadcrumbs = array(Yum::t('Data generation'));

echo '<div class="well">';

if(isset($_POST['user_amount'])) {
    echo BSHtml::pageHeader(Yum::t('Success'));
    echo BSHtml::tag('p', array(), Yum::t('{count} users have been generated. The associated password is {password}', array(
        '{count}' => $_POST['user_amount'],
        '{password}' => $_POST['password'],
    )));
}

echo BSHtml::beginFormBs();

echo BSHtml::pageHeader(Yum::t('Random user generator'));
echo BSHtml::tag('label', array(), Yum::t('Users count'));
echo BSHtml::textFieldControlGroup('user_amount', '1', array('size' => 2));
echo '<div>';
echo BSHtml::tag('label', array('style' => 'margin-right: 5px;'), Yum::t('Users status'));
echo CHtml::dropDownList('status', 1, array(
				'-1' => Yum::t('banned'),
				'0' => Yum::t('inactive'),
				'1' => Yum::t('active')));
echo '</div>';
if (Yum::hasModule('role')) {
    echo BSHtml::tag('label', array(), Yum::t('Users roles'));
    $this->widget('YumModule.components.select2.ESelect2', array(
        'name' => 'role',
        'htmlOptions' => array(
                'multiple' => 'multiple',
                'style' => 'width:100%;'),
        'data' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
    ));   
}
echo BSHtml::tag('label', array(), Yum::t('Users password'));
echo BSHtml::textFieldControlGroup('password', 'Demopassword123');
echo BSHtml::submitButton(Yum::t('Generate'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
echo BSHtml::endForm();

echo '</div>';