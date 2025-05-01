{{-- Coverage data by province for different technology --}}
<div class="modal fade " id="populationpenetrationModal" tabindex="-1" role="dialog" aria-labelledby="populationpenetrationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="populationpenetrationModalLabel">Population Penetration for coverage</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('print_population_coverage') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div>
                            <label>Select Generation Type:</label>
                            <select name="generation_for_population_penetration">
                                <option value="2g" selected="selected">2G</option>
                                <option value="3g">3G</option>
                                <option value="4g">4G</option>
                            </select><br/>
                            <label>Select Administration Type:</label>
                            <select name="administration_for_population_penetration">
                                <option value="province" selected="selected">Province</option>
                                <option value="district">District</option>
                                <option value="vdc">VDC</option>
                            </select><br/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Print</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
        </div>
    </div>
</div>