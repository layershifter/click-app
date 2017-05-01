<?php

namespace App\Http\Controllers;

use App\Click;
use Illuminate\Http\Request;

final class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'param1' => 'required',
            'param2' => 'required',
        ]);

        $click = Click::firstOrCreate([
            'ua'     => $request->server('HTTP_USER_AGENT', ''),
            'ip'     => $request->ip(),
            'ref'    => $request->server('HTTP_REFERER', ''),
            'param1' => $request->get('param1'),
        ], ['param2' => $request->get('param2')]);

        if ($click->wasRecentlyCreated) {
            return redirect()->action('ClickController@success', compact('click'));
        }

        $click->increment('error');

        return redirect()->action('ClickController@error', compact('click'));
    }

    /**
     * @param Click $click
     *
     * @return mixed
     */
    public function error(Click $click)
    {
        return view('click.error', compact('click'));
    }

    /**
     * @param Click $click
     *
     * @return mixed
     */
    public function success(Click $click)
    {
        return view('click.success', compact('click'));
    }

    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return response($errors, 403);
    }
}
