<div class="form">
<?php
$this->title = Yum::t('Upload avatar');

$this->breadcrumbs = array(
            Yum::t('Profile') => array('//profile/profile/view'),
            Yum::t('Upload avatar')
        );

if(Yii::app()->user->isAdmin())
{
	echo Yum::t('Set Avatar for user ') . $model->username;
}
elseif($model->avatar) 
{
    echo '<h2>';
    echo Yum::t('Your Avatar image');
    echo '</h2>';
    echo $model->getAvatar();
}
else
{
    echo Yum::t('You do not have set an avatar image yet');
}

echo '<br />';

if(Yum::module('avatar')->avatarMaxWidth != 0)
{
    echo '<p>' . Yum::t('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png') . '</p>';
}

    echo CHtml::errorSummary($model);
    $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id'=>'editAvatar-form',
        'htmlOptions' => array(
            'enctype'=>'multipart/form-data',
            'class' => 'well'
        ),
    ));
    echo $form->errorSummary($model);
    echo $form->FileFieldControlGroup($model, 'avatar');
    echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Use Gravatar'), 
            'url' => array('//avatar/avatar/enableGravatar', 'id' => $model->id), 
            'visible'=>Yum::module('avatar')->enableGravatar,
            'color' => BSHtml::BUTTON_COLOR_SUCCESS,
            'icon' =>  BSHtml::GLYPHICON_EYE_OPEN,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ),
        array(
            'label' => Yum::t('Remove Avatar'), 
            'url' => array('//avatar/avatar/removeAvatar', 'id' => $model->id),
            'color' => BSHtml::BUTTON_COLOR_DANGER,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ),
        array(
        'own' =>
            BSHtml::submitButton(Yum::t('Upload avatar'), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            )),
        )
    ));
    $this->endWidget();

?>
</div>
