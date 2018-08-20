<?php
/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Cron\Admin\Models;

use App\Models\Cron;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CronSearch represents the model behind the search form of `App\Models\Cron`.
 */
class CronSearch extends Cron
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'jobClass', 'jobParams', 'cron', 'status'], 'safe'],
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
        $query = Cron::find();

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
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'jobClass', $this->jobClass])
            ->andFilterWhere(['like', 'jobParams', $this->jobParams])
            ->andFilterWhere(['like', 'cron', $this->cron])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
