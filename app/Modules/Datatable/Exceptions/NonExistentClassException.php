<?php

namespace App\Modules\Datatable\Exceptions;

final class NonExistentClassException extends Exception
{
    /**
     * NonExistentClassException constructor.
     */
    public function __construct()
    {
        parent::__construct('Класс не существует');
    }
}
