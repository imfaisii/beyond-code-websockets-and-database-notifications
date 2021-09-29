<style>
    .is-invalid {
        color: red;
        margin-left: 2%
    }

</style>
<div class="block IPaddressBlock">

    <div class="block-header">
        <h3 class="block-title">Enter the IP to give it access to the system </h3>
    </div>
    <div class="block-content block-content-full">
        <form id="AddIPaddressForm" action="{{ route('ip.store') }}" method="POST">
            <div class="row">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        You can add the IP addresses here to restrict their access to the system. Once the ip address is
                        added it can access the system, but the restrictions
                        are still there , according to the roles and permissions assigned
                    </p>
                </div>
                <div class="col-lg-8 col-xl-5">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary AddIP">
                                    <i class="fa fa-plus mr-1"></i> Add now
                                </button>
                            </div>
                            <input type="text" class="form-control IPaddress" minlength="7" maxlength="15" size="15"
                                pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$"
                                placeholder="IP address" name="ip_address" required="">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>