<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CrugeUser;

/**
 * CrugeUserSearch represents the model behind the search form of `app\models\CrugeUser`.
 */
class CrugeUserSearch extends CrugeUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser', 'regdate', 'actdate', 'logondate', 'state', 'totalsessioncounter', 'currentsessioncounter'], 'integer'],
            [['username', 'email', 'password', 'authkey'], 'safe'],
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
        $query = CrugeUser::find();

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
            'iduser' => $this->iduser,
            'regdate' => $this->regdate,
            'actdate' => $this->actdate,
            'logondate' => $this->logondate,
            'state' => $this->state,
            'totalsessioncounter' => $this->totalsessioncounter,
            'currentsessioncounter' => $this->currentsessioncounter,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
            ->andFilterWhere(['ilike', 'email', $this->email])
            ->andFilterWhere(['ilike', 'password', $this->password])
            ->andFilterWhere(['ilike', 'authkey', $this->authkey]);

        return $dataProvider;
    }
}
