<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Authors;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'imageFile')->fileInput() ?>
	
	<?= $form->field($model, 'date')->widget('yii\jui\DatePicker',[
				'language' => 'ru',
				'dateFormat' => 'yyyy-MM-dd',
			]);
	?>
	
	<?= $form->field($model, 'author_id')->dropDownList(
        ArrayHelper::map(Authors::find()->all(),'id', 'Name'),
        ['prompt'=>'---']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
