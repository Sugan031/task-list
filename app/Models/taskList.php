<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taskList extends Model
{
    const PAGINATION = 10;
    use HasFactory;

    protected $fillable = ['title','description','long_description'];

    public function toggleComplete(){
        $this->completed  = !$this->completed;
        $this->save();
    }

    public function showValues(){
        return self::latest()->paginate(self::PAGINATION);
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
