<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estructuras;

/**
 * EstructurasSearch represents the model behind the search form of `app\models\Estructuras`.
 */
class EstructurasSearch extends Estructuras
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estructura', 'id_carrera', 'id_trayecto', 'id_linea_investigacion', 'id_producto', 'id_item_estructura', 'peso'], 'integer'],
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
        $query = Estructuras::find();

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
            'id_estructura' => $this->id_estructura,
            'id_carrera' => $this->id_carrera,
            'id_trayecto' => $this->id_trayecto,
            'id_linea_investigacion' => $this->id_linea_investigacion,
            'id_producto' => $this->id_producto,
            'id_item_estructura' => $this->id_item_estructura,
            'peso' => $this->peso,
        ]);

        return $dataProvider;
    }
}
