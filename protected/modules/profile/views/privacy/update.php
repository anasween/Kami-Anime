<?php
$this->breadcrumbs = array(
            Yum::t('Privacysettings')=>array('index'),
            $model->user->username=>array('//user/user/view','id'=>$model->user_id),
            Yum::t( 'Update'),
        );

$this->title = Yum::t('Privacy settings for {username}', array(
			'{username}' => $model->user->username));

?>
<div class="form">
<p class="note">
<?php Yum::requiredFieldNote(); ?>
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
			'id'=>'privacysetting-form',
			'enableAjaxValidation'=>true,
                        'htmlOptions' => array(
                            'enctype'=>'multipart/form-data',
                            'class' => 'well'
                        ),
                    )); 
echo $form->errorSummary($model);
?>

<div class="profile_field_selection">
<?php
echo '<h3>' . Yum::t('Profile field public options') . '</h3>';
echo '<p>' . Yum::t('Select the fields that should be public') . ':</p>';
$items = array();
$i = 1;
$counter=0;

foreach(YumProfile::getProfileFields() as $field) {
	$counter++;
	printf('<div>%s<label class="profilefieldlabel" for="privacy_for_field_%d" style="display: inline-block;">%s</label></div>',
                        BSHtml::checkBox("privacy_for_field_{$i}",
				$model->public_profile_fields & $i),
			$i,
			Yum::t($field)

			);
	$i *= 2;
}
echo '<div class="clear"></div>';
?>
</div>


<?php if(Yum::hasModule('friendship')) 
{ 
    echo $form->dropDownListControlGroup($model, 'message_new_friendship', array(
        0 => Yum::t('No'),
        1 => Yum::t('Yes'))
    ); 
} ?>

<?php echo $form->dropDownListControlGroup($model, 'message_new_message', array(
        0 => Yum::t('No'),
        1 => Yum::t('Yes'))
    ); 
?>

<?php if(Yum::module('profile')->enableProfileComments) 
{ 
    echo $form->dropDownListControlGroup($model, 'message_new_profilecomment', array(
        0 => Yum::t('No'),
        1 => Yum::t('Yes'))
    );   
} ?>

<?php if(Yum::module()->enableOnlineStatus) 
{ 
    echo $form->DropDownListControlGroup($model, 'show_online_status', array(
        '0' => Yum::t( 'Do not show my online status'),
        '1' => Yum::t( 'Show my online status to everyone'))
    );
} ?>

<?php 
    echo $form->DropDownListControlGroup($model, 'log_profile_visits', array(
        '0' => Yum::t( 'Do not show the owner of a profile when i visit him'),
        '1' => Yum::t( 'Show the owner when i visit his profile'))
    );
?>

<?php if(Yum::hasModule('role')) 
{ 
    echo $form->DropDownListControlGroup($model, 'appear_in_search', array(
        '0' => Yum::t( 'Do not appear in search'),
        '1' => Yum::t( 'Appear in search'))
    );
} ?>
<?php
echo $form->LabelEx($model, 'ignore_users');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'ignore_users',
        'htmlOptions' => array('multiple' => 'multiple', 'style' => 'width: 100%;'),
        'data' => CHtml::listData(YumUser::model()->findAll(), 'id', 'username'),
    ));
?>
<div style="margin-top: 10px;">
<?php
echo BSHtml::buttonGroup(array(
    array(
        'label' => Yum::t('Cancel'), 
        'url' => array('//profile/profile/view'),
        'color' => BSHtml::BUTTON_COLOR_DANGER,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
        'type' => BSHtml::BUTTON_TYPE_LINK
    ),
    array(
    'own' =>
        BSHtml::submitButton(Yum::t('Save'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        )),
    )
));
?>
<?php $this->endWidget(); ?>
</div>
</div> <!-- form -->