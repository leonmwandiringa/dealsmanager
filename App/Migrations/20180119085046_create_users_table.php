<?php
/**
 * @return mixed igration starter
 * @uses subclass for the migration class and return migration db starter
 */

    use DealsManager\Migrations\Core\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUsersTable extends Migration{

        //create table method
        public function up(){

            $this->schema->create('users', function(Blueprint $table){

                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('email');
                $table->string('password', 250);
                $table->longText('tokenvalue', 250);
                $table->string('tokendate');
                $table->timestamps();

            });
        }

        public function down(){

            $this->schema->drop('users');

        }


    }

?>