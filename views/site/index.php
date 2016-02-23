<?php

/* @var $this yii\web\View */

$this->title = 'Classroom';
?>
<div class="site-index">

    <p></p><?= $date ?></p>
    <?php
        foreach($users as $user){
            print '<p>' . $user->name .' :'.$user->handState.'</p>';
        }
    ?>

</div>
