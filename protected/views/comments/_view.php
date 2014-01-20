<div class="row comment">
    <div class="col-md-2 info">
        <?php 
            echo '<h3>' . $data->autor->username . '</h3>';
            echo $data->autor->getAvatar(true);
        ?>
    </div>
    <div class="col-md-10 text">
        <div clas="info">
            <?php 
                echo Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $data->createTime);
                if (Yii::app()->user->can('comments'))
                {
                    echo BSHtml::buttonDropdown(Yum::t('Actions'), 
                            array(
                                array(
                                    'label' => Yum::t('Update'), 
                                    'url' => array("comments/update", "id"=>$data->id),
                                    'visible' => Yii::app()->user->can('comments', 'update'),
                                ),
                                array(
                                    'label' => Yum::t('Delete'), 
                                    'url'=>'#', 
                                    'linkOptions'=>array(
                                        'submit'=>array(
                                            'delete',
                                            'id'=>$data->id
                                        ),
                                        'confirm'=>Yum::t('Are you sure to delete this item?'),
                                    ),
                                    'visible' => Yii::app()->user->can('comments', 'delete'),
                                ),
                            ),
                            array(
                                'color' => BSHtml::BUTTON_COLOR_PRIMARY
                            )
                        );
                }
            ?>
        </div>
        <?php 
            echo $data->text;
        ?>
    </div>
</div>    