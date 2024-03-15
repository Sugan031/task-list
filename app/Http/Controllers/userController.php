<?php

namespace App\Http\Controllers;

use App\Http\Requests\creatorRequest;
use App\Http\Requests\userRequest;
use App\Models\creator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class userController extends Controller
{

    private $user;
    public function __construct(creator $user) {
      $this->user = $user;
    }

    public function index(){
        return view("user.login");
    }

    public function login(Request $request){
        $data = $request->all();

        if(is_null($data)){
                return redirect()->back()->with("error","Please login with credentials");
        }
        else{
            $user = $this->user->login($data['email']);
            if(is_null($user)){
                return redirect()->back()->with("error","please login with suitable credentials or register");
            }
            else{
                if(Hash::check($data['password'],$user['password'])){
                    $request->session()->put('user', $user);
                    return redirect()->route('task.index')->with('success','Login successfull');
                }
                else{
                    return redirect()->back()->with("error","your password is wrong");
                }
            }

            }
        }

        public function register(userRequest $request){
            $data = $request->except('password_confirmation','_token');
            $data['password'] = Hash::make($request->input('password'));
            $user = $this->user->storeValues($data);
            $request->session()->put('user', $user);

            return redirect()->route('task.create', ['user' => $user])->with('success', ' You are registered successfully');
        }

        public function registerView(){
            return view("user.register");
        }

        public function profile($id){
            $user = $this->user->profileValues($id);
            return view("user.profile",["user"=> $user]);
        }

        public function edit(Request $request,$id){
            $password = $this->user->getPassword($id);
            $data= $request->except("_token");
            if(Hash::check($data['password'],$password['password'])){
                if(array_key_exists('email',$data)){
                $this->user->editEmail($id,$data['email']);
                return redirect()->route('user.profile',['id'=>$id])->with('success','email updated successfully');
                }
                else {
                    if($data['new_password']==$data['confirm_password']){
                        $hashedpassword = Hash::make($data['new_password']);
                        $this->user->updatePassword($id,$hashedpassword);
                        return redirect()->route('user.profile',['id'=>$id])->with('success','password updated successfully');
                    }
                    else{
                        return back()->with('mismatch_error','password mismatch');
                    }
                }
            }
            else{
                if(array_key_exists('email',$data)){
                    return back()->with('error','password incorrect');
                }
                else{
                    return back()->with('pass_error','password incorrect');
                }
            }
        }

        public function delete(Request $request,$id){
            $password = $this->user->getPassword($id);
            $data= $request->except("_token");
            if(Hash::check($data['password'],$password['password'])){
                $data =  $this->user->updateDelete($id);
                return redirect()->route('user.index')->with('success','your account deleted successfully');
            }
            else{
                return back()->with('delete_error','password incorrect');
            }
        }
        public function logout(){
            session()->forget("user");
            return redirect()->route("user.index");
        }
        public function krishnan(){
            print_r('success');exit;
        }


       

    }

