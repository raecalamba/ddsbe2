<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class UserModel extends Model  {

    //name of table
    protected $table = 'tbluser';

    //column sa table
    protected $fillable = [ 
        'username', 'password', 'gender'
    ];

    //The code below will not require the field create_at and updated_at in lumen
    public $timestamps = false;


    // The code will customized your primary key field name, default in lumen is id
    protected $primaryKey = 'id';

    // fields that should be hidden like password
    // The attributes excluded from model's JSON form.
    protected $hidden = [
        'password',
    ];
}
