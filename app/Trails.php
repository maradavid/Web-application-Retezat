<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trails extends Model
{
    ///Table name ca sa schimb numele tabelului
    protected $table = 'trails';
    //Primary Key ca sa schim cheia primara id cu altceva ex. itemid, trebuie doar specificat dupa egal
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
