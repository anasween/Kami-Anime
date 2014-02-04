<div class="item view">

    <h3> <?php echo CHtml::encode($data->title); ?> </h3> 
    <b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
    <?php 
    if(isset($data->owner))
    {
        echo CHtml::encode($data->owner->username);
    }
    ?>
    <br />


    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode(substr($data->description, 0, 200)) . '... '; ?>

    <br />
    <b><?php echo Yum::t('Participant count'); ?> : </b>
    <?php echo count($data->participants); ?>

    <br />
    <b><?php echo Yum::t('Message count'); ?> : </b>
    <?php echo $data->messagesCount; ?>

    <br />
    <br />
    
    <?php
        $buttons = array(
            array(
                'label'=>Yum::t('View Details'), 
                'url'=>array('//usergroup/groups/view', 'id' => $data->id),
                'color' => BSHtml::BUTTON_COLOR_INFO,
                'icon' =>  BSHtml::GLYPHICON_INFO_SIGN,
                'type' => BSHtml::BUTTON_TYPE_LINK
            )
        );
        if(is_array($data->participants) && in_array(Yii::app()->user->id, $data->participants))
        {
            array_push(
                $buttons, 
                array(
                    'label' => Yum::t('Leave group'),
                    'url' => array('//usergroup/groups/leave', 'id' => $data->id),
                    'color' => BSHtml::BUTTON_COLOR_DANGER,
                    'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
                    'type' => BSHtml::BUTTON_TYPE_LINK
                )
            );
        }
        else
        {
            array_push(
                $buttons, 
                array(
                    'label' => Yum::t('Join group'),
                    'url' => array('//usergroup/groups/join', 'id' => $data->id),
                    'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                    'icon' =>  BSHtml::GLYPHICON_PLUS,
                    'type' => BSHtml::BUTTON_TYPE_LINK
                )
            );
        }
        echo BSHtml::buttonGroup($buttons);
    ?>

</div>
