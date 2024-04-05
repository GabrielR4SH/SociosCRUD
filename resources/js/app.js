/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');


$(document).ready(function () {

    function fillAddressFields(cepField, logradouroField, complementoField, bairroField, localidadeField, ufField) {
        let cep = cepField.val().replace(/\D/g, '');

        if (cep.length != 8) {
            return;
        }

        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            type: 'GET',
            success: function (data) {
                logradouroField.val(data.logradouro || '');
                complementoField.val(data.complemento || '');
                bairroField.val(data.bairro || '');
                localidadeField.val(data.localidade || '');
                ufField.val(data.uf || '');
            },
            error: function () {
                alert('Erro ao buscar CEP. Por favor, tente novamente.');
            }
        });
    }

    $('#cep').inputmask('99999-999');
    $('#edit-cep').inputmask('99999-999');

    $('#searchCepBtn').click(function () {
        fillAddressFields($('#cep'), $('#logradouro'), $('#complemento'), $('#bairro'), $('#localidade'), $('#uf'));
    });

    $('#editSearchCepBtn').click(function () {
        fillAddressFields($('#edit-cep'), $('#edit-logradouro'), $('#edit-complemento'), $('#edit-bairro'), $('#edit-localidade'), $('#edit-uf'));
    });

    $('.edit-partner').click(function () {
        let partnerId = $(this).data('id');
        $.ajax({
            url: 'partners/' + partnerId + '/edit',
            type: 'GET',
            success: function (data) {
                $('#edit-partner-id').val(data.id);
                $('#edit-name').val(data.nome);
                $('#edit-type').val(data.type);
                $('#edit-cep').val(data.cep);
                $('#edit-logradouro').val(data.logradouro);
                $('#edit-complemento').val(data.complemento);
                $('#edit-bairro').val(data.bairro);
                $('#edit-localidade').val(data.localidade);
                $('#edit-uf').val(data.uf);
                $('#editPartnerForm').attr('action', 'partners/' + partnerId);
                $('#editPartnerModal').modal('show');
            },
            error: function () {
                alert('Erro ao carregar dados do parceiro. Por favor, tente novamente.');
            }
        });
        
    });

    $('.delete-partner').click(function () {
        let partnerId = $(this).data('id');
        $('#confirmDeleteBtn').data('id', partnerId); 
        $('#deletePartnerModal').modal('show'); 
    });

    $('#deletePartnerModal').on('click', '#confirmDeleteBtn', function () {
        let partnerId = $(this).data('id');
        $.ajax({
            url: '/partners/' + partnerId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            complete: function () {
                $('#deletePartnerModal').modal('hide'); 
                location.reload(); 
            }
        });
    });
});








