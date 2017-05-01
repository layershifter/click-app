<?php

namespace App;

use App\Modules\Datatable\Contracts\DatatableModelContract;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property string $id
 * @property int    $bad_domain
 * @property int    $error
 * @property string $param1
 * @property string $param2
 * @property string $ref
 * @property string $ua
 *
 * @method int increment(string $column, int $amount = 1, array $extra = [])
 * @method static Click firstOrCreate(array $fields, array $values = [])
 */
final class Click extends Model implements DatatableModelContract
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
        'bad_domain' => 'int',
        'error'      => 'int',
    ];
    /**
     * {@inheritdoc}
     */
    protected $fillable = ['bad_domain', 'ip', 'param1', 'param2', 'ref', 'ua'];
    /**
     * {@inheritdoc}
     */
    protected $table = 'click';

    public function searchable(): array
    {
        return ['id', 'ip', 'param1', 'param2', 'ref', 'ua'];
    }

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
