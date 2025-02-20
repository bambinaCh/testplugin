<?php declare(strict_types=1);

namespace TestPlugin\Controller;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use TestPlugin\Service\CustomFieldsInstaller;


class ProductImportController extends AbstractController
{
    private CustomFieldsInstaller $customFieldsInstaller;

    public function __construct(CustomFieldsInstaller $customFieldsInstaller)
    {
        $this->customFieldsInstaller = $customFieldsInstaller;
    }

    
    public function importProducts(Context $context): JsonResponse
    {
        $this->customFieldsInstaller->importProducts($context);

        return new JsonResponse(['message' => 'Produkte erfolgreich importiert!']);
    }

    
    public function deleteImportedProducts(Context $context): JsonResponse
    {
        $this->customFieldsInstaller->deleteImportedProducts($context);

        return new JsonResponse(['message' => 'Importierte Produkte erfolgreich gelöscht!']);
    }
}