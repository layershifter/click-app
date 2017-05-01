<?php

namespace App\Http\Controllers;

use App\BadDomain;
use Illuminate\Http\Request;

final class BadDomainController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $domains = BadDomain::all();

        return view('domain.index', compact('domains'));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('domain.create');
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:bad_domains,name',
        ]);

        BadDomain::create(['name' => $request->get('name')]);

        return redirect()->action('BadDomainController@index');
    }
}
