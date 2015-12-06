<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{

	public $date_ot;
	public $date_do;	
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['name','date','date_ot','date_do'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }	

        if (!empty($this->date_ot)) {
            $query->andFilterWhere(['>=', 'date', $this->date_ot]);
        }

        if (!empty($this->date_do)) {
            $query->andFilterWhere(['<=', 'date', $this->date_do]);
        } 

        $query->andFilterWhere([
            'author_id' => $this->author_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

		//print_r($query);exit;
		
        return $dataProvider;
    }
}
