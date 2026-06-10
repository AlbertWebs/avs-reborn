<?php
function timeAgo($timestamp){
    $datetime1=new DateTime("now");
    $datetime2=date_create($timestamp);
    $diff=date_diff($datetime1, $datetime2);
    $timemsg='';
    if($diff->y > 0){
        $timemsg = $diff->y .' year'. ($diff->y > 1?"'s":'');

    }
    else if($diff->m > 0){
    $timemsg = $diff->m . ' month'. ($diff->m > 1?"'s":'');
    }
    else if($diff->d > 0){
    $timemsg = $diff->d .' day'. ($diff->d > 1?"'s":'');
    }
    else if($diff->h > 0){
    $timemsg = $diff->h .' hour'.($diff->h > 1 ? "'s":'');
    }
    else if($diff->i > 0){
    $timemsg = $diff->i .' minute'. ($diff->i > 1?"'s":'');
    }
    else if($diff->s > 0){
    $timemsg = $diff->s .' second'. ($diff->s > 1?"'s":'');
    }

$timemsg = $timemsg.' ago';
return $timemsg;
}

function dollar($value){
    // This can be dynamic
    $newValue = $value/110;
    return $newValue;
}

function seo_upload_filename(string $baseName, string $role, string $extension): string
{
    $slug = \Illuminate\Support\Str::slug($baseName);
    $roleSlug = \Illuminate\Support\Str::slug($role);

    if ($slug === '') {
        $slug = 'upload';
    }

    $filename = $roleSlug !== '' ? "{$slug}-{$roleSlug}" : $slug;
    $extension = strtolower(ltrim($extension, '.'));

    return "{$filename}.{$extension}";
}

function move_upload_with_seo_name(\Illuminate\Http\UploadedFile $file, string $path, string $baseName, string $role = ''): string
{
    $filename = seo_upload_filename($baseName, $role, $file->getClientOriginalExtension());
    $file->move($path, $filename);

    return $filename;
}

function upload_base_name(\Illuminate\Http\Request $request, array $fields = ['name', 'title', 'cat', 'sitename']): string
{
    foreach ($fields as $field) {
        $value = $request->input($field);
        if (!empty($value)) {
            return $value;
        }
    }

    return 'upload';
}

function product_code_from_name(string $name): string
{
    $name = trim($name);

    if ($name === '') {
        return 'PRODUCT-' . strtoupper(\Illuminate\Support\Str::random(6));
    }

    $words = preg_split('/\s+/', $name);
    $brandWord = preg_replace('/[^a-zA-Z]/', '', $words[0] ?? '');
    $prefix = strtoupper(substr($brandWord, 0, min(4, max(3, strlen($brandWord)))));

    if (strlen($prefix) < 2) {
        $prefix = 'PRD';
    }

    $remainder = implode(' ', array_slice($words, 1));
    $model = preg_replace('/[^a-zA-Z0-9]/', '', $remainder !== '' ? $remainder : $name);

    if ($model === '') {
        $model = preg_replace('/[^a-zA-Z0-9]/', '', $name);
    }

    $code = $prefix . '-' . strtoupper(substr($model, 0, 24));

    return trim($code, '-') ?: 'PRODUCT-' . strtoupper(\Illuminate\Support\Str::random(6));
}

function unique_product_code(string $code, ?int $exceptId = null): string
{
    $base = $code;
    $suffix = 1;

    while (true) {
        $query = \Illuminate\Support\Facades\DB::table('product')->where('code', $code);

        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }

        if (!$query->exists()) {
            return $code;
        }

        $suffix++;
        $code = $base . '-' . $suffix;
    }
}

function product_gallery_filenames($product, bool $includeMarketingImages = true): array
{
    if (!$product) {
        return [];
    }

    $images = [];
    $append = function ($filename) use (&$images) {
        if (!is_string($filename) || $filename === '' || $filename === '0') {
            return;
        }
        if (!in_array($filename, $images, true)) {
            $images[] = $filename;
        }
    };

    if (!empty($product->gallery_images)) {
        $decoded = json_decode($product->gallery_images, true);
        if (is_array($decoded)) {
            foreach ($decoded as $filename) {
                $append($filename);
            }
        }
    }

    foreach (['image_one', 'image_two', 'image_three'] as $field) {
        $append($product->{$field} ?? null);
    }

    if ($includeMarketingImages) {
        $append($product->thumbnail ?? null);
        $append($product->fb_pixels ?? null);
    }

    return $images;
}
?>