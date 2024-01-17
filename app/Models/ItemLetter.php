<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ItemLetter extends Model
{
    use HasFactory;
    protected $table = 'item_letters';
    protected $guarded = [];
    protected $with = 'letter';
    /**
     * Get the user that owns the ItemLetter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_id');
    }
}
