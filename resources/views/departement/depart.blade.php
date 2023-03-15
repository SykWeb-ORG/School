@extends('dash.blanck-page')
@section('body-content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>All Departements</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">All Departements</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-toggle="tab"
                                class="nav-link btn-primary mr-1 show active">List View</a></li>
                        <li class="nav-item"><a href="#grid-view" data-toggle="tab" class="nav-link btn-primary">Grid
                                View</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Departements </h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addnew" data-bs-whatever="@mdo">+ Add new</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nom de departement</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($departements as $depart)
                                                    <tr>
                                                        <td>{{ $depart->id }}</td>
                                                        <td>{{ $depart->departement_nom }}</td>
                                                        <td>
                                                            {{-- <button type="button" class="btn btn-sm btn-success">
                                                                <i class="la la-eye">
                                                                </i>
                                                            </button> --}}
                                                            <button type="button" value="{{ $depart->id }}"
                                                                class="btn btn-sm btnedit btn-success">
                                                                <i class="la la-pencil">
                                                                </i>
                                                            </button>
                                                            <button type="button" value="{{ $depart->id }}"
                                                                class="btn btn-sm btndelete btn-danger">
                                                                <i class="la la-trash-o">
                                                                </i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="grid-view" class="tab-pane fade col-lg-12">
                            <div class="row">
                                @foreach ($profs as $prof)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-profile">
                                            <div class="card-header justify-content-end pb-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-link" type="button" data-toggle="dropdown">
                                                        <span class="dropdown-dots fs--1"></span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right border py-0">
                                                        <div class="py-2">
                                                            <a class="dropdown-item" href="{{route('editprof',['id' => $prof->id])}}">Edit</a>
                                                            <form class="dropdown-item text-danger" method="POST" action="{{ route('deleteprof', ['id' => $prof->id]) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" value="Delete">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="card-body pt-2">
                                                    <div class="text-center">
                                                        <div class="profile-photo">
                                                            <img src="{{$prof->image}}" width="100" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <h3 class="mt-4 mb-1">{{$prof->prenom.' '.$prof->nom}}</h3>
                                                        <ul class="list-group mb-3 list-group-flush">
                                                            <li class="list-group-item px-0 d-flex justify-content-between">
                                                                <span class="mb-0">Genre :</span><strong>{{$prof->gender}}</strong></li>
                                                            <li class="list-group-item px-0 d-flex justify-content-between">
                                                                <span class="mb-0">Tel :</span><strong>{{$prof->tel}}</strong></li>
                                                            <li class="list-group-item px-0 d-flex justify-content-between">
                                                                <span class="mb-0">Email:</span><strong>{{$prof->user->email}}</strong></li>
                                                            <li class="list-group-item px-0 d-flex justify-content-between">
                                                                <span class="mb-0">Address:</span><strong>{{$prof->adresse}}</strong></li>
                                                        </ul>
                                                        <a class="btn btn-outline-primary btn-rounded mt-3 px-4" href="{{route('profileprof', ['id' => $prof->id])}}">Read More</a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- start modal add departement --}}
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Department</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('add_departement') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name department : </label>
                            <input type="text" class="form-control" id="recipient-name" name="departement_nom">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal add --}}
    {{-- start modal update departement --}}
    <div class="modal fade" id="update-department" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('update_departement') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id_department"/>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name department : </label>
                            <input type="text" class="form-control" id="departement-nom" name="departement_nom">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal update --}}
        {{-- start modal update departement --}}
        <div class="modal fade" id="delete-department" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Department</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('delete_departement') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="delete_id_department"/>
                            <div class="mb-3">
                                <h3 class="confirmation">Are you sure you want to delete this departement...?</h3>
                            </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Yes Delete</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal update --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.btnedit', function() {
                debugger
                var id = $(this).val();
                $('#update-department').modal('show');
                $('#id_department').val(id);
                $.ajax({
                    type: "GET",
                    url: "/edit_departement/" + id,
                    success: function(response) {
                        // console.log(response);
                        $('#departement-nom').val(response.departement.departement_nom);
                    }
                })
            });

            $(document).on('click','.btndelete', function () {
                var id = $(this).val();
                $('#delete-department').modal('show');
                $('#delete_id_department').val(id);
            });
        });
    </script>
@endsection
