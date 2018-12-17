<?php

namespace App\Repositories\Support;

use Illuminate\Http\Request;

trait Searchable
{
    protected $query;

    /**
     * Search for a specific resource in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function search(Request $request)
    {
        $this->searchQuery($this->model(), $this->findBy(), $request)
            ->withRelatedModels($request)
            ->countRelatedModels($request)
            ->filter($request)
            ->sort($request);

        return $this->resourceCollection(
            $this->query->paginate($this->itemsPerPage())
        );
    }

    /**
     * Stictly search for a specific resource in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function searchStrict(Request $request)
    {
        $this->searchStrictQuery($this->model(), $this->findBy(), $request)
            ->withRelatedModels($request)
            ->countRelatedModels($request)
            ->filter($request)
            ->sort($request);

        return $this->resourceCollection(
            $this->query->paginate($this->itemsPerPage())
        );
    }

    /**
     * Builds the search strict query for the model.
     * 
     * @param string $class
     * @param array $columns
     * @return mixed
     */
    protected function searchStrictQuery(string $class, array $columns, Request $request)
    {
        $this->query = $class::query()->where(function($query) use($columns, $request) {
            foreach ($columns as $column) {
                if($request->has($column)) $query->where($column, 'like', $request->$column.'%');
            }
        }); 

        return $this;
    }

    /**
     * Builds the search query for the model.
     * 
     * @param string $class
     * @param array $columns
     * @return mixed
     */
    protected function searchQuery(string $class, array $columns, Request $request)
    {
        $this->query = $class::query()->where(function($query) use($columns, $request) {
            foreach ($columns as $column) {
                if($request->has($column)) $query->orWhere($column, 'like', $request->$column.'%');
            }
        });

        return $this;
    }

    /**
     * Filter the results of the query to show deleted records
     * 
     */
    protected function filter($request) 
    {
        if ($request->withTrashed)
        {
            $this->query->withTrashed();
        }

        if ($request->onlyTrashed)
        {
            $this->query->onlyTrashed();
        }

        return $this;
    }

    /**
     * Sort the results of the query
     * 
     */
    protected function sort($request) 
    {
        if ($request->has('orderBy'))
        {
            $this->query->orderBy($request->orderBy, $request->direction || 'asc');
        }

        return $this;
    }

    /**
     * Count related models of the resource.
     * 
     */
    protected function countRelatedModels($request)
    {
        if ($request->has('withCount'))
        {
            $this->query->withCount($request->withCount);
        }

        return $this;
    }

    /**
     * Count related models of the resource.
     * 
     */
    protected function withRelatedModels($request)
    {
        if ($request->has('with'))
        {
            $this->query->with($request->with);
        }

        return $this;
    }
}