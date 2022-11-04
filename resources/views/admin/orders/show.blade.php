@extends(backpack_view('blank'))
@section('content')
<style>
main {
    width: 100%;
}
</style>
<div class="page-custom" style="width:100%">
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize">Orders</span>
            <small>Preview order.</small>
            <small class="">
                <a href="{{ route('orders.index') }}?site_id={{ $site_id }}" class="font-sm">
                    <i class="la la-angle-double-left"></i> Back to all <span>orders</span>
                </a>
            </small>
        </h2>
    </section>
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="card no-padding no-border">
                        <table class="table table-striped mb-0">
                            @foreach( $order as $field => $value )
                            <?php
                                if( in_array($field,['_links']) ){
                                    continue;
                                }
                            ?>
                            <tr>
                                <td>
                                    <strong><?= $field; ?></strong>
                                </td>
                                <td>
                                    <?php if( is_array($value) ): ?>
                                    <?php
                                            // echo '<pre>';
                                            // print_r($value);    
                                            // echo '</pre>';    
                                        ?>
                                    <?php elseif( is_object($value)  ):?>
                                    <table>
                                        <?php foreach($value as $f => $v):?>
                                        <tr>
                                            <td><?= $field.'_'.$f; ?></td>
                                            <td><?= $v; ?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </table>
                                    <?php else: ?>
                                    <span> <?= $value; ?> </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <hr>
                        <form action="{{ route('orders.update',$order['id']) }}?site_id={{ $site_id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group col-sm-12">
                                <label>Order Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending" @selected( $order['status'] == 'pending' )>Pending payment</option>
                                    <option value="processing" @selected( $order['status'] == 'processing' )>Processing</option>
                                    <option value="on-hold" @selected( $order['status'] == 'on-hold' )>On hold</option>
                                    <option value="completed" @selected( $order['status'] == 'completed' )>Completed</option>
                                    <option value="cancelled" @selected( $order['status'] == 'cancelled' )>Cancelled</option>
                                    <option value="refunded" @selected( $order['status'] == 'refunded' )>Refunded</option>
                                    <option value="failed" @selected( $order['status'] == 'failed' )>Failed</option>
                                    <option value="checkout-draft" @selected( $order['status'] == 'checkout-draft' )>Draft</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-success">Update order</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('after_scripts')
    @if($msg == 'OK')
    <script>
    new Noty({
        type: "success",
        text: 'Updated successfully !',
    }).show();
    </script>
    @endif
@endsection