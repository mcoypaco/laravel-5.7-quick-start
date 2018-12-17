<?php

namespace App\Repositories\Support;

use Illuminate\Http\Request;

trait Resourceful
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function all()
    {
        if(!$this->model()::count()) return response()->json(true);

        return $this->resourceCollection(
            $this->model()::all()
        );
    }

    /**
     * Display a paginated listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function paginate(Request $request)
    {
        $class = $this->model()::query();

        if ($request->has('withTrashed'))
        {
            $class->withTrashed();
        }

        if ($request->has('onlyTrashed'))
        {
            $class->onlyTrashed();
        }

        if ($request->has('orderBy'))
        {
            $class->orderBy($request->orderBy, $request->direction || 'asc');
        }

        return $this->resourceCollection(
            $class->paginate($request->has('itemsPerPage') ? $request->itemsPerPage : $this->itemsPerPage())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function create(Request $request)
    {
        return $this->resource(
            $this->model()::create($request->all())
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $model
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function update(Request $request, $model)
    {
        $model->update($request->all());

        return $this->resource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  midex  $model
     * @return \Illuminate\Http\Resources\Json\Resource
     */
    public function find($model)
    {
        return $this->resource($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  mixed  $model
     * @return \Illuminate\Http\Response
     */
    public function delete($model)
    {
        $model->delete();

        return response()->json(true);
    }
}
