<?php

namespace Tests\Feature;

use App\BadDomain;
use Illuminate\Foundation\Testing\DatabaseTransactions;

final class BadDomainClickTest extends AbstractClickTest
{
    use DatabaseTransactions;

    /**
     * @dataProvider clickDataProvider
     *
     * {@inheritdoc}
     */
    public function testStore(array $headers, array $params, string $uri)
    {
        $name = parse_url($headers['referrer'], PHP_URL_HOST);

        $this->assertRedirect($this->get($uri, $headers), '/click/success');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 0, 'error' => 0]));

        BadDomain::create(compact('name'));

        $this->assertRedirect($this->get($uri, $headers), '/click/error');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 1, 'error' => 1]));

        $this->assertRedirect($this->get($uri, $headers), '/click/error');
        $this->assertDatabaseHas('click', array_merge($params, ['bad_domain' => 1, 'error' => 2]));

        $redirectResponse = $this->get($uri, $headers);
        $redirectUri = $redirectResponse->baseResponse->headers->get('Location');
        $this->get($redirectUri)->assertSee('google.com');
    }
}
