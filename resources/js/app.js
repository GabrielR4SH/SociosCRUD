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

// Certifique-se de que o jQuery está carregado antes de usar $.inputmask

$(document).ready(function() {
    // Máscara para o campo CEP
    $('#cep').inputmask('99999-999');

    // Evento de clique no botão de pesquisa do CEP
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
                $('#complemento').val(data.complemento || '');
                $('#bairro').val(data.bairro || '');
                $('#localidade').val(data.localidade || '');
                $('#uf').val(data.uf || '');
            },
            error: function() {
                alert('Erro ao buscar CEP. Por favor, tente novamente.');
            }
        });
    });

    // Abre o modal de edição do parceiro
    $('.edit-partner').click(function() {
        let partnerId = $(this).data('id');
        // Lógica para abrir o modal de edição com o ID do parceiro
        $('#editPartnerModal').modal('show');
    });

    // Abre o modal de exclusão do parceiro
    $('.delete-partner').click(function() {
        let partnerId = $(this).data('id');
        // Lógica para abrir o modal de exclusão com o ID do parceiro
        $('#deletePartnerModal').modal('show');
    });
});