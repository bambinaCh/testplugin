const ApiService = Shopware.Classes.ApiService;
const { Application } = Shopware;

class ApiClient extends ApiService {
    constructor(httpClient, loginService, apiEndpoint = 'test-plugin') {
        super(httpClient, loginService, apiEndpoint);
    }

    import() {
        const headers = this.getBasicHeaders({});
        console.log(headers);
        console.log(this.getApiBasePath());


        return this.httpClient
            .post(`_action/${this.getApiBasePath()}/import`, {}, {
                headers
            })
            .then((response) => {
                return ApiService.handleResponse(response);
            });
    }

    deleteImported() {
        const headers = this.getBasicHeaders({});
        console.log(headers);
        console.log(this.getApiBasePath());


        return this.httpClient
            .post(`_action/${this.getApiBasePath()}/delete`, {}, {
                headers
            })
            .then((response) => {
                return ApiService.handleResponse(response);
            });
    }
}

Application.addServiceProvider('productService', (container) => {
    const initContainer = Application.getContainer('init');
    return new ApiClient(initContainer.httpClient, container.loginService);
});