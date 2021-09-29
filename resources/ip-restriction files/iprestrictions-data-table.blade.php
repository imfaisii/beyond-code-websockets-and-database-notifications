<style>
    .swal2-confirm {
        margin-left: 1%;
        margin-top: 1%
    }

</style>
<div class="block IPaddressBlockDT">
    <div class="block-header">
        <h3 class="block-title">Enter the IP to give it access to the system </h3>
    </div>
    <div class="table-responsive">
        <table id="ipaddressestable" class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>IP address</th>
                    <th>Added by</th>
                    <th>Added on</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ips as $ip)
                    <tr id="{{ $ip->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ip->address }}</td>
                        <td>{{ $ip->user->name }}</td>
                        <td>{{ $ip->created_at }}</td>
                        <td class="text-center"><button class="btn btn-danger"
                                onclick="deleteIpAddress('{{ route('ip.destroy', [$ip->id]) }}','{{ $ip->id }}')"><i
                                    class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
