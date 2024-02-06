@extends('layouts.admin')
@php
  //  $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
@endphp
@section('page-title')
    {{__('Manage Client')}}
@endsection
@push('script-page')
@endpush

<?php

use Illuminate\Support\Facades\DB;

try {
    // Establish a database connection
    $connection = DB::connection();

    // Execute a raw SQL query
    $results = $connection->select("SELECT * FROM clients");

    // Process the query results
    // foreach ($results as $result) {
    //     // Access each row of the query result
    //     echo $result->agent_name . "<br>";
    // }
} catch (\Exception $e) {
    // Handle any exceptions that occur during the database operation
    echo "Error: " . $e->getMessage();
}

?>

@section('breadcrumb')


    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Client')}}</li>
@endsection
@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="md" data-url="{{ route('clients.create') }}" data-ajax-popup="true"  data-bs-toggle="tooltip" title="{{__('Create Client')}}"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xxl-12">
        <!-- <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Agent Name</th>
      
    </tr>
  </thead>
  <tbody class="table-group-divider">


    
    
  </tbody>
</table> -->



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Client Name</th>
      <th scope="col">Passport No</th>
        <!-- <th scope="col">Agent</th> -->
        <th scope="col">Paid</th>
        <th scope="col">Due</th>
        <th scope="col">Status</th>
        <th scope="col">Attachment</th>
        <th scope="col">Agent</th>
      
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php
foreach ($results as $index => $result) {
    echo "<tr>";
    echo "<th scope=\"row\">" . $index+1 . "</th>";
    echo "<td>" . $result->client_name . "</td>";
    echo "<td>" . $result->passport_no . "</td>";
    echo "<td>" . $result->amount_paid . "</td>";
    echo "<td>" . $result->amount_due . "</td>";
    echo "<td>" . $result->status . "</td>";
    echo "<td>" . (!empty($result->attachment) ? $result->attachment : "N/A") . "</td>";
    $agent_name = DB::table('agents')->where('id', $result->agent_id)->value('agent_name');

    // Display the agent_name or "N/A" if it's empty
    echo "<td>" . (!empty($agent_name) ? $agent_name : "N/A") . "</td>";

    echo "</tr>";
}
?>

    
    
  </tbody>
</table>






        </div>
    </div>
@endsection

@push('script-page')
    <script>
        $(document).on('change', '#password_switch', function() {
            if ($(this).is(':checked')) {
                $('.ps_div').removeClass('d-none');
                $('#password').attr("required", true);

            } else {
                $('.ps_div').addClass('d-none');
                $('#password').val(null);
                $('#password').removeAttr("required");
            }
        });
        $(document).on('click', '.login_enable', function() {
            setTimeout(function() {
                $('.modal-body').append($('<input>', {
                    type: 'hidden',
                    val: 'true',
                    name: 'login_enable'
                }));
            }, 2000);
        });
    </script>
@endpush