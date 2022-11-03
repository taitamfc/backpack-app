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
            <span class="text-capitalize">Shipping Method</span>
            <small>[{{ $site->site_domain }}] : {{ $method['title'] }}.</small>
            <small class="">
                <a href="{{ route('shippings.show',$item['id']) }}?site_id={{ $site_id }}" class="font-sm">
                    <i class="la la-angle-double-left"></i> Back to all <span>Shipping Methods</span>
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
                            <?php foreach ($method as $field => $value ): ?>
                            <?php
                                if( in_array($field,['_links','settings']) ){
                                    continue;
                                }
                            ?>
                            <tr>
                                <td>
                                    <strong><?= ucfirst($field); ?></strong>
                                </td>
                                <td>
                                    <?php if( is_array($value) ): ?>
                                    <?php elseif( is_object($value)  ):?>
                                    <table>
                                        <?php foreach($value as $f => $v):?>
                                        <tr>
                                            <td><?= ucfirst($f); ?></td>
                                            <td><?= $v; ?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </table>
                                    <?php else: ?>
                                    <span> <?= $value; ?> </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td><strong>Date delivery</strong></td>
                                <td>{{ $date_delivery }}</td>
                            </tr>
                        </table>
                        <hr>
                        <form action="{{ route('shippings.update',$item['id']) }}?site_id={{ $site_id }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="method_id" value="{{ $method['id'] }}">
                            <input type="hidden" name="site_id" value="{{ $site_id }}">
                            <input type="hidden" name="zone_id" value="{{ $zone_id }}">
                            <div class="form-group col-sm-12">
                                <label>Date delivery</label>
                                <input class="form-control" type="number" name="date_delivery" value="{{ $date_delivery }}">
                            </div>
                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-success">Update</button>
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