@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-lg">
                <div class="card-header  text-white">
                    Welcome, {{Auth::user()->name}}
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="images/profile-img-1.jpg" class="img-fluid rounded-circle" alt="Luna John">
                    </div>
                    <div class="h5 text-center">
                        <strong>{{Auth::user()->name}} </strong>
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



                <form action="{{ route('kundalis.uploadCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="m-3">
                        <label for="csv_file" class="form-label">Choose CSV file</label>
                        <input type="file" class="form-control col-5" id="csv_file" name="csv_file" required>
                        <button type="submit" class="btn btn-primary m-2 inline">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function deleteKundali(id) {
        if (confirm("Are you Sure You want to delete?")) {
            $.ajax({
                url: '{{route("kundalis.destroy")}}',
                type: 'delete',
                data: { id: id },
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function (response) {
                    window.location.href = '{{route("kundalis.index")}}';
                }
            })
        }
    }
</script>

@endsection
