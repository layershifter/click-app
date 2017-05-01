<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

abstract class AbstractClickTest extends TestCase
{
    abstract public function testStore(array $headers, array $params, string $uri);

    public function clickDataProvider(): array
    {
        $factory = Factory::create();
        $headers = [
            'referrer'   => $factory->url,
            'user-agent' => $factory->userAgent,
        ];
        $params = [
            'param1' => $factory->word,
            'param2' => $factory->word,
        ];
        $uri = '/click?' . http_build_query($params);

        return [[$headers, $params, $uri]];
    }

    protected function assertRedirect(TestResponse $response, string $uri)
    {
        $baseResponse = $response->baseResponse;

        $this->assertTrue($baseResponse->isRedirect());
        $this->assertContains($uri, $baseResponse->headers->get('Location'));
    }
}
