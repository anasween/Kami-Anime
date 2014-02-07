<?php
$this->title = Yum::t('Request friendship for user {username}', array(
			'{username}' => $invited->username));
$this->breadcrumbs = array(
            Yum::t('Friendship'),
            Yum::t('Invitation'), $invited->username
        );

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('Invitation'), $invited->username);

$friendship_status = $invited->isFriendOf(Yii::app()->user->id);
if($friendship_status !== false)  
{
    if($friendship_status == 1)
    {
        echo Yum::t('Friendship request already sent');
    }
    if($friendship_status == 2)
    {
        echo Yum::t('You already are friends');
    }
    if($friendship_status == 3)
    {
        echo Yum::t('Friendship request has been rejected');
    }

    return false;
} 
else 
{
        if(isset($friendship))
        {
            echo CHtml::errorSummary($friendship);
        }
        
        echo CHtml::beginForm(array('friendship/invite'));
        echo CHtml::hiddenField('user_id', $invited->id);
        echo CHtml::label(Yum::t('Please enter a request Message up to 255 characters'), 'message');
        $this->widget('ext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
            'name' => 'message',
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
                'css' => 'wym.css',
                'buttons' => array(
                    'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'video', 'link', '|', '|', 'alignment', '|', 'horizontalrule'
                ),
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
        ));
        echo BSHtml::submitButton(Yum::t('Send invitation'), array(
                    'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                    'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
                ));
        echo CHtml::endForm();
}
echo '</div>';