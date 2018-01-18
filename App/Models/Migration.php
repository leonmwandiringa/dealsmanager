<?php
/**
 * @uses merge phinx migration with with eloquent query builder
 * @return schema object 
 */

    namespace DealsManager\Migrations\Core;

    use Illuminate\Database\Capsule\Manager as Capsule;
    use Phinx\Migration\AbstractMigration;

    class Migration extends AbstractMigration{

        protected $schema;

        public function init(){

            $this->schema = (new Capsule)->schema();

        }


    }

?>