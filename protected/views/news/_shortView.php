<div class="row well post">
    <div class="col-md-12">
        <h1>
            <a href="<?php echo $this->createUrl('news/view',array('id'=>$data->id)); ?>">
                <?php echo $data->title ?>
            </a>
            <?php
            if (Yii::app()->user->can('news'))
            {
                echo BSHtml::buttonGroup(array(
                    array(
                        'icon' => BSHtml::GLYPHICON_PLUS_SIGN, 
                        'url' => array('news/create'),
                        'visible' => Yii::app()->user->can('news', 'create'),
                        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                        'type' => BSHtml::BUTTON_TYPE_LINK,
                        'data-title' => Yum::t('Create'),
                        'title' => '',
                        'data-toggle' => 'tooltip'
                    ),
                    array(
                        'icon' => BSHtml::GLYPHICON_EDIT, 
                        'url' => array("news/update", "id"=>$data->id),
                        'visible' => Yii::app()->user->can('news', 'update'),
                        'color' => BSHtml::BUTTON_COLOR_WARNING,
                        'type' => BSHtml::BUTTON_TYPE_LINK,
                        'data-title' => Yum::t('Edit'),
                        'title' => '',
                        'data-toggle' => 'tooltip'
                    ),
                ), array(
                    'size' => BSHtml::BUTTON_SIZE_MINI
                ));
            }
            ?>
        </h1>
    </div>
    <div class="row post_body">
        <div class="col-md-12">
            <?php echo $data->text; ?>
        </div>
    </div>
    <div class="post_description">
        <?php 
        echo BSHtml::icon(BSHtml::GLYPHICON_EYE_OPEN) . ' '
                . $data->views . ' | '
                . '<a href="' . $this->createUrl('user/admin/view',array('id'=>$data->autor->id)) . '">'
                . BSHtml::icon(BSHtml::GLYPHICON_USER) . ' '
                . $data->autor->username 
                . '</a> | '
                . BSHtml::icon(BSHtml::GLYPHICON_CALENDAR) . ' '
                . Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $data->create_Date) . ' | '
                . BSHtml::icon(BSHtml::GLYPHICON_COMMENT) . ' '
                . count($data->comments); ?>
    </div>
</div>