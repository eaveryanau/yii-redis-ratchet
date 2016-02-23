<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-3 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'name')->label('Your Name')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
