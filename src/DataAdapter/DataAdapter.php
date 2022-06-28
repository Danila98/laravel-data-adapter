<?php

namespace Kiryanov\Adapter\DataAdapter;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class DataAdapter
{
    abstract function getModelData(Model $model) : array;

    public function getArrayModelData(array|Collection $models) : array
    {
        $res = [];
        foreach ($models as $model)
        {
            $res[] = $this->getModelData($model);
        }
        return $res;
    }

    protected function getChildrenModel(Collection $models, $dataAdapterPath) : array
    {
        $res = [];
        $dataAdapter = new $dataAdapterPath();
        foreach ($models as $model)
        {
            $res[] = $dataAdapter->getModelData($model);
        }
        return $res;
    }
}
