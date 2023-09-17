@extends('layouts.app')

@section('title', 'Laudry')
@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-nowrap border-bottom text-center"
                           id="responsive-datatable">
                        <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($types) > 0)
                            @foreach($types as $key=>$value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @if($value->status)
                                            <a href="javascript:void(0)"
                                               class="btn btn-success btn-pill btn-sm">Active</a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="btn btn-danger btn-pill btn-sm">Inactive</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection
