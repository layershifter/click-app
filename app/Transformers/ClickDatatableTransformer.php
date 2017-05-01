<?php

namespace App\Transformers;

use App\Click;
use League\Fractal\TransformerAbstract;

final class ClickDatatableTransformer extends TransformerAbstract
{
    /**
     * @param Click $click
     *
     * @return array
     */
    public function transform(Click $click): array
    {
        return [
            $click->id,
            $click->ua,
            $click->ref,
            $click->param1,
            $click->param2,
            $click->error,
            $click->bad_domain,
        ];
    }
}
