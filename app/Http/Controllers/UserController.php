<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $users;

    /**
     * Create a new instance of the controller
     * 
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth:api')->except(['checkDuplicate']);
        
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        return $request->user();
    }

    /**
     * Check exisitng record in storage.
     * 
     */
    public function checkDuplicate(Request $request)
    {
        return $this->users->checkDuplicate($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->users->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
