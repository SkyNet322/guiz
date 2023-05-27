<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question_number',
        'answer',
        'user_id',
    ];

    public $keyType = 'string';

    protected $primaryKey = 'id';

    public $incrementing = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
