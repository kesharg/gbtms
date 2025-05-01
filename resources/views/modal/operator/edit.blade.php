<div id="operatorModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <span id="form_result"></span>

                <form method="post" id="operator_form">
                    @csrf
                    <div class="form-group mt-4">
                        <label for="operator_code">Operator Code:</label>
                        <input type="text" class="form-control " name="operator_code" id="operator_code"
                            placeholder="Operator Code">
                    </div>
                    <div class="form-group mt-4">
                        <label for="operator_name">Operator Name:</label>
                        <input type="text" class="form-control " name="operator_name" id="operator_name"
                            placeholder="Operator Name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="operator_url">Operator URL:</label>
                        <input type="text" class="form-control " name="operator_url" id="operator_url"
                            placeholder="Operator URL">
                    </div>
                    <div class="form-group mt-4">
                        <label for="color_code">Color Code:</label>
                        <input type="color" class="form-control " name="color_code" id="color_code"
                            placeholder="Color Code">
                    </div>

                    <div class="form-group mt-4" text-align="center">
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
