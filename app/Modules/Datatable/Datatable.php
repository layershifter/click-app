<?php

namespace App\Modules\Datatable;

use App\Modules\Datatable\Resources\DatatableCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

final class Datatable
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Datatable constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->fractal = app('datatable.fractal');
        $this->request = $request;
    }

    /**
     * @param string              $model
     * @param TransformerAbstract $transformer
     *
     * @return array
     */
    public function response(string $model, TransformerAbstract $transformer): array
    {
        $collection = $this->fetch($model);
        $resource = new DatatableCollection($collection, $transformer);
        $resource->setMeta($this->meta($collection));

        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * @param string $model
     *
     * @return Collection
     */
    private function fetch(string $model): Collection
    {
        return (new DatabaseQueryBuilder($model, $this->request))->build()->get();
    }

    /**
     * @param Collection $collection
     *
     * @return array
     */
    private function meta(Collection $collection): array
    {
        return (new DatatableMeta($collection, $this->request))->toArray();
    }
}
