import template from './swag-example-list.html.twig';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('swag-example-list',
    {
        template, inject: ['intoDashboard'],
        mixins: [Mixin.getByName('notification')],

        data() {

        },
        methods: {

            // importProducts() {
            //     this.$http.post('/api/test-plugin/import').then(() => {
            //         this.createNotificationSuccess({ message: 'Produkte importiert!' });
            //     }).catch(error => {
            //         this.createNotificationError({ message: 'Fehler beim Importieren!' });
            //     });
            // },
            // deleteImportedProducts() {
            //     this.$http.post('/api/test-plugin/delete').then(() => {
            //         this.createNotificationSuccess({ message: 'Importierte Produkte gelöscht!' });
            //     }).catch(error => {
            //         this.createNotificationError({ message: 'Fehler beim Löschen!' });
            //     });
            // },
        }
    }

);