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
                            <th scope="col">My Share</th>
                            <th scope="col">My Percentage</th>
                            <th scope="col">Agent Percentage</th>
                            <th scope="col">Referral Code</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
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
                                    <td>{{ $user->main_agent_share_raw }}%</td>
                                    <td>{{ $user->main_agent_share_percent }}%</td>

                                    @if ($user->percentage_split == null)
                                        <td>{{ $setting->value }}%</td>
                                    @else
                                        <td>{{ $user->percentage_split }}%</td>
                                    @endif
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
                                                <a class="dropdown-item" data-toggle="modal" data-target="#edit_sub_agent_{{ $user->id }}"
                                                    href="javascript;;">Edit</a>
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
