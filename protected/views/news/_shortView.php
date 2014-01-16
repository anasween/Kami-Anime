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
                echo BSHtml::buttonDropdown(Yum::t('Actions'), 
                        array(
                            BSHtml::dropDownHeader(Yum::t('Actions')),
                            array(
                                'label' => Yum::t('Create'), 
                                'url' => array('news/create'),
                                'visible' => Yii::app()->user->can('news', 'create'),
                            ),
                            array(
                                'label' => Yum::t('Update'), 
                                'url' => array("news/update", "id"=>$model->id),
                                'visible' => Yii::app()->user->can('news', 'update'),
                            ),
                            array(
                                'label' => Yum::t('Delete'), 
                                'url'=>'#', 
                                'linkOptions'=>array(
                                    'submit'=>array(
                                        'delete',
                                        'id'=>$model->id
                                    ),
                                    'confirm'=>Yum::t('Are you sure to delete this item?'),
                                ),
                                'visible' => Yii::app()->user->can('news', 'delete'),
                            ),
                        ),
                        array(
                            'color' => BSHtml::BUTTON_COLOR_PRIMARY
                        )
                    );
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
    <div class="row post_description">
        <div class="col-md-12">
            <?php echo '<a href="' . $this->createUrl('user/admin/view',array('id'=>$model->autor->id)) . '">' . $model->autor->username . '</a> ' . Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $model->create_Date); ?>
        </div>
    </div>
    </div>
</div>