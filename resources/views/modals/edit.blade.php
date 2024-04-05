<div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPartnerModalLabel">Edit Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(isset($partner))
                        <form id="editPartnerForm" action="{{ route('partner.update', ['id' => $partner->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit-name" name="nome" value="{{ $partner->nome }}" required>
                            </div>
                            @if (Auth::user()->type === 'gold')
                                <div class="mb-3">
                                    <label for="edit-type" class="form-label">Type</label>
                                    <select class="form-select" id="edit-type" name="type" required>
                                        <option value="silver" {{ $partner->type === 'silver' ? 'selected' : '' }}>Silver</option>
                                        <option value="gold" {{ $partner->type === 'gold' ? 'selected' : '' }}>Gold</option>
                                    </select>
                                    
                                </div>
                            @endif
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="edit-cep" name="cep" value="{{ $partner->cep }}" placeholder="CEP: 05822-010" required>
                                <button type="button" class="btn btn-outline-secondary" id="editSearchCepBtn">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <div class="mb-3">
                                <label for="edit-logradouro" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="edit-logradouro" name="logradouro" value="{{ $partner->logradouro }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="edit-complemento" name="complemento" value="{{ $partner->complemento }}">
                            </div>
                            <div class="mb-3">
                                <label for="edit-bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="edit-bairro" name="bairro" value="{{ $partner->bairro }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-localidade" class="form-label">Localidade</label>
                                <input type="text" class="form-control" id="edit-localidade" name="localidade" value="{{ $partner->localidade }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-uf" class="form-label">UF</label>
                                <input type="text" class="form-control" id="edit-uf" name="uf" value="{{ $partner->uf }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <p>Nenhum parceiro selecionado.</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>