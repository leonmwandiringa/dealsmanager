<?php
/**
 * @return mixed igration starter
 * @uses subclass for the migration class and return migration db starter
 */

    use DealsManager\Migrations\Core\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateDealsTable extends Migration{

        //create table method
        public function up(){

            $this->schema->create('weekly_deals', function(Blueprint $table){

                $table->increments('id');
                $table->string('sub_date', 250)->nullable();
                $table->string('promotion_type', 250)->nullable();
                $table->string('offer_name', 500)->nullable();
                $table->string('locale', 250)->nullable();
                $table->string('start_date', 250)->nullable();
                $table->string('start_time', 250)->nullable();
                $table->string('end_date', 250)->nullable();
                $table->string('end_time', 250)->nullable();
                $table->string('title', 500)->nullable();
                $table->string('body_copy', 500)->nullable();
                $table->string('cta', 500)->nullable();
                $table->string('url', 1000)->nullable();
                $table->string('ocid', 1000)->nullable();
                $table->string('image', 1000)->nullable();
                $table->string('asset_url', 1000)->nullable();
                $table->string('note', 1000)->nullable();
                $table->string('status', 250)->nullable();
                $table->timestamps();

            });
        }

        public function down(){

            $this->schema->drop('weekly_deals');

        }


    }

?>