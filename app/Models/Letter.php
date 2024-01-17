<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Letter extends Model
{
    use HasFactory;
    protected $table = 'letters';
    protected $guarded = [];
    protected $with = ['itemLetter', 'categoryLetter'];
    /**
     * Get the user that owns the Letter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemLetter()
    {
        return $this->belongsTo(ItemLetter::class, 'item_letters');
    }

    /**
     * Get the user that owns the Letter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryLetter(): BelongsTo
    {
        return $this->belongsTo(CategoryLetter::class, 'category_letter_id');
    }
}
