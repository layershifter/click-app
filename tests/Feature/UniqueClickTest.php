<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;

final class UniqueClickTest extends AbstractClickTest
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

        $anotherParams = ['param1' => $params['param1'], 'param2' => 'foo'];
        $uri = '/click?' . http_build_query($anotherParams);

        $this->assertRedirect($this->get($uri, $headers), '/click/error');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 0, 'error' => 1]));
    }
}
