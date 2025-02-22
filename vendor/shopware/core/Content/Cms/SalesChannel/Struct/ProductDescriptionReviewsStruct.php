<?php declare(strict_types=1);

namespace Shopware\Core\Content\Cms\SalesChannel\Struct;

use Shopware\Core\Content\Product\SalesChannel\Review\ProductReviewResult;
use Shopware\Core\Content\Product\SalesChannel\SalesChannelProductEntity;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Struct\Struct;

#[Package('buyers-experience')]
class ProductDescriptionReviewsStruct extends Struct
{
    /**
     * @var string|null
     *
     * @deprecated tag:v6.7.0 - Will be natively typed
     */
    protected $productId;

    /**
     * @var bool|null
     *
     * @deprecated tag:v6.7.0 - Will be natively typed
     */
    protected $ratingSuccess;

    /**
     * @var ProductReviewResult|null
     *
     * @deprecated tag:v6.7.0 - Will be natively typed
     */
    protected $reviews;

    /**
     * @var SalesChannelProductEntity|null
     *
     * @deprecated tag:v6.7.0 - Will be natively typed
     */
    protected $product;

    public function getProduct(): ?SalesChannelProductEntity
    {
        return $this->product;
    }

    public function setProduct(SalesChannelProductEntity $product): void
    {
        $this->product = $product;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getReviews(): ?ProductReviewResult
    {
        return $this->reviews;
    }

    public function setReviews(ProductReviewResult $result): void
    {
        $this->reviews = $result;
    }

    public function getRatingSuccess(): ?bool
    {
        return $this->ratingSuccess;
    }

    public function setRatingSuccess(bool $rateSuccess): void
    {
        $this->ratingSuccess = $rateSuccess;
    }

    public function getApiAlias(): string
    {
        return 'cms_product_description_reviews';
    }
}
