@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Managers!</h1>
        @if(count($managers) > 0)
        <table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>full name</th>
                    <th>phone</th>
                    <th>branch</th>
                </tr>
            </thead>

                @php $id=0;@endphp
            <tbody>
                @foreach($managers as $manager)
                    @php $id++;@endphp
                <tr>
                    <td class="text-center">
                        {{$id}}
                    </td>

                    <td class="text-center">
                        {{$manager->fullName()}}
                    </td>

                    <td class="text-center">
                        {{$manager->phone}}
                    </td>
                    <td class="text-center">
                        {{$manager->branch->branch_name}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$managers->links()}}
        @endif

    </div>
@endsection
