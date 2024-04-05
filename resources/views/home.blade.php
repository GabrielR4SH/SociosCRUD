@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                        <hr>

                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#addPartnerModal">
                            Add Partner
                        </button>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    @if (Auth::user()->type === 'gold')
                                        <th>Type</th>
                                    @endif
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairro</th>
                                    <th>Localidade</th>
                                    <th>UF</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td>{{ $partner->nome }}</td>
                                        @if (Auth::user()->type === 'gold')
                                            <td>{{ $partner->type }}</td>
                                        @endif
                                        <td>{{ $partner->cep }}</td>
                                        <td>{{ $partner->logradouro }}</td>
                                        <td>{{ $partner->complemento }}</td>
                                        <td>{{ $partner->bairro }}</td>
                                        <td>{{ $partner->localidade }}</td>
                                        <td>{{ $partner->uf }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary edit-partner"
                                                data-id="{{ $partner->id }}" data-bs-toggle="modal"
                                                data-bs-target="#editPartnerModal">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger delete-partner"
                                                data-id="{{ $partner->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPartnerModalLabel">Add Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPartnerForm" action="{{ route('partner.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="nome" required>
                        </div>
                        @if (Auth::user()->type === 'gold')
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>
                        @endif
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="cep" name="cep"
                                placeholder="CEP: 05822-010" required>
                            <button type="button" class="btn btn-outline-secondary" id="searchCepBtn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                        </div>
                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento">
                        </div>
                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>
                        <div class="mb-3">
                            <label for="localidade" class="form-label">Localidade</label>
                            <input type="text" class="form-control" id="localidade" name="localidade" required>
                        </div>
                        <div class="mb-3">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf" name="uf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPartnerModalLabel">Edit Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPartnerForm" action="{{ route('partner.update', ['id' => $partner->id]) }}"
                        method="POST">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="nome" required>
                        </div>
                        @if (Auth::user()->type === 'gold')
                            <div class="mb-3">
                                <label for="edit-type" class="form-label">Type</label>
                                <select class="form-select" id="edit-type" name="type" required>
                                    <option value="silver">Silver</option>
                                    <option value="gold">Gold</option>
                                </select>
                            </div>
                        @endif

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="edit-cep" name="cep"
                                placeholder="CEP: 05822-010" required>
                            <button type="button" class="btn btn-outline-secondary" id="editSearchCepBtn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label for="edit-logradouro" class="form-label">Logradouro</label>
                            <input type="text" class="form-control" id="edit-logradouro" name="logradouro" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="edit-complemento" name="complemento">
                        </div>
                        <div class="mb-3">
                            <label for="edit-bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="edit-bairro" name="bairro" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-localidade" class="form-label">Localidade</label>
                            <input type="text" class="form-control" id="edit-localidade" name="localidade" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-uf" class="form-label">UF</label>
                            <input type="text" class="form-control" id="edit-uf" name="uf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Partner Modal -->
    <div class="modal fade" id="deletePartnerModal" tabindex="-1" aria-labelledby="deletePartnerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePartnerModalLabel">Delete Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your delete confirmation message here -->
                </div>
            </div>
        </div>
    </div>
@endsection
