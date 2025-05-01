<div id="view_operator_modal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <form method="post" id="view_operator_form">
                    @csrf
                    <div class="form-group mt-4">

                        <label for="view_operator_id" class="pull-left">Operator Id:</label>

                        <input type="text" class="form-control" name="view_operator_id" id="view_operator_id"
                            placeholder="Operator Id" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_operator_code">Operator Code:</label>
                        <input type="text" class="form-control " name="view_operator_code" id="view_operator_code"
                            placeholder="Operator Code" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_operator_name">Operator Name:</label>
                        <input type="text" class="form-control " name="view_operator_name" id="view_operator_name"
                            placeholder="Operator Name" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_operator_url">Operator URL:</label>
                        <input type="text" class="form-control " name="view_operator_url" id="view_operator_url"
                            placeholder="Operator URL" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="color_code">Color Code:</label>
                        <input type="text" class="form-control " name="view_color_code" id="view_color_code"
                            placeholder="Color Code" readonly>
                    </div>


                    <div class="form-group mt-4" text-align="center">

                        <button type="button" class="btn btn-primary " id="view_cancel_button"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
