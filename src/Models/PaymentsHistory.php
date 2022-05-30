<?php

namespace Petliakss\BudgetControl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class PaymentsHistory
 * @package Petliakss\BudgetControl\Models
 *
 * @property int $id
 * @property int $type_id
 * @property int $category_id
 * @property boolean $is_required
 * @property string|null $comment
 * @property int $user_id
 * @property int $sum
 * @property Carbon $created_at
 * @property Carbon $update_at
 * @property-read string $amount
 * @property-read string $type_id_name
 * @property-read string $is_required_string
 */
class PaymentsHistory extends Model
{
    use HasFactory;

    public const TYPE_INCOMES = 1;
    public const TYPE_OUTCOMES = 2;

    protected $table = 'payments_histories';
    public $timestamps = true;

    protected $casts = [
        'is_required' => 'boolean'
    ];

    protected $fillable = [
        'type_id',
        'category_id',
        'is_required',
        'comment',
        'sum',
        'user_id'
    ];

    /**
     * @return string
     */
    public function getTypeIdNameAttribute(): string
    {
        return $this->type_id == 1 ? 'Надходження' : 'Витрати';
    }

    /**
     * @return string
     */
    public function getIsRequiredStringAttribute(): string
    {
        return $this->is_required ? 'Так' : 'Ні';
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return string
     */
    public function getAmountAttribute(): string
    {
        return convert_sum_for_view($this->sum);
    }
}
