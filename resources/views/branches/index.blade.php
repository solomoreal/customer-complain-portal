@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Branches!</h1>
        @if(count($branches) > 0)
        <table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Manager</th>
                    <th>Location</th>
                    <th>phone</th>
                    <th>email</th>
                    <th>number of complaints</th>
                </tr>
            </thead>

                @php $id=0;@endphp
            <tbody>
                @foreach($branches as $branch)
                    @php $id++;@endphp
                <tr>
                    <td class="text-center">
                        {{$id}}
                    </td>
                    <td class="text-center">
                        {{$branch->branch_name}}
                    </td>
                    <td class="text-center">
                        {{$branch->manager ? $branch->manager->fullName() :'' }}
                    </td>
                    <td class="text-center">
                        {{$branch->fullAddress()}}
                    </td>
                    <td class="text-center">
                        {{$branch->phone}}
                    </td>
                    <td class="text-center">
                        {{$branch->email}}
                    </td>
                    <td class="text-center">
                        {{count($branch->complaints)}}
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>
        {{$branches->links()}}
        @endif
    </div>
@endsection
