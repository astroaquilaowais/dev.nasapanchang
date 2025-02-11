@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                   {{-- Welcome, {{Auth::user()->name}} --}}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John">
                    </div>
                    <div class="h5 text-center">
                        {{-- <strong>{{Auth::user()->name}}  </strong> --}}
                        <p class="h6 mt-2 text-muted">5 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-lg mt-3">
                <div class="card-header  text-white">
                    Navigation
                </div>
                <div class="card-body sidebar">
                    @include('layouts.sidebar')
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Record
                </div>
                <div class="card-body pb-0">
                    <a href="{{route("kundalis.create")}}" class="btn btn-primary">Add</a>
                    <a href="{{route("kundalis.upload")}}" class="btn btn-primary">Upload</a>
                    <a href="{{ route('kundalis.downloadCsv') }}" class="btn btn-primary">Download CSV</a>


                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Date of Birth</th>
                                <th>Time of Birth</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th >Action</th>
                            </tr>
                        <tbody>
                            @if ($kundalis->isNotEmpty())
                                @foreach ($kundalis as $kundali)
                                <tr>
                                    <td>{{$kundali->name}}</td>
                                    <td>{{$kundali->country}}</td>
                                    <td>{{$kundali->dob}}</td>
                                    <td>{{$kundali->tob}}</td>
                                     <td>
                                        {{-- <a href="edit-review.html" class="btn btn-primary btn-sm"><i
                                                class="fa-regular fa-pen-to-square"></i>
                                        </a> --}}
                                        <a href="{{route('kundalis.view_kundali',[$kundali->id])}}"  class="btn btn-danger btn-sm">View</a>
                                    </td>
                                     <td><a href="{{route('kundalis.edit',[$kundali->id])}}"  class="btn btn-danger btn-sm">edit</a></td>
                                    <td>
                                        {{-- <a href="edit-review.html" class="btn btn-primary btn-sm"><i
                                                class="fa-regular fa-pen-to-square"></i>
                                        </a> --}}
                                        <a href="#" onclick="deleteKundali({{$kundali->id}})" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                 <tr>
                                    <td colsapn="5">Kundali Not found</td>
                                 </tr>
                            @endif


                        </tbody>
                        </thead>
                    </table>
                    {{$kundalis->links()}}


                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function deleteKundali(id){
        if(confirm("Are you Sure You want to delete?")){
            $.ajax({
                url:'{{route("kundalis.destroy")}}',
                type:'delete',
                data:{id:id},
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                success:function(response){
                    window.location.href='{{route("kundalis.index")}}';
                }
            })
        }
    }
</script>

@endsection
