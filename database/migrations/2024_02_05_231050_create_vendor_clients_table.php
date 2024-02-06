// database/migrations/yyyy_mm_dd_create_vendor_clients_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorClientsTable extends Migration
{
    public function up()
    {
        Schema::create('vendor_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('companyDetails');
            $table->string('project_image')->nullable();
            $table->decimal('totalPaid', 10, 2)->nullable();
            $table->decimal('totalDue', 10, 2)->nullable();
            // Add other fields as needed

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor_clients');
    }
}
