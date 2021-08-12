@extends('layout.admin')
@section('title','Profiles')

<style>
    .input-sm{
        width: 100% !important;
        float:right !important;
    }
    #example_filter{
        padding-left: 266px;
        padding-right: 20px;
    }
</style>

@section('contentBody')
    
    <div class="card">
        <div class="card-header">
            <h2>Employee Table</h2>
        </div>
        <div class="card-body table-responsive">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Designation</th>
                        <th>Employee Id</th>
                        <th>Phone</th>
                        <th>Profile Pic</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 0 ; ?>
                @foreach( $profiles as $profile )
                    <?php $i++?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                        {{ $profile->first_name }} {{ $profile->middle_name }} {{ $profile->last_name }}
                        </td>
                        <td>{{ $profile->designation_name }}</td>
                        <td>{{ $profile->employee_id }}</td>
                        <td>{{ $profile->phone }}</td>
                        <td> 
                        <img class="img-responsive" height="200" width="100" src="{{ url('uploads/profile_pic', $profile->profile_pic ) }}" alt="">

                        </td>

                        <td> 
                            <a href="{{ url('profile',$profile->employee_id) }}">
                                <i class="fa fa-eye custom-font" aria-hidden="true"></i>
                            </a> 

                            <a href="{{ url('profile', [$profile->employee_id,'edit']) }}" class=""><i class="fa fa-pencil custom-font" aria-hidden="true"></i></a>
                            
                            <a href="{{ url('profile',$profile->employee_id) }}" data-method="delete" 
                            data-token="{{ csrf_token() }}" data-confirm="Are you sure?"><i class="fa fa-trash-o text-danger custom-font" aria-hidden="true"></i></a>

                        </td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>


<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable();
} );

$('#example')
.removeClass( 'display' )
.addClass('table table-striped table-bordered');

</script>

@endsection