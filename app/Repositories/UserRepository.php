<?php

namespace App\Repositories;

use App\Repositories\Contracts\{ MustBeUnique, Resource };
use App\Repositories\Support\{ Resourceful, Unique };

class UserRepository implements Resource
{
    use Resourceful, Unique;

    /**
     * Path for the Eloquent model.
     * 
     * @var string
     */
    protected $modelPath = 'App\User';
    
    /**
     * Path for the resource of the Eloquent model.
     * 
     * @var string
     */
    protected $resourcePath = 'App\Http\Resources\User';

    /**
     * Path for the resource collection of the Eloquent model.
     * 
     * @var string
     */
    protected $resourceCollectionPath = 'App\Http\Resources\UserCollection';

    /**
     * Column index for searching.
     * 
     * @return array
     */
    public function findBy()
    {
        return [ 'email', 'name' ];
    }
    
    /**
     * Columns that should be unique in the storage.
     * 
     * @return array
     */
    public function uniqueBy()
    {
        return ['email', 'name'];
    }
}