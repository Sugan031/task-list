<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class taskList extends Model
{
    const PAGINATION = 5;
    use HasFactory;

    protected $fillable = ['title','description','long_description','creator_id'];

    public function toggleComplete(){
        $this->completed  = !$this->completed;
        $this->save();
    }

    public function showValues($id){
        return self::where('creator_id',$id)->latest()->paginate(self::PAGINATION); 
    }

    public function filterValues($id,$completed){
        return self::where('creator_id',$id)->where('completed',$completed)->latest()->paginate(self::PAGINATION); 
    }



    public function storeValues($data){
        return self::create($data);
    }

    public function updateValues($data){
        return self::update($data);
    }

    public function deleteValues(){
        return self::delete();
    }
}
