<div class='container w-full md:w-4/5 xl:w-3/5  mx-auto px-2 mt-5'>

  <!-- Modal -->
  <div id="updateModal" class="modal fade"  role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Update</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button> 
             </div>
             <div class="modal-body">
                 <div class="form-group">
                     <label for="name" >Brand</label>
                     <input type="text" class="form-control" id="Brand" placeholder="Enter Brand Name" required> 
                 </div>
                 <div class="form-group">
                     <label for="Stock" >Stock</label> 
                     <input type="number" class="form-control" id="Stock" placeholder="Enter Stock"> 
                 </div> 
                 <div class="form-group">
                     <label for="Status" >Status</label>
                     <select id='Status' class="form-control">
                         <option value='Available'>Available</option>
                         <option value='Unavailable'>Unavailable</option>
                     </select> 
                 </div> 
                <div class="form-group">
                     <label for="Price" >Price</label> 
                     <input type="number" class="form-control" id="Price" placeholder="Enter Price"> 
                </div>

             </div>
             <div class="modal-footer">
                 <input type="hidden" id="txt_empid" value="0">
                 <button type="button" class="btn btn-success btn-sm" id="btn_save">Save</button>
                 <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Close</button>
             </div>
        </div>

      </div>
  </div>
 <!--Card-->
 <div id='recipients' class="p-8  mt-6 lg:mt-10 rounded shadow bg-white ">
  <!-- Table -->
  <table id='empTable' class="datatable stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
      <thead >
        <tr>
          <th data-priority="1">Brand</th>
          <th data-priority="2">Stock</th>
          <th data-priority="3">Status</th>
          <th data-priority="4">Price</th>
          <th data-priority="5">Action</th>
        </tr>
      </thead>
  </table>
 </div>
</div>
