<?php

namespace App\Http\Controllers;

use App\Actions\HandleClick;
use App\Click;
use App\Modules\Datatable\Datatable;
use App\Transformers\ClickDatatableTransformer;
use Illuminate\Http\Request;

final class ClickController extends BaseController
{
    /**
     * @param Datatable $datatable
     * @param Request   $request
     *
     * @return mixed
     */
    public function index(Datatable $datatable, Request $request)
    {
        if (!$request->ajax()) {
            return view('click.index');
        }

        return $datatable->response(Click::class, new ClickDatatableTransformer());
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

        $handler = new HandleClick($request);
        $click = $handler->click();

        if ($handler->success()) {
            return redirect()->action('ClickController@success', compact('click'));
        }

        return redirect()->action('ClickController@error', compact('click'));
    }

    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        return response($errors, 403);
    }
}
