<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\UserModel;
use DB;

class UserController extends Controller
{
    use ApiResponser;
    private $request;
    
     
    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }


    public function getUsers()
    {
        $users =  DB::connection('mysql')
        ->select("Select * from tbluser");

        return $this->successResponse($users);
    }


    public function index()
    {
        $users = UserModel::all();

        return $this->successResponse($users);
    }


    public function add(Request $request)
    {
        $rules = [

            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female',

        ];


        $this->validate($request, $rules);
        $users = UserModel::create($request->all());
        return $this->successResponse($users, Response::HTTP_CREATED);
    }

    /**
        * Obtains and show one user
        * @return Illuminate\Http\Response
        */


    public function show($id)
    {
        $users = UserModel::where('id', $id)->first();
        if($users){
            return $this->successResponse($users);
        }
    
        {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }

    /**
        * Update an existing author
        * @return Illuminate\Http\Response
        */
    
    public function update(Request $request, $id)
    {

        $rules = [

            'username' => 'max:20',
            'password' => 'max:20',
            'gender' => 'in:Male,Female',

        ];

        $this->validate($request, $rules);

        $users = UserModel::findOrFail($id);

        $users->fill($request->all());
        
        $users->save();
        if($users){
            return $this->successResponse($users);
        }
    
        {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }
    }

    public function delete($id)
    {
        $users = UserModel::where('id', $id)->first();
        if($users){
            $users->delete();
            return $this->successResponse($users);
        }
    
        {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);

        }

    }    
}

?>