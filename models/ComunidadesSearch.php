<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comunidades;

/**
 * ComunidadesSearch represents the model behind the search form of `frontend\models\Comunidades`.
 */
class ComunidadesSearch extends Comunidades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comunidad', 'id_tipo_comunidad', 'id_parroquia', 'id_estatus', 'id_usuario'], 'integer'],
            [['nombre', 'direccion', 'telefono', 'persona_contacto'], 'safe'],
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
        //$query = Comunidades::find();

        $query = Estudiantes::find();
                $query->select('c.nombre, tc.tipo_comunidad, e.estado,  m.municipio, p.parroquia');
                $query->from('comunidades as c');
                $query->leftJoin('tipos_comunidades as tc', 'c.id_tipo_comunidad=tc.id_tipo_comunidad');
                $query->leftJoin('parroquias as p', 'c.id_parroquia=p.id_parroquia');
                $query->leftJoin('municipios as m', 'p.id_municipio=m.id_municipio');
                $query->leftJoin('estados as e', 'm.id_estado=e.id_estado');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
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
            'id_parroquia' => $this->id_parroquia,
            'id_estatus' => $this->id_estatus,
            'id_usuario' => $this->id_usuario,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'telefono', $this->telefono])
            ->andFilterWhere(['ilike', 'persona_contacto', $this->persona_contacto]);

        return $dataProvider;
    }
}
