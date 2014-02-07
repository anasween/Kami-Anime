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
<div class="well">
<?php
$buttons = array();
if(!Yii::app()->user->isGuest && Yii::app()->user->id == $model->id) {
    array_push($buttons, 
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
        ));
}
if (Yum::hasModule('friendship') 
        && !Yii::app()->user->isGuest
        && Yii::app()->user->id != $model->id) {
    $friendStatus = $model->isFriendOf(Yii::app()->user->id);
    if (!$friendStatus) {
        Yii::import('application.modules.friendship.controllers.YumFriendshipController');
        array_push($buttons, 
            array(
                'label' => Yum::t('Add as a friend'), 
                'url' => YumFriendshipController::invitationLink(Yii::app()->user->id, $model->id),
                'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                'icon' =>  BSHtml::GLYPHICON_PLUS,
                'type' => BSHtml::BUTTON_TYPE_LINK
            ));
    } elseif ($friendStatus == 1) {
        array_push($buttons, 
            array(
                'label' => Yum::t('Request already send'), 
                'color' => BSHtml::BUTTON_COLOR_INFO,
                'icon' =>  BSHtml::GLYPHICON_SEND,
                'disabled' => true
            ));
    } elseif ($friendStatus == 2) {
        array_push($buttons, 
            array(
                'label' => Yum::t('You already are friends'), 
                'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                'icon' =>  BSHtml::GLYPHICON_USER,
                'disabled' => true
            ));
    } elseif ($friendStatus == 3) {
        array_push($buttons, 
            array(
                'label' => Yum::t('Friendship request has been rejected'), 
                'color' => BSHtml::BUTTON_COLOR_DANGER,
                'icon' =>  BSHtml::GLYPHICON_MINUS,
                'disabled' => true
            ));
    }
}
if (count($buttons) > 0) {
    echo BSHtml::buttonGroup($buttons);
}
?>
    <div style="margin: 5px;">
        <?php echo $model->getAvatar(); ?>
    </div>
    <?php $this->renderPartial(Yum::module('profile')->publicFieldsView, array('profile' => $model->profile)); ?>
</div>
<?php
if(Yum::hasModule('friendship'))
{
    echo '<div class="well">';
    $this->renderPartial(
        'application.modules.friendship.views.friendship.friends', 
        array(
            'model' => $model
        )
    );
    echo '</div>';
} 
?>
<div class="well">
<h3><?php echo Yum::t('Messages'); ?></h3>
<?php
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $model->getCommentsDataProvider(),
    'itemView' => '_message', 
)); 
?>
</div>

<?php 
if (Yii::app()->user->can("comment", "create"))
{
    echo '<div class="well">';
    echo BSHtml::Button(Yum::t('Write a comment'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_COMMENT,
        'onClick' => "$('#comment-add-form').toggle(500)",
        'style' => 'margin: 10px',
    ));
    echo BSHtml::tag('div', array(
        'id' => 'comment-add-form',
        'style' => 'overflow: hidden; display: block;',
    ), $this->renderPartial('_message_form', array('model' => $commentModel),true,true));
    echo '</div>';
}
?>
<?php
    Yii::app()->clientScript->registerScript('helloscript',"
        $('#comment-add-form').toggle(500);
    ",CClientScript::POS_READY);
?>
</div>