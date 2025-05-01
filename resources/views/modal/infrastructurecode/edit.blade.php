<div id="infrastructurecodeModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <span id="form_result"></span>

                <form method="post" id="infrastructurecode_form">
                    @csrf
                    <div class="form-group mt-4">

                        <label for="infrastructure_name" class="pull-left">Infrastructure Name:</label>

                        <input type="text" class="form-control" name="infrastructure_name" id="infrastructure_name"
                            placeholder="Infrastructure Name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="infrastructure_code">Infrastructure Code:</label>
                        <input type="text" class="form-control " name="infrastructure_code" id="infrastructure_code"
                            placeholder="Infrastructure Code">
                    </div>

                    <div class="form-group mt-4" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add"
                            style="width: 70px;" />
                        <button type="button" class="btn btn-primary " id="cancel_button"
                            data-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
