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
<h3><?php echo Yum::t('Messages'); ?></h3>
<?php
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $model->getCommentsDataProvider(),
    'itemView' => '_message', 
)); 
?>

<?php 
if (Yii::app()->user->can("comment", "create"))
{
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
}
?>
<?php
    Yii::app()->clientScript->registerScript('helloscript',"
        $('#comment-add-form').toggle(500);
    ",CClientScript::POS_READY);
?>
</div>