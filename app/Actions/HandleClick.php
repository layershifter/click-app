<?php

namespace App\Actions;

use App\BadDomain;
use App\Click;
use Illuminate\Http\Request;

final class HandleClick
{
    /**
     * @var bool
     */
    private $badDomain;
    /**
     * @var Click
     */
    private $click;
    /**
     * @var Request
     */
    private $request;

    /**
     * HandleClick constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->badDomain = $this->badDomain();
    }

    /**
     * @return Click
     */
    public function click(): Click
    {
        $this->click = Click::firstOrCreate([
            'ua'     => $this->request->headers->get('user-agent', ''),
            'ip'     => $this->request->ip(),
            'ref'    => $this->request->headers->get('referrer'),
            'param1' => $this->request->get('param1'),
        ], [
            'bad_domain' => (int) $this->badDomain,
            'param2'     => $this->request->get('param2'),
        ]);

        if (false === $this->badDomain && $this->click->wasRecentlyCreated) {
            return $this->click;
        }

        if ($this->badDomain) {
            $this->click->update(['bad_domain' => 1]);
        }

        $this->click->increment('error');

        return $this->click;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return $this->click->wasRecentlyCreated && false === $this->badDomain;
    }

    /**
     * @return bool
     */
    private function badDomain(): bool
    {
        $referrer = $this->request->headers->get('referrer');

        if (null === $referrer) {
            return false;
        }

        $domain = parse_url($referrer, PHP_URL_HOST);

        return null !== BadDomain::ofName($domain)->first();
    }
}
