<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<title>How to add Edit Delete button in Yajra DataTables – Laravel</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"/>
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/> --}}
   <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">

	<script src="//unpkg.com/alpinejs" defer></script>


   <!--Regular Datatables CSS-->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<!--Responsive Extension Datatables CSS-->
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

	<style>
		/*Overrides for Tailwind CSS */

		/*Form fields*/
		.dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
			color: #4a5568;
			/*text-gray-700*/
			padding-left: 1rem;
			/*pl-4*/
			padding-right: 1rem;
			/*pl-4*/
			padding-top: .5rem;
			/*pl-2*/
			padding-bottom: .5rem;
			/*pl-2*/
			line-height: 1.25;
			/*leading-tight*/
			border-width: 2px;
			/*border-2*/
			border-radius: .25rem;
			border-color: #edf2f7;
			/*border-gray-200*/
			background-color: #edf2f7;
			/*bg-gray-200*/
		}

		/*Row Hover*/
		table.dataTable.hover tbody tr:hover,
		table.dataTable.display tbody tr:hover {
			background-color: #ebf4ff;
			/*bg-indigo-100*/
		}

		/*Pagination Buttons*/
		.dataTables_wrapper .dataTables_paginate .paginate_button {
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Pagination Buttons - Current selected */
		.dataTables_wrapper .dataTables_paginate .paginate_button.current {
			color: #fff !important;
			/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
			/*shadow*/
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			background: #667eea !important;
			/*bg-indigo-500*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Pagination Buttons - Hover */
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
			color: #fff !important;
			/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
			/*shadow*/
			font-weight: 700;
			/*font-bold*/
			border-radius: .25rem;
			/*rounded*/
			background: #667eea !important;
			/*bg-indigo-500*/
			border: 1px solid transparent;
			/*border border-transparent*/
		}

		/*Add padding to bottom border */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;
			/*border-b-1 border-gray-300*/
			margin-top: 0.75em;
			margin-bottom: 0.75em;
		}

		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
		table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #667eea !important;
			/*bg-indigo-500*/
		}
	</style>
</head>

<body  class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
	<x-flash-message/>
    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
        <path strokeLinecap="round" strokeLinejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0112 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
      </svg>
       --}}
    <nav class="flex items-center justify-between flex-wrap bg-teal-500 p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="/" class="font-semibold text-xl tracking-tight hover:text-white">Inventory</a>
          </div>
          <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
			@auth
            <div class="text-sm lg:flex-grow">
                <a href="/product/create" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                 Add products
                </a>
            </div>
			<div>
                <span class="inline-block text-sm  text-teal-200 hover:text-white mr-4">welcome {{auth()->user()->name}}</span>

              </div>
            @else
            <div>
                <a href="/register" class="inline-block text-sm  text-teal-200 hover:text-white mr-4">Register</a>
                <a href="/login" class="inline-block text-sm  text-teal-200 hover:text-white mr-4">Login</a>
              </div>
          </div>
		  @endauth
    </nav>
  <main>
    {{$slot}}
  </main> 
  	   <!-- Script -->
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
		 {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
		 {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
	<script type="text/javascript">
	 // CSRF Token
	 var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
	 $(document).ready(function(){
	 //initialize 
	 var empTable = $('#empTable').DataTable({
		responsive:true,
		processing:true,
		serverSide:true,
		ajax:"{{ route('getDataTableData') }}",
		columns:[
			
			{data:'Brand'},
			{data:'Stock'},
			{data:'Status'},
			{data:'Price'},
			{data: 'action'},

		]
	 })
	 .columns.adjust()
	 .responsive.recalc();
	 

	 //update record
     $('#empTable').on('click','.updateProduct',function(){
		var id = $(this).data('id');
		$('#txt_empid').val(id);
		 //Ajax request
		 $.ajax({
			url:"{{route('getProductData')}}",
			type:'post',
			data:{_token:CSRF_TOKEN,id:id},
			dataType:'json',
			success:function(response){
				if(response.success == 1){
				 $('#Brand').val(response.Brand);
				 $('#Stock').val(response.Stock);
				 $('#Status').val(response.Status);
				 $('#Price').val(response.Price);
				 
				 empTable.ajax.reload();
				 
				}else{
					alert("invalid ID.");
				}

			}
		 });
	 });
      
	 //save Product
   $('#btn_save').click(function(){
	  var id = $('#txt_empid').val();

	  var Brand = $('#Brand').val().trim();
	  var Stock = $('#Stock').val().trim();
	  var Status = $('#Status').val().trim();
	  var Price = $('#Price').val().trim();

	  if(Brand !='' && Stock != '' && Status != '' && Price != ''){
		 // AJAX request
       $.ajax({
		url:"{{ route('updateProduct') }}",
		type:'post',
		data:{_token:CSRF_TOKEN,id:id,Brand:Brand,Stock:Stock,Status:Status,Price:Price},
		dataType:'json',
		success:function(response){
			if(response.success == 1){
				alert(response.msg);
            
		// Empty and reset the values
		$('#Brand','#Stock','#Price').val('');
		$('#Status').val('Available');
		$('#txt_empid').val(0);

		 // Reload DataTable
		 empTable.ajax.reload();

		 //close modal
		 $('#updateModal').modal('toggle');
		 

			}else{
				alert(response.msg);
			}
		}
	   });

	  }else{
		alert('Please fill all fields')
	  } 
	});


     // Delete Product
    
	 $('#empTable').on('click','.deleteProduct',function(){
		  var id = $(this).data('id');
		  var deleteConfirm = confirm("Are you sure?");

		if(deleteConfirm == true){
			//AJAX request
			$.ajax({
				url:"{{route('deleteProduct')}}",
				type:'post',
				data:{_token:CSRF_TOKEN,id:id},
				success:function(response){
					if(response.success == 1){
						alert(response.msg);

						//Reload DataTable
						empTable.ajax.reload();

					}else{
						alert("Invalid ID.");
					}
				}
			});
		}
	 });

	
	});
	</script>
</body>
</html>