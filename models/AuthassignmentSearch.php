<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AuthAssignment;

/**
 * AuthassignmentSearch represents the model behind the search form of `app\models\AuthAssignment`.
 */
class AuthassignmentSearch extends AuthAssignment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'safe'],
            [['created_at'], 'integer'],
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
        //$query = AuthAssignment::find();
        //select authassig.item_name, authassig.user_id, usuario.username from public.auth_assignment as authassig join
//public.user as usuario on authassig.user_id::INTEGER = usuario.id;

        $query = AuthAssignment::find();
                $query->select('authassig.user_id, authassig.item_name, usuario.username');
                $query->from('auth_assignment as authassig');
                $query->leftJoin('user as usuario', 'authassig.user_id::INTEGER=usuario.id');
            
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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'item_name', $this->item_name])
            ->andFilterWhere(['ilike', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
