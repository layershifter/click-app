<?php

namespace App\Modules\Datatable;

use App\Modules\Datatable\Contracts\DatatableModelContract;
use App\Modules\Datatable\Exceptions\NonExistentClassException;
use App\Modules\Datatable\Exceptions\NotImplementsInterfaceException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class DatabaseQueryBuilder
{
    /**
     * @const string
     */
    const DEFAULT_DIRECTION = 'asc';
    /**
     * @const array
     */
    const POSSIBLE_DIRECTIONS = ['asc', 'desc'];

    /**
     * @var string
     */
    private $model;
    /**
     * @var Request
     */
    private $request;

    /**
     * DatabaseQueryBuilder constructor.
     *
     * @param string  $model
     * @param Request $request
     */
    public function __construct(string $model, Request $request)
    {
        $this->request = $request;
        $this->model = $model;

        $this->validateModelClass();
    }

    /**
     * @return Builder
     */
    public function build(): Builder
    {
        $conditions = $this->conditions();

        return $this->query()
            ->limit($this->limit())
            ->offset($this->offset())
            ->orderBy(...$this->orderBy())
            ->where($conditions);
    }

    /**
     * @return array
     */
    private function columns(): array
    {
        return (new $this->model())->searchable();
    }

    /**
     * @return array
     */
    private function conditions(): array
    {
        $search = $this->request->get('search', []);
        $value = $search['value'] ?? null;

        if (null === $value) {
            return [];
        }

        return array_map(function ($column) use ($value) {
            return [$column, 'like', '%' . $value . '%', 'or'];
        }, $this->columns());
    }

    /**
     * @return int
     */
    private function limit(): int
    {
        return (int)$this->request->get('length', 10);
    }

    /**
     * @return int
     */
    private function offset(): int
    {
        return (int)$this->request->get('start', 0);
    }

    /**
     * @return array
     */
    private function orderBy(): array
    {
        $columns = $this->columns();
        $order = head($this->request->get('order', []));

        $index = $order['column'] ?? 0;
        $column = $this->columns()[$index] ?? head($columns);

        $direction = $order['dir'] ?? self::DEFAULT_DIRECTION;
        $direction = in_array($direction, self::POSSIBLE_DIRECTIONS, true) ? $direction : self::DEFAULT_DIRECTION;

        return [$column, $direction];
    }

    /**
     * @return Builder
     */
    private function query(): Builder
    {
        return $this->model::query();
    }

    /**
     * @throws NonExistentClassException
     * @throws NotImplementsInterfaceException
     */
    private function validateModelClass()
    {
        if (!class_exists($this->model)) {
            throw new NonExistentClassException();
        }

        $interfaces = class_implements($this->model);

        if (!array_key_exists(DatatableModelContract::class, $interfaces)) {
            throw new NotImplementsInterfaceException();
        }
    }
}
