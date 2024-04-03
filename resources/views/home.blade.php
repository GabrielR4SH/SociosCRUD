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

                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                        Add Partner
                    </button>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
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
                                <td>{{ $partner->name }}</td>
                                <td>{{ $partner->cep }}</td>
                                <td>{{ $partner->logradouro }}</td>
                                <td>{{ $partner->complemento }}</td>
                                <td>{{ $partner->bairro }}</td>
                                <td>{{ $partner->localidade }}</td>
                                <td>{{ $partner->uf }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
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
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP: 05822-010" required>
                        <button type="button" class="btn btn-outline-secondary" id="searchCepBtn">
                            <i class="fas fa-hourglass-half"></i>
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
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    // Máscara para o campo CEP
    $('#cep').inputmask('99999-999');

    document.getElementById('searchCepBtn').addEventListener('click', function () {
        let cep = document.getElementById('cep').value.replace(/\D/g, '');

        if (cep.length != 8) {
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('logradouro').value = data.logradouro || '';
                document.getElementById('complemento').value = data.complemento || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('localidade').value = data.localidade || '';
                document.getElementById('uf').value = data.uf || '';
            })
            .catch(error => console.error('Erro:', error));
    });

    document.getElementById('addPartnerForm').addEventListener('submit', function (event) {
        let userType = '{{ Auth::user()->type }}';

        if (userType === 'silver' && document.getElementById('type')) {
            event.preventDefault();
            alert('Silver users cannot add gold partners.');
        }
    });
</script>
@endsection
