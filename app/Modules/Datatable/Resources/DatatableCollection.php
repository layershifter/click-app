<?php

namespace App\Modules\Datatable\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

final class DatatableCollection extends Collection
{
    /**
     * @const string
     */
    const RESOURCE_KEY = 'data';

    /**
     * DatatableCollection constructor.
     *
     * @param \Illuminate\Support\Collection $collection
     * @param TransformerAbstract            $transformer
     */
    public function __construct($collection, TransformerAbstract $transformer)
    {
        parent::__construct($collection, $transformer, self::RESOURCE_KEY);
    }
}
