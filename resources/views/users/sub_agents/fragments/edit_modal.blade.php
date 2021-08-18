<div class="modal fade" id="edit_sub_agent_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
                    <small class="text-muted">My Percentage Share</small>
                    <input type="range" value="{{ $user->main_agent_share_raw }}" name="my_share" class="form-control" min="0" max="100"
                        id="exampleInputEmail1" placeholder="How much percent would you take for yourself?"  onInput="$('#rangeval').html($(this).val())" required>
                    <span id="rangeval">{{ $user->main_agent_share_raw }}</span>%
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
