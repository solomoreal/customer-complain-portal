@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 >Complaints!</h1>
        @if(count($complaints) > 0)
        <table id="example" class="table table-striped table-bordered border-top-0 border-bottom-0" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>title</th>
                    <th>message</th>
                    <th>made by</th>
                    <th>status</th>
                </tr>
            </thead>

                @php $id=0;@endphp
            <tbody>
                @foreach($complaints as $complain)
                    @php $id++;@endphp
                <tr>
                    <td class="text-center">
                        {{$id}}
                    </td>

                    <td class="text-center">
                        {{$complain->title}}
                    </td>
                    <td class="text-center">
                        {{$complain->message}}
                    </td>
                    <td class="text-center">
                        {{$complain->customer->fullName()}}
                    </td>
                    <td class="text-center">
                        {{$complain->reviewed ? 'Reviewd' : 'Pending'}}
                    </td>

                </tr>
                @endforeach
            </tbody>


        </table>
        {{$complaints->links()}}
        @endif
    </div>
@endsection
