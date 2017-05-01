<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;

final class SuccessClickTest extends AbstractClickTest
{
    use DatabaseTransactions;

    /**
     * @dataProvider clickDataProvider
     *
     * {@inheritdoc}
     */
    public function testStore(array $headers, array $params, string $uri)
    {
        $this->assertRedirect($this->get($uri, $headers), '/click/success');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 0, 'error' => 0]));
    }
}
