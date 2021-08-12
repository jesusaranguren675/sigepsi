<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Trayectos;

/**
 * TrayectosSearch represents the model behind the search form of `app\models\Trayectos`.
 */
class TrayectosSearch extends Trayectos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_trayecto', 'trayecto'], 'integer'],
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
        $query = Trayectos::find();

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
            'id_trayecto' => $this->id_trayecto,
            'trayecto' => $this->trayecto,
        ]);

        return $dataProvider;
    }
}
