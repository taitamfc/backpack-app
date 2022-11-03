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
            <small>Sync [{{ $type }}]</small>
            <small class="">
                <a href="{{ url()->previous()  }}" class="font-sm">
                    <i class="la la-angle-double-left"></i> Back to <span>previous</span>
                </a>
            </small>
        </h2>
    </section>
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card no-padding no-border">
                    <form id="syncApp" action="" method="get">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <ul class="list-group">
                            @foreach( $sites as $site )
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="site_settings"
                                        value="{{ $site->id }}" name="syncs[]"
                                        @checked( in_array($site->id,$synced_sites) )
                                    >
                                    <label class="form-check-label" for="site_settings">
                                        {{ $site->site_domain }}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                            <li class="list-group-item">
                                <button 
                                    @disabled( count($synced_sites)> 0 )
                                    id="sync_now"
                                    type="submit" class="btn btn-primary "
                                    onclick=" return confirm('Are you sure ?'); ">
                                    @if( count($synced_sites)> 0 )
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    @endif
                                    <span class="visually-hidden">SYNC NOW</span>
                                </button>

                                @if( count($synced_sites) > 0 )
                                <a class="btn btn-warning text-white float-right"
                                    href="{{ url()->previous()  }}"
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
    @if( count($synced_sites) > 0 )
    <script>
    var app = new Vue({
        el: '#syncApp',
        data: {
            ajaxUrl : "{{ route('syncs.doSync') }}",
            message: 'Hello Vue!'
        },
        methods: {
            syncItem: function(){
                    console.log('syncItem');
                    jQuery.ajax({
                        url: this.ajaxUrl,
                        method: 'POST',
                        dataType: 'JSON',
                        data : jQuery('#syncApp').serialize(),
                        success: (data) => {
                            if(data.next_step == 1){
                                this.syncItem();
                            }else{
                                jQuery('#sync_now').prop('disabled',false);
                                jQuery('#sync_now .spinner-border').remove();
                                alert(data.msg);
                            }
                        }
                    });
                }
        },
        mounted: function() {
            this.syncItem();
        }
    })
    </script>
    @endif
    @endsection