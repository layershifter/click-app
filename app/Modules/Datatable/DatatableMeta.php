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
     */
    public function __construct(Request $request, Collection $collection)
    {
        $this->request = $request;
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'draw'            => $this->request->get('draw'),
            'recordsFiltered' => $this->model()::count(),
            'recordsTotal'    => $this->collection->count(),
        ];
    }

    /**
     * @return string
     */
    private function model(): string
    {
        return $this->collection->getQueueableClass();
    }
}
