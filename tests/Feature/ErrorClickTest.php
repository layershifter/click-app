<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;

final class ErrorClickTest extends AbstractClickTest
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

        $this->assertRedirect($this->get($uri, $headers), '/click/error');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 0, 'error' => 1]));

        $redirectResponse = $this->get($uri, $headers);
        $redirectUri = $redirectResponse->baseResponse->headers->get('Location');
        $this->get($redirectUri)->assertDontSee('google.com');
    }
}
