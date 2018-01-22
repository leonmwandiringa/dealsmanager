<?php
/**
 * @uses handle the users table
 * @return mixed abstract users table handle
 */

    namespace DealsManager\Models;
    use Illuminate\Database\Eloquent\Model;

    class User extends Model{

        protected $fillable = ['name','email','password','tokenvalue','tokendate'];

        protected $table = "users";

    }

?>