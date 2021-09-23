<div class="modal fade" id="edit_sub_agent_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="{{ route("sub-agents.update" , $user->id) }}" method="post">
        @csrf @method("put")
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit My Percent Share</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    
                    <p> Super Agent has {{ $user->percentage_split ?? $setting->value}}%</p>
                    <p>{{ $user->main_agent_share_raw ?? 0}}% share of the commission to the super agent</p>
                    <p> {{ $shareData["sub_agent_share"] ?? 0 }}% share of the commission to the sub agent</p>

                    <label class="text-muted">My Percentage Share</label>
                    <input type="number" class="form-control" step="0.25" value="{{ $user->main_agent_share_raw }}" name="my_share">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
