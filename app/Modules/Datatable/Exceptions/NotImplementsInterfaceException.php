<?php

namespace App\Modules\Datatable\Exceptions;

final class NotImplementsInterfaceException extends Exception
{
    /**
     * NotImplementsInterfaceException constructor.
     */
    public function __construct()
    {
        parent::__construct('Класс не реализует нужный интерфейс');
    }
}
