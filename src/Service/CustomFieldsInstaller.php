<?php declare(strict_types=1);

namespace TestPlugin\Service;

use Shopware\Core\Content\Product\Aggregate\ProductVisibility\ProductVisibilityDefinition;
use Shopware\Core\Defaults;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\RangeFilter;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\CustomField\CustomFieldTypes;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CustomFieldsInstaller
{
    private HttpClientInterface $httpClient;
    private EntityRepository $productRepository;

    public function __construct(HttpClientInterface $httpClient, EntityRepository $productRepository)
    {
        $this->httpClient = $httpClient;
        $this->productRepository = $productRepository;
    }

    public function importProducts(Context $context): void
    {
        $response = $this->httpClient->request('GET', 'https://dummyjson.com/products');
        $data = $response->toArray();

        if (!isset($data['products'])) {
            return;
        }

        $categoryIds = [
            "01938c22fc1b70f6b3dc798973f9eee1",
            "19ca405790ff4f07aac8c599d4317868",
            "2185182cbbd4462ea844abeb2a438b33",
            "251448b91bc742de85643f5fccd89051",
            "48f97f432fd041388b2630184139cf0e",
            "77b959cf66de4c1590c7f9b7da3982f3",
            "8de9b484c54f441c894774e5f57e485c",
            "a515ae260223466f8e37471d279e6406",
            "bb22b05bff9140f3808b1cff975b75eb"
        ];

        $products = [];

        foreach ($data['products'] as $apiProduct) {
            $productNumber = $apiProduct['sku'] ?? Uuid::randomHex();


            $criteria = new Criteria();
            $criteria->addFilter(new EqualsFilter('productNumber', $productNumber));
            $existingProduct = $this->productRepository->search($criteria, $context)->first();

            if ($existingProduct) {
                continue;
            }

            $categories = array_map(fn($id) => ['id' => $id], $categoryIds);

            $products[] = [
                'id' => Uuid::randomHex(),
                'name' => $apiProduct['title'],
                'description' => $apiProduct['description'],
                'productNumber' => $productNumber,
                'price' => [
                    [
                        'currencyId' => Defaults::CURRENCY,
                        'gross' => $apiProduct['price'],
                        'net' => $apiProduct['price'] * 0.81,
                        'linked' => true
                    ]
                ],
                'stock' => $apiProduct['stock'],
                'active' => true,
                "taxId" => "01938c22fc0f71d297cec046c4722ce1",
                'manufacturer' => [
                    "id" => Uuid::randomHex(),
                    'name' => $apiProduct['brand'] ?? "Unbekannt"
                ],
                'categories' => $categories,
            ];
        }

        $this->productRepository->upsert($products, $context);
    }

    public function deleteImportedProducts(Context $context): void
    {
        $criteria = new Criteria();
        $criteria->addFilter(new RangeFilter('autoIncrement', [
            RangeFilter::GTE => 16
        ]));

        $productIds = $this->productRepository->searchIds($criteria, $context)->getIds();

        if (!empty($productIds)) {
            $deleteData = array_map(fn($id) => ['id' => $id], $productIds);
            $this->productRepository->delete($deleteData, $context);
        }
    }
}
