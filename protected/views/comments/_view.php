<div class="row comment">
    <div class="col-md-2">
        <?php 
            echo '<h3>' . $data->autor->username . '</h3>';
            echo $data->autor->getAvatar(true);
        ?>
    </div>
    <div class="col-md-10">
        <div clas="info">
            <?php 
                echo Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $data->createTime);
            ?>
        </div>
        <?php 
            echo $data->text;
        ?>
    </div>
</div>    