<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ForumQuestion;


class ForumQuestionAnswer extends Model
{
    //
    protected $table = 'forum_question_answer';

    public function forum_question(){
        return $this->belongsTo('App\Model\ForumQuestion');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

}
