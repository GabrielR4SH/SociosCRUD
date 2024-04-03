// app.js

document.getElementById('cep').addEventListener('change', function () {
    let cep = this.value.replace(/\D/g, '');

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
