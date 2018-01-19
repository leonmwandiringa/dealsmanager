<?php
/**
 * @return mixed igration starter
 * @uses subclass for the migration class and return migration db starter
 */

    use $useClassName;
    use Illuminate\Database\Schema\Blueprint;

    class $className extends $baseClassName{

        //create table method
        public function up(){

            $this->schema->create('', function(Blueprint $table){

                $table->increments('id');
                $table->timestamps();

            });
        }

        public function down(){

            $this->schema->drop('');

        }


    }

?>