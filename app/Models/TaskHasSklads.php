<?php

namespace App\Models;

use App\Sklad;
use Illuminate\Database\Eloquent\Model;

class TaskHasSklads extends Model
{
    protected $table = 'task_has_sklads';

    protected $fillable = [
        'task_id',
        'sklad_id',
        'in_stock',
        'to_purchase',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sklad()
    {
        return $this->hasOne(Sklad::class, 'id', 'sklad_id');
    }
}
