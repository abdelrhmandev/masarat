<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use App\Models\OrphanAnswer;
class Path extends Model
{
    protected $fillable = ['tite','image'];
    protected $table = 'pathes';
     
    public function objectives(){
             return $this->hasMany(Objective::class);
    }   
 
    public function category(){
        return $this->hasOne(OrphanPath::class,'path_id','id')->where('form_id',3)->where('path_id',1);
    }  

}
