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
            <span class="text-capitalize">Shipping Zones</span>
            <small>[{{ $site->site_domain }}] Preview Shipping Zone: {{ $item['name'] }}.</small>
            <small class="">
                <a href="{{ route('shippings.index') }}?site_id={{ $site_id }}" class="font-sm">
                    <i class="la la-angle-double-left"></i> Back to all <span>Shipping Zones</span>
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
                            <?php foreach ($item as $field => $value ): ?>
                            <?php
                                if( in_array($field,['_links']) ){
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
                        </table>
                        <label class="pl-2"><strong>Shipping Methods</strong></label>
                        <table class="table table-striped mb-0">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Cost</th>
                                <th>Date delivery</th>
                                <th>Action</th>
                            </tr>
                            @foreach( $methods as $method )
                            <tr>
                                <td>{{ $method->id }}</td>
                                <td>{{ $method->title }}</td>
                                <td>{{ $method->settings->cost->value }}</td>
                                <td>
                                    {{
                                        $site->shipper_methods_options['shipper_methods'][$zone_id][$method->id]['date_delivery'] ?? 0;
                                    }}
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-link"
                                        href="{{ route('shippings.edit',$item['id']) }}?site_id={{ $site_id }}&method_id={{ $method->id }}">
                                        <i class="la la-eye"></i> Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
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