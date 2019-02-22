<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SBResearchTopic extends Model
{
    protected $table = 'scientific_research_topics';

    protected $fillable = [
        'name_of_topic',
        'start_year',
        'end_year',
        'topic_level_id',
        'scientific_background_id',
        'responsibility',
    ];

    public function scientific_background(){
        return $this->belongsTo('App\ScientificBackground','scientific_background_id','id');
    }
    public function topic_level(){
        return $this->belongsTo('App\SBTopicLevel','topic_level_id','id');
    }


}
