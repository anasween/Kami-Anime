<?php
if (!$profile = $model->profile) {
    return false;
}
echo '<div id="friends">';
if (isset($model->friends)) {
    echo '<h2>' . Yum::t('Friends of {username}', array(
        '{username}' => $model->username)) . '</h2>';

    $this->widget('bootstrap.widgets.BsListView', array(
        'dataProvider' => $model->getFriendsDataProvider(),
        'itemView' => 'application.modules.user.views.user._view',
        'template' => '{items}{pager}'
    ));
} else {
    echo Yum::t('{username} has no friends yet', array(
        '{username}' => $model->username));
}
echo '</div><!-- friends -->';
