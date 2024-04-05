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

    <!-- Modal Create-->
    @extends('modals.create');

    <!-- Modal Edit-->
    @extends('modals.edit')


    <!-- Delete Partner Modal -->
    @extends('modals.delete');
@endsection
