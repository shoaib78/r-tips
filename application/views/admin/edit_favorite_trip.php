<?php if(!empty($trip)): ?>  
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label class="col-md-4 control-label" for="title">Title</label>
                  <div class="col-md-6">
                    <input id="title" name="title" placeholder="Title" class="form-control input-md" type="text" value="<?php echo (!$trip->title) ? "" : $trip->title; ?>">
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label class="col-md-4 control-label" for="location">Location</label>
                  <div class="col-md-6">
                    <input id="location" name="location" placeholder="Location" class="form-control input-md" type="text" value="<?php echo (!$trip->location) ? "" : $trip->location; ?>">
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label class="col-md-4 control-label" for="check_in">Check In</label>
                  <div class="col-md-6">
                    <input id="check_in" name="check_in" placeholder="Check In" class="form-control input-md" type="text" value="<?php echo (!$trip->check_in) ? "" : $trip->check_in; ?>">
                </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <label class="col-md-4 control-label" for="name">Check Out</label>
                  <div class="col-md-6">
                    <input id="check_out" name="check_out" placeholder="Check Out" class="form-control input-md" type="text" value="<?php echo (!$trip->check_out) ? "" : $trip->check_out; ?>" >
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="form-group ">
                    <label class="col-md-4 control-label" for="name">Select Trip Picture</label>
                    <div class="col-md-6 ">       
                        <img src="" width="200">
                        <input id="userfile" name="userfile" type="file">
                        <span class="filename"></span>
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Modal footer-->
    <!--Modal footer-->
    <div class="modal-footer">
        <button class="btn btn-info">Edit Trip</button>
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
    </div>        
<?php else: ?>

<?php endif; ?> 