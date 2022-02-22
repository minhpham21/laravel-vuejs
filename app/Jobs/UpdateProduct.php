<?php

namespace App\Jobs;

use App\Helpers\Utils;
use App\Product;
use App\Http\Requests\UpdateProduct as ProductRequests;
use Illuminate\Support\Facades\Storage;

class UpdateProduct
{
    private $product;
    private $categoryId;
    private $title;
    private $description;
    private $price;
    private $active;
    private $images;
    private $remove_old_img;

    public function __construct(
        Product $product,
        int $categoryId,
        string $title,
        string $description,
        int $price,
        bool $active,
        ?array $images,
        ?array $remove_old_img
    )
    {
        $this->product = $product;
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->active = $active;
        $this->images = $images;
        $this->remove_old_img = $remove_old_img;
    }

    public function handle()
    {
        $uploadImgs = [];
        $imgList = $this->product->images;
        if ($this->remove_old_img) {
            $imgList = array_diff($imgList, $this->remove_old_img); 
            foreach ($this->remove_old_img as $img) {
                Storage::disk('public')->delete('images/' . $img);
            }
        }

        if ($this->images) {
            foreach ($this->images as $image) {
                $uploadImgs[] = Utils::uploadedFile($image, 'images', 'public');
            }
        }

        $uploadImgs = array_merge($imgList, $uploadImgs);

        $this->product->update([
            'category_id' => $this->categoryId,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'images' => $uploadImgs,
            'active' => $this->active
        ]);
    }

    public static function fromRequest(Product $product, ProductRequests $request)
    {
        return new static(
            $product,
            $request->categoryId(),
            $request->title(),
            $request->description(),
            $request->price(),
            $request->active(),
            $request->images(),
            $request->remove_old_img()
        );
    }
}
