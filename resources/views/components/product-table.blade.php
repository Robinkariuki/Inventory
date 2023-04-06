<div class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">


  <!--Card-->
  <div id='recipients' class="p-8  mt-6 lg:mt-10 rounded shadow bg-white ">


    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
      <thead>
        <tr>
          <th data-priority="1">Brand</th>
          <th data-priority="2">Stock</th>
          <th data-priority="3">Status</th>
          <th data-priority="4">Price</th>
          
        </tr>
      </thead>
      <tbody>
        
          @foreach ($products as $product)
          <tr>
          <td>{{$product->Brand}}</td>
          <td>{{$product->Stock}}</td>
          <td>{{$product->Status}}</td>
          <td>$ {{$product->Price}}</td>
        </tr>
          @endforeach
     
   
        


      </tbody>

    </table>


  </div>
  <!--/Card-->


</div>

</div>