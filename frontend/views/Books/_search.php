<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Authors;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-4">
			<?= $form->field($model, 'author_id')->dropDownList(
				ArrayHelper::map(Authors::find()->all(),'id', 'Name'),
				['prompt'=>'---']
			) ?>
		</div>
		<div class="col-md-4">
			<?= $form->field($model, 'name') ?>
		</div>
    </div>
    <div class="row">
        <div class="col-md-6">
			Дата выхода от: <?= DatePicker::widget([
				'model' => $model,
				'attribute' => 'date_ot',
				'language' => 'ru',
				'dateFormat' => 'yyyy-MM-dd',
			]); ?>
			до <?= DatePicker::widget([
				'model' => $model,
				'attribute' => 'date_do',
				'language' => 'ru',
				'dateFormat' => 'yyyy-MM-dd',
			]); ?>			
		</div>

	</div>
	<div class="row">	
		<div class="col-md-4">
			<?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>
<p></p>
