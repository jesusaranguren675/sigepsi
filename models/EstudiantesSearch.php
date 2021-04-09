<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estudiantes;
/**
 * EstudiantesSearch represents the model behind the search form of `frontend\models\Estudiantes`.
 */
class EstudiantesSearch extends Estudiantes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estudiante', 'id_persona', 'id_carrera'], 'integer'],
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
        //$query = Estudiantes::find();
        $query = Estudiantes::find();
    			$query->select('a.id_persona, a.id_estudiante, b.cedula, b.nombres, b.apellidos, e.especialidad');
    			$query->from('estudiantes as a');
    			$query->leftJoin('estudiantes_siace as b', 'a.id_estudiante=b.id_estudiante');
    			$query->leftJoin('carreras as c', 'a.id_carrera=c.id_carrera');
    			$query->leftJoin('especialidades as e', 'c.id_especialidad=e.id_especialidad');
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
            'id_estudiante'     => $this->id_estudiante,
            'id_persona'        => $this->id_persona,
            'id_carrera'        => $this->id_carrera,
            'cedula'            => $this->cedula,
            'nombres'           => $this->nombres,
            'apellidos'         => $this->apellidos,
            'especialidad'      => $this->especialidad,
        ]);

        //$query->andFilterWhere(['ilike', 'id_estudiante', $this->id_estudiante])
            //->andFilterWhere(['ilike', 'id_persona', $this->id_persona])
            //->andFilterWhere(['ilike', 'id_carrera', $this->id_carrera])
            //->andFilterWhere(['ilike', 'cedula', $this->cedula])
            //->andFilterWhere(['ilike', 'nombres', $this->nombres])
            //->andFilterWhere(['ilike', 'apellidos', $this->apellidos])
            //->andFilterWhere(['ilike', 'especialidad', $this->especialidad]);

        return $dataProvider;
    }
}
