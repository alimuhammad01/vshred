<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public $successStatus = 200;
    private $userRepository;
    //injecting userRepository
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    //registration is not allowed
    // public function register(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]);


    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = $this->userRepository->create($input);
    //     $token =  $user->createToken('MyApp')->accessToken;
    //     $success['name'] =  $user->name;
    //     return response()->json(['success' => true, "token" => $token, "code" => $this->successStatus], $this->successStatus);
    // }



    public function login(Request $request)
    {
        //attempt login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //created token for user
            $token =  $user->createToken('MyApp')->accessToken;
            //send token with response
            return response()->json(['success' => true, "token" => $token, "code" => $this->successStatus], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


    public function index()
    {
        //check authorization for user
        $this->authorize('viewAny', User::class);
        //response genrated by query builder
        $users = QueryBuilder::for(User::class)
            ->allowedIncludes('images')
            ->allowedFilters('email')
            ->get();
        return response()->json(['scuess' => true, 'users' => $users, "code" => $this->successStatus], $this->successStatus);
    }
    //store endpoint for user
    public function store(Request $request)
    {
        //check authorization for user
        $this->authorize('create', User::class);
        //validate request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        $input = $request->all();
        //hash the password
        $input['password'] = bcrypt($input['password']);
        //created new user using repository function
        $user = $this->userRepository->create($input);
        //data for email blade
        $data = ([
            'name' => $user->name,
            'email' => $user->email
        ]);
        //calling to send email
        Mail::to($user->email)->send(new Welcome($data));
        //sending response
        return response()->json(['status' => true, "user" => $user, "code" => $this->successStatus], $this->successStatus);
    }
    //update end point for user
    public function update(User $user, Request $request)
    {
        //check authorization for user
        $this->authorize('update', $user);
        //validate request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = $this->userRepository->update($user->id, $input);
        return response()->json(['status' => "updated", "user" => $user, "code" => $this->successStatus], $this->successStatus);
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
        $status = $this->userRepository->delete($user->id);
        return response()->json(['status' => $status, "code" => $this->successStatus], $this->successStatus);
    }

    public function view(User $user)
    {
        $this->authorize('view', $user);
        $user = $this->userRepository->find($user->id);
        return response()->json(['status' => true, 'user' => $user, "code" => $this->successStatus], $this->successStatus);
    }
}
