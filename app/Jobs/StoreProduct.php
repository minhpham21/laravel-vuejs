<?php

namespace App\Jobs;

use App\Helpers\Utils;
use App\Product;
use App\Http\Requests\StoreProduct as ProductRequests;

class StoreProduct
{
    private $categoryId;
    private $title;
    private $description;
    private $price;
    private $active;
    private $images;

    public function __construct(
        int $categoryId,
        string $title,
        string $description,
        int $price,
        bool $active,
        array $images
    )
    {
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->active = $active;
        $this->images = $images;
    }

    public function handle()
    {
        $uploadImages = [];

        foreach ($this->images as $key => $image ) {
            $uploadImages[$key] = Utils::uploadedFile($image, 'images', 'public');
        }

        return Product::create([
            'category_id' => $this->categoryId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'images' => $uploadImages,
            'active' => $this->active
        ]);
    }

    public static function fromRequest(ProductRequests $request)
    {
        return new static(
            $request->categoryId(),
            $request->title(),
            $request->description(),
            $request->price(),
            $request->active(),
            $request->images()
        );
    }
}
