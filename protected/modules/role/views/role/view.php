<?php
$this->title = Yum::t($model->title);

$this->breadcrumbs = array(
            Yum::t('Roles')=>array('index'),
            Yum::t('View'),
            $model->title
        );

echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Role'), $model->title);
echo BSHtml::tag('p', array(), $model->description);
?>
<?php echo Yum::p('These users have been assigned to this role'); ?> 

<?php 
if($assignedUsers)
{
    $this->widget('bootstrap.widgets.BsGridView', array(
        'dataProvider'=>$assignedUsers,
        'columns'=>array(
            'username',          
            'status',          
        ),
    ));
}
?>
<br />

<?php
if(Yum::hasModule('membership') && $model->membership_priority) 
{
    echo Yum::t('Membership priority') . ': '. $model->membership_priority . '<br />';
    echo Yum::t('Membership price') . ': '. $model->price . '<br />';
    echo Yum::t('Membership duration') . ': '. $model->duration . '<br />';

    echo Yum::p('These users have a ordered memberships of this role'); 

    if($activeMemberships)
    {
        $this->widget('bootstrap.widgets.BsGridView', array(
                'dataProvider'=>$activeMemberships,
                'columns'=>array(
                    'id',
                    'user.username',
                    array(
                        'name'=>'order_date',
                        'value' =>'date("Y. m. d G:i:s", $data->order_date)'),
                    array(
                        'name'=>'end_date',
                        'value' =>'date("Y. m. d G:i:s", $data->end_date)'),
                    array(
                        'name'=>'payment_date',
                        'value' =>'date("Y. m. d G:i:s", $data->payment_date)'),
                    'role.price',
                    'payment.title',
                ),
            )
        );
    }
}

if(Yii::app()->user->isAdmin())
{
    echo BSHtml::linkbutton(Yum::t('Update role'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            'url' => Yii::app()->createUrl('/role/role/update', array('id' => $model->id)),
            'type' => BSHtml::BUTTON_TYPE_LINK
        ));
}
echo '</div>';