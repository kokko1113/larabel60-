<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $fillable=[
        "setmenu_id",
        "item_id",
    ];
    public function setmenu(){
        return $this->belongsTo(Setmenu::class,"setmenu_id");
    }
    public function item(){
        return $this->belongsTo(Item::class,"item_id");
    }
}
