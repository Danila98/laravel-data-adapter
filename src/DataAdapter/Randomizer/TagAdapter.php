<?php

namespace DataAdapter\Randomizer;

use App\Models\Randomizer\Tag;
use DataAdapter\DataAdapter;
use Illuminate\Database\Eloquent\Model;

class TagAdapter extends DataAdapter
{

    /**
     * @param Tag $tag
     */
    public function getModelData(Model $tag) : array
    {
        return [
            'name' => $tag->name,
            'id' => $tag->id,
        ];
    }
}
