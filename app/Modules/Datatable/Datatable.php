<?php

namespace App\Modules\Datatable;

use App\Modules\Datatable\Resources\DatatableCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

final class Datatable
{
    /**
     * @var string
     */
    private $model;
    /**
     * @var Request
     */
    private $request;

    /**
     * Datatable constructor.
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
        $collection = $model::all();

        $resource = new DatatableCollection($collection, $transformer);
        $resource->setMeta($this->meta($collection));

        return $this->fractal->createData($resource)->toArray();
    }

    /**
     * @param Collection $collection
     *
     * @return array
     */
    private function meta(Collection $collection): array
    {
        return (new DatatableMeta($this->request, $collection))->toArray();
    }
}
