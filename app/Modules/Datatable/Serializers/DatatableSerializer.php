<?php

namespace App\Modules\Datatable\Serializers;

use League\Fractal\Serializer\ArraySerializer;

final class DatatableSerializer extends ArraySerializer
{
    /**
     * @param string $resourceKey
     * @param array  $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return ['data' => $data];
    }

    /**
     * @param array $meta
     *
     * @return array
     */
    public function meta(array $meta): array
    {
        return $meta;
    }
}
