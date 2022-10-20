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
            <span class="text-capitalize">Sites</span>
            <small>Sync [{{ $site->site_domain }}]</small>
            <small class="">
                <a href="{{ backpack_url('site') }}" class="font-sm">
                    <i class="la la-angle-double-left"></i> Back to all <span>sites</span>
                </a>
            </small>
        </h2>
    </section>
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card no-padding no-border">
                    <form id="syncApp" action="" method="get">
                        <ul class="list-group">
                            @foreach( $syncs as $sync_key => $sync_val )
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input 
                                    <?= ( count($synced_keys)> 0 || $sync_key == 'init_settings') ? 'onclick="return false;"' : '' ?>
                                    @checked( in_array($sync_key,$synced_keys) || $sync_key == 'init_settings' )
                                    class="form-check-input" type="checkbox" id="{{ $sync_key }}"
                                    value="{{ $sync_key }}" name="syncs[]">
                                    <label class="form-check-label" for="{{ $sync_key }}">
                                        {{ $sync_val }}
                                    </label>
                                </div>
                                <div style="display:none;" class="spinner-border spinner-border-sm sync_{{ $sync_key }}"></div>
                            </li>
                            @endforeach
                            <li class="list-group-item">
                                <button @disabled( count($synced_keys)> 0 )
                                    type="submit" class="btn btn-primary"
                                    onclick=" return confirm('Are you sure ?'); ">SYNC NOW</button>

                                @if( count($synced_keys) > 0 )
                                <a class="btn btn-warning text-white float-right"
                                    href="{{ backpack_url('site') }}/sync/{{ $site_id }}"
                                    onclick=" return confirm('Are you sure stop ?'); ">STOP</a>

                                @endif
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        </dv>
    </div>
    @endsection

    @section('after_scripts')
    @if( count($synced_keys) > 0 )
    <script>
        var app = new Vue({
            el: '#syncApp',
            data: {
                ajaxUrl : "{{ route('syncs.syncAjax',$site_id) }}",
                message: 'Hello Vue!'
            },
            methods : {
                syncItem: function(){
                    jQuery.ajax({
                        url: this.ajaxUrl,
                        method: 'POST',
                        dataType: 'JSON',
                        data : jQuery('#syncApp').serialize(),
                        success: (data) => {
                            console.log(data);
                            let sync_type = data.sync_type;
                            jQuery('.sync_'+sync_type).show();
                        }
                    });
                }
            },
            mounted: function () {
                this.syncItem();
            }
        })
    </script>
    @endif
    @endsection
