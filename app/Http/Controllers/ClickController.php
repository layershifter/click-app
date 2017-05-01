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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
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

        return $click;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Click $click
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Click $click)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Click $click
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Click $click)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Click               $click
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Click $click)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Click $click
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Click $click)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return response($errors, 403);
    }
}
