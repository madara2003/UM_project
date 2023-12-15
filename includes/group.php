<div class="mb-5 d-inline-flex gap-4">
   <div>
    <button type="button" id="insert_data" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insert_edit_modal">Add</button>
   </div>
    <div class="group_container">
    <select class="form-select-top form-select" >
      <option value="0" selected>-- Please Select --</option>
      <option value="1">Set Active></option>
      <option value="2">Set Not Active</option>
      <option value="3">Delete</option>
    </select>
     <button type="button" id="<?php echo $indecator;?>"  class="btn btn-primary " data-bs-dismiss="modal">OK</button>
     </div>
</div>