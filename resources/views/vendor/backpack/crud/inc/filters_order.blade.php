<style>
    .table-top {
	display: none;
}
</style>
<?php
$f_request = $crud->custom_filter_request;
$custom_params = $crud->custom_params;
$f_request['status'] = $f_request['status'] ?? '';
$f_request['site_id'] = $f_request['site_id'] ?? '';
$sites = $custom_params['sites'] ?? [];
?>
<form action="" method="get">
    <div class="row mb-2">
        <div class="col-lg-3">
            <select class="form-control" name="site_id" id="">
                <option value="">All sites</option>
                @foreach( $sites as $site_id => $site_domain )
                <option @selected( $f_request['site_id'] == $site_id ) value="{{ $site_id }}">{{ $site_domain }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3">
            <select name="status" class="form-control">
                <option value="">All Order statues</option>
                <option value="pending" @selected( $f_request['status'] == 'pending' )>Pending payment</option>
                <option value="processing" @selected( $f_request['status'] == 'processing' )>Processing</option>
                <option value="on-hold" @selected( $f_request['status'] == 'on-hold' )>On hold</option>
                <option value="completed" @selected( $f_request['status'] == 'completed' )>Completed</option>
                <option value="cancelled" @selected( $f_request['status'] == 'cancelled' )>Cancelled</option>
                <option value="refunded" @selected( $f_request['status'] == 'refunded' )>Refunded</option>
                <option value="failed" @selected( $f_request['status'] == 'failed' )>Failed</option>
                <option value="checkout-draft" @selected( $f_request['status'] == 'checkout-draft' )>Draft</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="date" class="form-control" name="date_start" value="{{ $f_request['date_start'] ?? '' }}">
        </div>
        <div class="col-lg-2">
            <input type="date" class="form-control" name="date_end" value="{{ $f_request['date_end'] ?? '' }}">
        </div>
        <div class="col-lg-1 ">
            <button type="submit" class="btn btn-primary" style="float: right;">Search</button>
        </div>
    </div>
</form>