<?php

namespace App\Modules\Datatable\Contracts;

interface DatatableModelContract
{
    /**
     * @return array
     */
    public function searchable(): array;
}
