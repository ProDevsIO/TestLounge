<style>
    .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9;
    width: 100vw;
    height: 0% !important;
    background-color: #000;
}
</style>
<div class="col-xl-12">
    <div class="card card-shadow mb-4 ">
        <div class="card-header border-0">
            <div class="custom-title-wrap border-0 position-relative pb-2">
                <div class="custom-title">Sub Agents</div>
            </div>
        </div>
        <div class="card-body p-0">
            @include('errors.showerrors')
            <div class="table-responsive">
                <table class="table table-hover table-custom" id="{{ $id }}">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <!-- <th scope="col">My Share</th> -->
                            <th scope="col">Superagent Percentage</th>
                            <th scope="col">Sub-agent Percentage</th>
                            <th scope="col">Referral Code</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @php
                            $shareData = $user->superAgentPercent();
                        @endphp
                            @if ($user->status == $table_status)
                                <tr>
                                    <td>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>{{ $user->email }}</td>

                                    @if ($user->status == 1)
                                        <td><span class="badge badge-success">Active</span></td>
                                    @elseif($user->status == 0)
                                        <td><span class="badge badge-warning">Not Active</span></td>
                                    @endif
                                    <!-- <td>{{ $shareData["main_agent_share_raw"] ?? "N/A" }}%</td> -->
                                    <td>{{ $shareData["main_agent_share_percent"] ?? "N/A" }}%</td>
                                    <td>{{ $shareData["sub_agent_share"] ?? "N/A" }}%</td>
                                    <td>
                                        {{ $user->referal_code }}
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="{{ url('/view/agent/details/'.$user->id) }}">View </a>
                                            <a class="dropdown-item" href="{{ url('/view/sub-agent/transaction/'.$user->id) }}">View transaction</a>
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#edit_sub_agent_{{ $user->id }}"
                                                    href="javascript;;">Edit</a>
                                                    @if($user->status == 0)

                                                    <a href="javascript:;"
                                                    onclick="confirmation('{{ url('/agent/activate/' .$user->id) }}')"
                                                    class="dropdown-item">Activate</a>


                                                    @elseif($user->status == 1)

                                                    <a href="javascript:;"
                                                    onclick="confirmation('{{ url('/agent/deactivate/'.$user->id) }}')"
                                                    class="dropdown-item">Deactivate</a>
                                                    @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include("users.sub_agents.fragments.edit_modal" , ["user" => $user])
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
