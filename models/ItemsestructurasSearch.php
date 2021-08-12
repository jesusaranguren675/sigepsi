<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Itemsestructuras;

/**
 * ItemsestructurasSearch represents the model behind the search form of `app\models\Itemsestructuras`.
 */
class ItemsestructurasSearch extends Itemsestructuras
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_item_estructura', 'id_carrera', 'id_trayecto'], 'integer'],
            [['item'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Itemsestructuras::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_item_estructura' => $this->id_item_estructura,
            'id_carrera' => $this->id_carrera,
            'id_trayecto' => $this->id_trayecto,
        ]);

        $query->andFilterWhere(['ilike', 'item', $this->item]);

        return $dataProvider;
    }
}
