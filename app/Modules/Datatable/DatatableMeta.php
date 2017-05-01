<?php

namespace App\Modules\Datatable;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

final class DatatableMeta implements Arrayable
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Collection
     */
    private $collection;

    /**
     * DatatableMeta constructor.
     *
     * @param Collection $collection
     * @param Request    $request
     */
    public function __construct(Collection $collection, Request $request)
    {
        $this->collection = $collection;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'draw'            => $this->request->get('draw'),
            'recordsFiltered' => $this->filtered(),
            'recordsTotal'    => $this->collection->count(),
        ];
    }

    /**
     * @return int
     */
    private function filtered(): int
    {
        $model = $this->collection->getQueueableClass();

        return $model ? $model::count() : 0;
    }
}
