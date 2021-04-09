<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyectos;

/**
 * ProyectosSearch represents the model behind the search form of `frontend\models\Proyectos`.
 */
class ProyectosSearch extends Proyectos
{
    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['id_proyecto', 'id_necesidad', 'id_comunidad', 'id_estatus', 'id_especialidad', 'id_parroquia', 'cedula_tutor_comunitario', 'id_tutor', 'id_linea_investigacion', 'id_trayecto'], 'integer'],
    //         [['titulo', 'problema', 'objetivo_general', 'objetivos_especificos', 'conclusiones', 'recomendaciones', 'fecha_inicio', 'fecha_fin', 'formato_informe_final', 'formato_propuesta', 'direccion', 'tutor_comunitario', 'sinopsis', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'safe'],
    //     ];
    // }

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
        
        //$query = Proyectos::find();
        $query = Proyectos::find();
        $query->select('p.titulo, pe.estatus, est.estado,  com.nombre, esp.especialidad, lin.linea_investigacion, p.fecha_inicio, p.fecha_fin');
        $query->from('proyectos as p');
        $query->leftJoin('proyectos_estatus as pe', 'p.id_estatus=pe.id_estatus');
        $query->leftJoin('parroquias as parr', 'p.id_parroquia=parr.id_parroquia');
        $query->leftJoin('municipios as mun', 'parr.id_municipio=mun.id_municipio');
        $query->leftJoin('estados as est', 'mun.id_estado=est.id_estado');
        $query->leftJoin('comunidades as com', 'p.id_comunidad=com.id_comunidad');
        $query->leftJoin('especialidades as esp', 'p.id_especialidad=esp.id_especialidad');
        $query->leftJoin('lineas_investigacion as lin', 'p.id_linea_investigacion=lin.id_linea_investigacion');

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
            'id_proyecto' => $this->id_proyecto,
            'id_necesidad' => $this->id_necesidad,
            'id_comunidad' => $this->id_comunidad,
            'id_estatus' => $this->id_estatus,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'id_especialidad' => $this->id_especialidad,
            'id_parroquia' => $this->id_parroquia,
            'cedula_tutor_comunitario' => $this->cedula_tutor_comunitario,
            'id_tutor' => $this->id_tutor,
            'id_linea_investigacion' => $this->id_linea_investigacion,
            'id_trayecto' => $this->id_trayecto,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'problema', $this->problema])
            ->andFilterWhere(['ilike', 'objetivo_general', $this->objetivo_general])
            ->andFilterWhere(['ilike', 'objetivos_especificos', $this->objetivos_especificos])
            ->andFilterWhere(['ilike', 'conclusiones', $this->conclusiones])
            ->andFilterWhere(['ilike', 'recomendaciones', $this->recomendaciones])
            ->andFilterWhere(['ilike', 'formato_informe_final', $this->formato_informe_final])
            ->andFilterWhere(['ilike', 'formato_propuesta', $this->formato_propuesta])
            ->andFilterWhere(['ilike', 'direccion', $this->direccion])
            ->andFilterWhere(['ilike', 'tutor_comunitario', $this->tutor_comunitario])
            ->andFilterWhere(['ilike', 'sinopsis', $this->sinopsis])
            ->andFilterWhere(['ilike', 'created_by', $this->created_by])
            ->andFilterWhere(['ilike', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
