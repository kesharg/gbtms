<div id="bandModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">
                <span id="form_result"></span>

                <form method="post" id="band_form">
                    @csrf
                    <div class="form-group mt-4">

                        <label for="band_code" class="pull-left">Band Code:</label>

                        <input type="text" class="form-control" name="band_code" id="band_code" placeholder="Band Code">
                    </div>
                    <div class="form-group mt-4">
                        <label for="band_name">Band Name:</label>
                        <input type="text" class="form-control " name="band_name" id="band_name"
                            placeholder="Band Name">
                    </div>
                    <div class="form-group mt-4">
                        <label for="band_category">Band Category:</label>
                        <input type="text" class="form-control " name="band_category" id="band_category"
                            placeholder="Band Category">
                    </div>
                    <div class="form-group mt-4">
                        <label for="tx_rx_frequency">Tx/Rx Frequency:</label>
                        <input type="text" class="form-control " name="tx_rx_frequency" id="tx_rx_frequency"
                            placeholder="Tx/Rx Frequency">
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
