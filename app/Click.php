<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
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
