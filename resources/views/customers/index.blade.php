@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Customers</h1>
        @if(count($customers) > 0)
        <table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>photo</th>
                    <th>full name</th>
                    <th>full address</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>number of complaints</th>
                </tr>
            </thead>

                @php $id=0;@endphp
            <tbody>
                @foreach($customers as $customer)
                    @php $id++;@endphp
                <tr>
                    <td class="text-center">
                        {{$id}}
                    </td>
                    <td class="text-center">
                        <img src="{{$customer->getFirstMedia('photo') ? asset($customer->getFirstMedia('photo')->getFullUrl('thumb')) : $customer->photo }}" alt="empty" srcset="">
                    </td>
                    <td class="text-center">
                        {{$customer->fullName()}}
                    </td>
                    <td class="text-center">
                        {{$customer->fullAddress()}}
                    </td>
                    <td class="text-center">
                        {{$customer->phone}}
                    </td>
                    <td class="text-center">
                        {{$customer->email}}
                    </td>
                    <td class="text-center">
                        {{count($customer->complains)}}
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>
        {{$customers->links()}}
        @endif
    </div>
@endsection
