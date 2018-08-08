<?php


/**
 * @link http://www.ipaya.cn/
 * @copyright Copyright (c) 2018 ipaya.cn
 */

namespace App\Modules\Admin\Modules\System\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use App\Models\Dict;

/**
 * DictSearch represents the model behind the search form of `App\Models\Dict`.
 */
class DictSearch extends Dict
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdAt', 'updatedAt'], 'integer'],
            [['code', 'name'], 'safe'],
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
        $query = Dict::find();

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

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
