<div id="view_infrastructurecode_modal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <form method="post" id="view_infrastructurecode_form">
                    @csrf
                    <div class="form-group mt-4">

                        <label for="view_infrastructure_name" class="pull-left">Infrastructure Name:</label>

                        <input type="text" class="form-control" name="view_infrastructure_name"
                            id="view_view_infrastructure_name" placeholder="Infrastructure Name" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_infrastructure_code">Infrastructure Code:</label>
                        <input type="text" class="form-control " name="view_infrastructure_code"
                            id="view_infrastructure_code" placeholder="Infrastructure Code" readonly>
                    </div>


                    <div class="form-group mt-4" align="center">

                        <button type="button" class="btn btn-primary " id="view_cancel_button"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
