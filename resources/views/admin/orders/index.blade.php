@extends(backpack_view('blank'))
@section('content')
<style>
    main { width: 100%; }
</style>
<div class="page-custom" style="width:100%">
    <h2>
        <span class="text-capitalize">Orders</span>
        <small>[{{ $site->site_domain }}]</small>
    </h2>
    <div class="row mb-0">
          <div class="col-sm-6">
                <div class="d-print-none with-border">
                    <a href="{{ backpack_url('site') }}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label">
                        Back to sites</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table
                class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2 dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $orders as $order )
                    <tr>
                        <td>OrderID: {{ $order->id }}</td>
                        <td>{{ $order->date_created }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->total }}</td>
                        <td>
                            <a class="btn btn-sm btn-link" 
                            href="{{ route('orders.show',$order->id) }}?site_id={{ $site_id }}"
                            ><i class="la la-eye"></i> Show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection