<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @method int increment(string $column, int $amount = 1, array $extra = [])
 * @method static Click firstOrCreate(array $fields, array $values = [])
 */
final class Click extends Model
{
    /**
     * {@inheritdoc}
     */
    public $incrementing = false;
    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    protected $casts = [
        'error' => 'int',
    ];
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['ip', 'param1', 'param2', 'ref', 'ua'];
    /**
     * {@inheritdoc}
     */
    protected $table = 'click';

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $primaryKey = $model->getKeyName();
            $uuid = Uuid::uuid4()->toString();

            $model->{$primaryKey} = $uuid;
        });
    }
}
