<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTaskAttachment extends Model
{

    public function task()
    {
        return $this->belongsTo(ProjectTask::class, 'project_task_id');
    }

}
