<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
			[
                'attribute' => 'preview',
                'format'    => 'html',
				'value'=> Html::img('@web/uploads/books/'.$model->preview, ['width' => '80', 'alt' => $model->name])
            ],	
            [
                'attribute' => 'author_id',
                'value' => 'authors.name',
            ],			
			[
				'attribute' => 'date',
				'format' =>  ['date', 'd MMMM yyyy'],
			],
			[
				'attribute' => 'date_create',
				'format' =>  ['date', 'd MMMM yyyy'],
			],			
        ],
    ]) ?>

</div>
