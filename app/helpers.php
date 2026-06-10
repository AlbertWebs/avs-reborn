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
?>