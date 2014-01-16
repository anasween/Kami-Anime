<?php
$this->title = $model->title;
$this->breadcrumbs = array(
            Yum::t('Messages')=>array('index'),
            $model->title 
        );
?>

<h2> 
    <?php 
    echo Yum::t('Message from') .  ' <em>' . $model->from_user->username . '</em>';
    echo ': ' . $model->title; 
    ?> 
</h2>

<hr />

<div class="message">
<?php echo $model->message; ?>
</div>

<hr />
<?php
echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Back to inbox'), 
            'url' => array('//message/message/index'), 
            'color' => BSHtml::BUTTON_COLOR_INFO,
            'icon' =>  BSHtml::GLYPHICON_HAND_LEFT,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ),
        array(
            'label' => Yum::t('Reply to message'), 
            'color' => BSHtml::BUTTON_COLOR_INFO,
            'icon' =>  BSHtml::GLYPHICON_SEND,
            'onclick' => "$('.reply').toggle(500)",
        )
    ));
if(Yii::app()->user->id != $model->from_user_id) 
{
    echo '<div class="reply" style="display: none;">';
    $reply = new YumMessage;

    if(substr($model->title, 0, 3) != 'Re:')
    {
        $reply->title = 'Re: ' . $model->title;
    }
    else
    {
        $reply->title = $model->title;
    }

    $this->renderPartial('reply', array(
                    'to_user_id' => $model->from_user_id,
                    'answer_to' => $model->id,
                    'model' => $reply));
    echo '</div>';
}