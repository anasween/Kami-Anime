<div class="row post">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <a href="<?php echo $this->createUrl('news/view',array('id'=>$model->id)); ?>">
                        <?php echo $model->title ?>
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
                                'data-title' => Yum::t('Create'),
                                'title' => '',
                                'data-toggle' => 'tooltip'
                            ),
                            array(
                                'icon' => BSHtml::GLYPHICON_EDIT, 
                                'url' => array("news/update", "id"=>$model->id),
                                'visible' => Yii::app()->user->can('news', 'update'),
                                'color' => BSHtml::BUTTON_COLOR_WARNING,
                                'data-title' => Yum::t('Edit'),
                                'title' => '',
                                'data-toggle' => 'tooltip'
                            ),
                            array(
                                'icon' => BSHtml::GLYPHICON_MINUS_SIGN, 
                                'url'=>array('delete','id'=>$model->id),
                                'visible' => Yii::app()->user->can('news', 'delete'),
                                'color' => BSHtml::BUTTON_COLOR_DANGER,
                                'data-title' => Yum::t('Delete'),
                                'title' => '',
                                'data-toggle' => 'tooltip'
                            ),
                        ), array(
                            'type' => BSHtml::BUTTON_TYPE_LINK
                        ));
                    }
                    ?>
                </h1>
            </div>
        </div>
        <div class="row post_body">
            <div class="col-md-12">
                <?php echo $model->text; ?>
            </div>
        </div>
        <div class="post_description">
            <?php 
            echo BSHtml::icon(BSHtml::GLYPHICON_EYE_OPEN) . ' '
                    . $model->views . ' | '
                    . '<a href="' . $this->createUrl('user/admin/view',array('id'=>$model->autor->id)) . '">'
                    . BSHtml::icon(BSHtml::GLYPHICON_USER) . ' '
                    . $model->autor->username 
                    . '</a> | '
                    . BSHtml::icon(BSHtml::GLYPHICON_CALENDAR) . ' '
                    . Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $model->create_Date) . ' | '
                    . BSHtml::icon(BSHtml::GLYPHICON_COMMENT) . ' '
                    . count($model->comments); ?>
        </div>
    </div>
</div>