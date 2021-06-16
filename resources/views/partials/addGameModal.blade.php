<div id="addGameModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Add Match</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="match_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="match_f1">Friend 1</label>
                        <select class="form-control" name="match_f1" id="match_f1" required>
                            <option>-- Please Select a Friend --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="match_f1">Friend 2</label>
                        <select class="form-control" name="match_f2" id="match_f2" required>
                            <option>-- Please Select a Friend --</option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label for="match_winner">Winner</label>
                        <select class="form-control" name="match_winner" id="match_winner" required>
                            <option>-- Please Select a Friend --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="" id="match_noshow"> Win by absence?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-primary btn-sm" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>