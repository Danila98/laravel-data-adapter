<?php

namespace DataAdapter\Randomizer;

use App\Models\Randomizer\Color;
use DataAdapter\DataAdapter;
use Illuminate\Database\Eloquent\Model;

class ColorAdapter extends DataAdapter
{

    /**
     * @param Color $color
     */
    public function getModelData(Model $color) : array
    {
        return [
            'image' => $color->image,
            'color_name' => $color->color_name,
            'tags' => $this->getChildrenModel($color->tags, TagAdapter::class)
        ];
    }

}
