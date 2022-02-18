<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyProductRequest;
use App\Http\Requests\Tenant\StoreProductRequest;
use App\Http\Requests\Tenant\UpdateProductRequest;
use App\Models\Category;
use App\Models\ColorAttribute;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\SizeAttribute;
use App\Models\VariationAttribute;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::with(['colors', 'sizes', 'variations', 'categories', 'coupons', 'media'])->get();

        return view('tenant.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colors = ColorAttribute::pluck('value', 'id');

        $sizes = SizeAttribute::pluck('value', 'id');

        $variations = VariationAttribute::pluck('value', 'id');

        $categories = Category::pluck('title', 'id');

        $coupons = Coupon::pluck('code', 'id');

        return view('tenant.products.create', compact('categories', 'colors', 'coupons', 'sizes', 'variations'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->colors()->sync($request->input('colors', []));
        $product->sizes()->sync($request->input('sizes', []));
        $product->variations()->sync($request->input('variations', []));
        $product->categories()->sync($request->input('categories', []));
        $product->coupons()->sync($request->input('coupons', []));
        if ($request->input('featured_image', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('gallery', []) as $file) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('tenant.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colors = ColorAttribute::pluck('value', 'id');

        $sizes = SizeAttribute::pluck('value', 'id');

        $variations = VariationAttribute::pluck('value', 'id');

        $categories = Category::pluck('title', 'id');

        $coupons = Coupon::pluck('code', 'id');

        $product->load('colors', 'sizes', 'variations', 'categories', 'coupons');

        return view('tenant.products.edit', compact('categories', 'colors', 'coupons', 'product', 'sizes', 'variations'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->colors()->sync($request->input('colors', []));
        $product->sizes()->sync($request->input('sizes', []));
        $product->variations()->sync($request->input('variations', []));
        $product->categories()->sync($request->input('categories', []));
        $product->coupons()->sync($request->input('coupons', []));
        if ($request->input('featured_image', false)) {
            if (!$product->featured_image || $request->input('featured_image') !== $product->featured_image->file_name) {
                if ($product->featured_image) {
                    $product->featured_image->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($product->featured_image) {
            $product->featured_image->delete();
        }

        if (count($product->gallery) > 0) {
            foreach ($product->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $product->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return redirect()->route('tenant.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('colors', 'sizes', 'variations', 'categories', 'coupons', 'productCoupons');

        return view('tenant.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
