<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comunidades;

/**
 * ComunidadesSearch represents the model behind the search form of `app\models\Comunidades`.
 */
class ComunidadesSearch extends Comunidades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comunidad', 'id_tipo_comunidad', 'telefono_contacto', 'id_parroquia', 'id_user', 'id_estatus'], 'integer'],
            [['rif', 'nombre', 'persona_contacto', 'email', 'direccion'], 'safe'],
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

        $query = Comunidades::find();
        $query->select('comunidad.id_comunidad, comunidad.nombre, comunidad.rif, tipo_comunidad.tipo_comunidad, comunidad.telefono_contacto');
        $query->from('comunidades as comunidad');
        $query->leftJoin('tipos_comunidades as tipo_comunidad', 'tipo_comunidad.id_tipo_comunidad=comunidad.id_tipo_comunidad');


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
            'id_comunidad' => $this->id_comunidad,
            'id_tipo_comunidad' => $this->id_tipo_comunidad,
            'telefono_contacto' => $this->telefono_contacto,
            'id_parroquia' => $this->id_parroquia,
            'id_user' => $this->id_user,
            'id_estatus' => $this->id_estatus,
        ]);

        $query->andFilterWhere(['ilike', 'rif', $this->rif])
            ->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'persona_contacto', $this->persona_contacto])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
