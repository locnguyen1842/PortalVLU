<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SBTopicLevel extends Model
{
    protected $table = 'topic_levels';

    protected $fillable = [
        'level',
        'note',
    ];

    public function scientificbackground(){
        return $this->hasMany('App\SBResearchTopic','topic_level_id','id');
    }

}
