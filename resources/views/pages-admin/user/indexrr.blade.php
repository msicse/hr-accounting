@extends('layout.admin')
@section('title','Admin | Profile Create')
@section('styles')

<style>
	#example_filter .form-control{
		text-align: right;
	}
	#myInput {
    background-image: url('/css/searchicon.png'); /* Add a search icon to input */
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 100%; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
    border-collapse: collapse; /* Collapse borders */
    width: 100%; /* Full-width */
    border: 1px solid #ddd; /* Add a grey border */
    font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
    text-align: left; /* Left-align text */
    padding: 12px; /* Add padding */
}

#myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
}

</style>


@endsection
@section('contentBody')

<div class="card">
    <div class="card-header">
	    <h2>Selection Example</h2>
    </div>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
     <table id="myTable">
		<tr class="header">
	    	<th>Name</th>
	    	<th>Email</th>
	    	<th>Employee ID</th>
	    	<th>Action</th>
	  	</tr>
	  	@foreach($users as $user)
	  	<tr>
	   		<td>{{ $user->name }}</td>
	   		<td>{{ $user->email }}</td>
	   		<td>{{ $user->profile_id }}</td>
	   		<td>
	   			<a href="{{ route('user.show',[$user->id] ) }}">show</a>
	   		</td>
	  	</tr>
	  	@endforeach
	  
	</table>
	
</div>

@endsection


@section('scripts')

<script type="text/javascript">

	function myFunction() {
	  // Declare variables
	  var input, filter, table, tr, td, i, j, sample;

	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");

	  // Loop through all table rows, and hide those who don't match the search query
	  

	for(i=0; i< tr.length; i++){
		td = table.getElementsByTagName("td")
	    for(j=0; j<td.length; j++){
	        sample = td[j];
	        if(sample)
	            {
	                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        			tr[i].style.display = "";
	      			} else {
	        			tr[i].style.display = "none";
	      			}
	            }
	    }
	}


	  // for (i = 0; i < tr.length; i++) {
	  //  // td = tr[i].getElementsByTagName("td")[0];
	  //  td = table.getElementsByTagName("td")

	  //   if (td) {
	  //     if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	  //       tr[i].style.display = "";
	  //     } else {
	  //       tr[i].style.display = "none";
	  //     }
	  //   }
	  // }
	}

</script>

@endsection