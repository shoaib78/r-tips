<?php if(!empty($categories)): ?>
	<div class="modal-body">
		<div class="row">
			  <div class="col-md-12">
			    
			      <div class="form-group">
			        <label class="col-md-4 control-label" for="name">Category</label>
			        <div class="col-md-4">
			          <input id="category" name="category" placeholder="Category" class="form-control input-md" type="text" value = "<?php echo ($categories->category)?$categories->category:'' ?>" required>
			          <span class="help-block"><small></small></span> </div>
			           <input id="category_id" name="category_id" type="hidden" value = "<?php echo ($categories->category_id)?$categories->category_id:'' ?>">
			      </div>
		
			  </div>
			</div>
	</div>

	<!--Modal footer-->
	<!--Modal footer-->
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
		<button class="btn btn-info">Save Category</button>
	</div>
<?php else: ?>
	<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p><p>No data are found!!</p></div>
<?php endif; ?>