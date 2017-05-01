<?php

namespace App\Modules\Datatable;

use App\Modules\Datatable\Serializers\DatatableSerializer;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

final class DatatableProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('datatable.fractal', function () {
            $fractal = new Manager();
            $fractal->setSerializer(new DatatableSerializer());

            return $fractal;
        });
    }
}
