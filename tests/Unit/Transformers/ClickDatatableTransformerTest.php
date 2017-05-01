<?php

namespace Tests\Unit\Transformers;

use App\Click;
use App\Transformers\ClickDatatableTransformer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class ClickDatatableTransformerTest extends TestCase
{
    use DatabaseTransactions;

    public function testTransform()
    {
        $click = factory(Click::class)->create();
        $transformer = new ClickDatatableTransformer();

        $this->assertSame([
            $click->id,
            $click->ua,
            $click->ref,
            $click->param1,
            $click->param2,
            $click->errors,
            $click->bad_domain,
        ], $transformer->transform($click));
    }
}
