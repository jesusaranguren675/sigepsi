<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personas;

/**
 * PersonasSearch represents the model behind the search form of `app\models\Personas`.
 */
class PersonasSearch extends Personas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_persona', 'cedula', 'id_user', 'id_estatus'], 'integer'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'fecha_nac', 'telefono_celular', 'telefono_local'], 'safe'],
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
        $query = Personas::find();

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
            'id_persona' => $this->id_persona,
            'cedula' => $this->cedula,
            'fecha_nac' => $this->fecha_nac,
            'id_user' => $this->id_user,
            'id_estatus' => $this->id_estatus,
        ]);

        $query->andFilterWhere(['ilike', 'primer_nombre', $this->primer_nombre])
            ->andFilterWhere(['ilike', 'segundo_nombre', $this->segundo_nombre])
            ->andFilterWhere(['ilike', 'primer_apellido', $this->primer_apellido])
            ->andFilterWhere(['ilike', 'segundo_apellido', $this->segundo_apellido])
            ->andFilterWhere(['ilike', 'telefono_celular', $this->telefono_celular])
            ->andFilterWhere(['ilike', 'telefono_local', $this->telefono_local]);

        return $dataProvider;
    }
}
