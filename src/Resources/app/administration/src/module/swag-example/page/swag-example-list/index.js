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

            importProducts() {
                Shopware.Service('syncService').httpClient.post('/test-plugin/import', {}, { })
                .then(() => {
                    this.createNotificationSuccess({ message: 'Produkte importiert!' });
                })
                .catch(() => {
                    this.createNotificationError({ message: 'Fehler beim Importieren!' });
                });
            },
            deleteImportedProducts() {
                Shopware.Service('syncService').httpClient.post('/test-plugin/delete', {}, { })
                    .then(() => {
                        this.createNotificationSuccess({ message: 'Importierte Produkte gelöscht!' });
                    })
                    .catch(() => {
                        this.createNotificationError({ message: 'Fehler beim Löschen!' });
                    });
            }
        }
    }

);