import template from './swag-example-list.html.twig';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('swag-example-list',
    {
        template, 
        inject: ['productService'],
        mixins: [Mixin.getByName('notification')],

        data() {

        },
        methods: {

            importProducts() {
                this.productService.import().then((response) => {
                    console.log(response);
                    if (response && response.message.indexOf('erfolgreich') > 0) {
                        this.createNotificationSuccess({ message: 'Produkte importiert!' });
                        
                    } else {
                        this.createNotificationSuccess({ message: 'Produkte not sucess' });
                    }
                }).catch((error) => {
                    this.createNotificationError({ message: 'Error beim Importieren!' });
                }).finally(() => {
                    this.createNotificationSuccess({ message: 'Ende Importieren!' });
                });
            },
            deleteImportedProducts() {
                this.productService.deleteImported().then((response) => {
                    console.log(response);
                    if (response && response.message.indexOf('erfolgreich')) {
                       this.createNotificationSuccess({ message: "Importierte Produkte gelöscht!"});
                        
                    } else {
                        this.createNotificationSuccess({ message: "Löschung not success"});
                    }
                }).catch((error) => {
                    this.createNotificationError({ message: "error"});
                }).finally(() => {
                    this.createNotificationSuccess({ message: 'Ende Löschung Import'});
                });
            }
        }
    }

);