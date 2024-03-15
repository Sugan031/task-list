<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creator extends Model
{
    use HasFactory;


    // protected $fillable = ['name','email','password'];
    protected $guarded =[];

    public function login($email){
        return self::where('email', $email)->where('status','A')->first();
    }
    public function storeValues($data){
        return self::create($data);
    }
    public function profileValues($id){
        return self::where('id', $id)->first();
    }

    public function editEmail($id, $email){
        $data = self::find( $id );
        $data->update(['email'=> $email]);
        return $data;
    }

    public function updatePassword($id, $hashedpassword){
        $data = self::find( $id );
        $data->update(['password'=> $hashedpassword]);
        return $data;
    }
    public function getPassword($id){
        return self::select('password')->where('id', $id)->first();
    }

    public function updateDelete($id){
        $data = self::find( $id );
        
        $data->update(['status'=>'D']);
        return $data;
    }
  
}
