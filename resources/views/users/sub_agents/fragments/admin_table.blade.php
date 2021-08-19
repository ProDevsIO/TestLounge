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
                            <th scope="col">Agent Name</th>
                            <th scope="col">Super Agent Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Super Agent Share</th>
                            <th scope="col">Super Agent Percentage</th>
                            <th scope="col">Agent Percentage</th>
                            <th scope="col">Referral Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @php
                            $shareData = $user->superAgentShare();
                        @endphp
                            @if ($user->status == $table_status)
                                <tr>
                                    <td>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td>
                                        {{ $user->superAgent->first_name }} {{ $user->superAgent->last_name }}
                                    </td>
                                    <td>{{ $user->phone_no }}</td>
                                    <td>{{ $user->email }}</td>

                                    @if ($user->status == 1)
                                        <td><span class="badge badge-success">Active</span></td>
                                    @elseif($user->status == 0)
                                        <td><span class="badge badge-warning">Not Active</span></td>
                                    @endif
                                    <td>{{ $shareData["main_agent_share_raw"] ?? "N/A" }}%</td>
                                    <td>{{ $shareData["main_agent_share_percent"] ?? "N/A" }}%</td>
                                    <td>{{ $shareData["sub_agent_share"] ?? "N/A" }}%</td>
                                    <td>
                                        {{ $user->referal_code }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
