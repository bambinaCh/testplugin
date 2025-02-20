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
                        this.createNotificationError({ message: 'Produkte Import not sucess' });
                    }
                }).catch((error) => {
                    this.createNotificationError({ message: 'Error beim Importieren!' });
                }).finally(() => {
                    console.log("Import Prozess beendet");
                });
            },
            deleteImportedProducts() {
                this.productService.deleteImported().then((response) => {
                    console.log(response);
                    if (response && response.message.indexOf('erfolgreich')) {
                       this.createNotificationSuccess({ message: "Importierte Produkte gelöscht!"});
                        
                    } else {
                        this.createNotificationError({ message: "Löschung Import not sucess"});
                    }
                }).catch((error) => {
                    this.createNotificationError({ message: "Fehler bei der Löschung"});
                }).finally(() => {
                    console.log("LöschungImport Prozess beendet");
                });
            }
        }
    }

);