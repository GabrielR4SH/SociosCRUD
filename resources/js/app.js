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


$(document).ready(function() {
    // Máscara para o campo CEP
    $('#cep').inputmask('99999-999');
    $('#edit-cep').inputmask('99999-999');

    // Evento de clique no botão de pesquisa do CEP no modal de criação
    $('#searchCepBtn').click(function() {
        let cep = $('#cep').val().replace(/\D/g, '');

        if (cep.length != 8) {
            return;
        }

        // Requisição para a API do ViaCEP
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            type: 'GET',
            success: function(data) {
                // Preencher os campos com os dados retornados
                $('#logradouro').val(data.logradouro || '');
                $('#bairro').val(data.bairro || '');
                $('#localidade').val(data.localidade || '');
                $('#uf').val(data.uf || '');
            },
            error: function() {
                alert('Erro ao buscar CEP. Por favor, tente novamente.');
            }
        });
    });

    // Evento de clique no botão de pesquisa do CEP no modal de edição
    $('#editSearchCepBtn').click(function() {
        let cep = $('#edit-cep').val().replace(/\D/g, '');

        if (cep.length != 8) {
            return;
        }

        // Requisição para a API do ViaCEP
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            type: 'GET',
            success: function(data) {
                // Preencher os campos com os dados retornados
                $('#edit-logradouro').val(data.logradouro || '');
                $('#edit-complemento').val(data.complemento || '');
                $('#edit-bairro').val(data.bairro || '');
                $('#edit-localidade').val(data.localidade || '');
                $('#edit-uf').val(data.uf || '');
            },
            error: function() {
                alert('Erro ao buscar CEP. Por favor, tente novamente.');
            }
        });
    });

    // Abre o modal de edição do parceiro
    $('.edit-partner').click(function() {
        let partnerId = $(this).data('id');
        $.ajax({
            url: 'partners/' + partnerId + '/edit',
            type: 'GET',
            success: function(data) {
                // Preencher os campos do modal com os dados do parceiro
                $('#edit-partner-id').val(data.id);
                $('#edit-name').val(data.nome);
                $('#edit-type').val(data.type);
                $('#edit-cep').val(data.cep);
                $('#edit-logradouro').val(data.logradouro);
                $('#edit-complemento').val(data.complemento);
                $('#edit-bairro').val(data.bairro);
                $('#edit-localidade').val(data.localidade);
                $('#edit-uf').val(data.uf);
                // Atualizar a action do formulário de edição com o ID do parceiro
                $('#editPartnerForm').attr('action', 'partners/' + partnerId);
                // Exibir o modal de edição
                $('#editPartnerModal').modal('show');
            },
            error: function() {
                alert('Erro ao carregar dados do parceiro. Por favor, tente novamente.');
            }
        });
    });

    // Exclui o parceiro
    $('.delete-partner').click(function() {
        let partnerId = $(this).data('id');
        $.ajax({
            url: 'partners/' + partnerId,
            type: 'DELETE',
            success: function() {
                alert('Parceiro excluído com sucesso');
                // Atualize a tabela de parceiros
                location.reload();
            },
            error: function() {
                alert('Erro ao excluir parceiro. Por favor, tente novamente.');
            }
        });
    });
});


   

