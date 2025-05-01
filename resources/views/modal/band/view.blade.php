<div id="view_band_modal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <form method="post" id="view_band_form">
                    @csrf
                    <div class="form-group mt-4">

                        <label for="view_band_code" class="pull-left">Band Code:</label>

                        <input type="text" class="form-control" name="view_band_code" id="view_band_code"
                            placeholder="Band Code" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_band_name">Band Name:</label>
                        <input type="text" class="form-control " name="view_band_name" id="view_band_name"
                            placeholder="Band Name" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_band_category">Band Category:</label>
                        <input type="text" class="form-control " name="view_band_category" id="view_band_category"
                            placeholder="Band Category" readonly>
                    </div>
                    <div class="form-group mt-4">
                        <label for="view_tx_rx_frequency">Tx/Rx Frequency:</label>
                        <input type="text" class="form-control " name="view_tx_rx_frequency" id="view_tx_rx_frequency"
                            placeholder="Tx/Rx Frequency" readonly>
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
