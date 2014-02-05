<?php
if(!$profile = $model->profile)
{
    $profile = new YumProfile;
}


$this->pageTitle = Yum::t('Profile');
$this->title = CHtml::activeLabel($model,'username');
$this->breadcrumbs = array(
            Yum::t('Profile'), 
            $model->username,
        );
Yum::renderFlash();
?>

<div>
    
<?php
if(!Yii::app()->user->isGuest && Yii::app()->user->id == $model->id) 
{
    echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Edit profile'), 
            'url' => array('//profile/profile/update'), 
            'color' => BSHtml::BUTTON_COLOR_INFO,
            'icon' =>  BSHtml::GLYPHICON_EDIT,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ),
        array(
            'label' => Yum::t('Upload avatar image'), 
            'url' => array('//avatar/avatar/editAvatar'),
            'color' => BSHtml::BUTTON_COLOR_INFO,
            'icon' =>  BSHtml::GLYPHICON_UPLOAD,
            'type' => BSHtml::BUTTON_TYPE_LINK
        )
    ));
} ?>
<div class="item">
    <div style="margin: 5px;">
        <?php echo $model->getAvatar(); ?>
    </div>
    <?php $this->renderPartial(Yum::module('profile')->publicFieldsView, array('profile' => $model->profile)); ?>
</div>
<?php
if(Yum::hasModule('friendship'))
{
$this->renderPartial(
    'application.modules.friendship.views.friendship.friends', 
    array(
        'model' => $model
    )
); 
} 
?>
<br />
<?php
if(Yum::module('message')->messageSystem != YumMessage::MSG_NONE)
{
    $this->renderPartial('application.modules.message.views.message.write_a_message', array('model' => $model)); 
} ?>
<br />
<?php
if(Yum::module('profile')->enableProfileComments
		&& Yii::app()->controller->action->id != 'update'
		&& isset($model->profile))
{
    $this->renderPartial(
        Yum::module('profile')->profileCommentIndexView, 
        array(
            'model' => $model->profile
        )
    ); 
} ?>
</div>

