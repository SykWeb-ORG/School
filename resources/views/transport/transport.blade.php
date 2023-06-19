@extends('dash.blanck-page')
@section('body-content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Tous les transports</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Tous les transports</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Tous les transports</h4>
                                    <button type="button" class="btn btn-primary btn-show-modal-add" data-bs-toggle="modal"
                                        data-bs-target="#addnew" data-bs-whatever="@mdo">+ Ajouter transport</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        @if (session()->has('message'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Matricule</th>
                                                    <th>Status</th>
                                                    <th>Visite Technique</th>
                                                    <th>Chauffeur</th>
                                                    <th colspan="2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_transport">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- start modal add --}}
    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Ajouter transport</h5>
                </div>
                <div class="modal-body">
                    <form id="modal-add-edit">
                        <div class="mb-3">
                            <label for="matricule" class="col-form-label">Matricule </label>
                            <input type="text" id="matricule" class="form-control" name="matricule">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="col-form-label">Status </label>
                            <input type="text" id="status" class="form-control" name="status">
                        </div>
                        <div class="mb-3">
                            <label for="tech-visit" class="col-form-label">Visite Technique </label>
                            <input type="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" id="tech-visit" class="form-control" name="tech_visit">
                        </div>
                        <div class="mb-3">
                            <label for="model" class="col-form-label">Modele </label>
                            <input type="text" id="model" class="form-control" name="model">
                        </div>
                        <div class="mb-3">
                            <label for="tax" class="col-form-label">Taxe </label>
                            <input type="number" id="tax" class="form-control" step="0.01" name="tax" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="nb-places" class="col-form-label">Nombre De Places </label>
                            <input type="number" id="nb-places" class="form-control" name="nb_places" min="1">
                        </div>
                        <div class="mb-3">
                            <label for="drivers" class="col-form-label">Chauffeur </label>
                            <select class="form-control" id="drivers" name="driver">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total-price" class="col-form-label">Montant </label>
                            <input type="number" class="form-control" id="total-price" name="total_price" min="0">
                        </div>
                        <div class="mb-3">
                            <label for="paid-price" class="col-form-label">Versement </label>
                            <input type="number" class="form-control"name="paid_price" id="paid-price"  min="0">
                        </div>
                        <div class="mb-3">
                            <label for="monthly-price" class="col-form-label">Mensuelle </label>
                            <input type="number" id="monthly-price" class="form-control" name="monthly_price" min="0">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary btn-add" data-action="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal add --}}
@endsection
@section('custom-scripts')
    <script src="{{ asset('js/api/transport/add-transport.js') }}"></script>
@endsection
