<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	
	
	<?= $this->render('_search', ['model' => $searchModel]); 
	?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
			[
                'attribute' => 'preview',
                'format' => 'raw',
				'value'=> function($model){
					return Html::a(Html::img('@web/uploads/books/'.$model->preview, ['width' => '80', 'alt' => $model->name]),'#activity-modal',['class'=>'preview-link', 'data-target'=>'#activity-modal','data-toggle'=>'modal']);
				}
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
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url."&ajax=true",['class'=>'preview-book', 'data-target'=>'#activity-modal','data-toggle'=>'modal']);
                    }
				]
			],
        ],
    ]); ?>

	<?php $this->registerJs(
			"$('.preview-link').click(function() {
				$('.modal-body').html('<p></p>');
				$('.modal-body').html($(this).html());
				$('.modal-body > img').attr('width','100%');
				$('.modal-title').html($('.modal-body > img').attr('alt'));
			});
			$('.preview-book').click(function() {
				$('.modal-body').html('<p></p>');
				$('.modal-title').html('');
				$('.modal-body').load($(this).attr('href'));
			});
			
			");
	?>	
	
	<?php Modal::begin([
		'id' => 'activity-modal',
		'header' => '<h4 class="modal-title">Изображение</h4>',
		'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',

	]); ?>

	<?php Modal::end(); ?>
	
</div>
