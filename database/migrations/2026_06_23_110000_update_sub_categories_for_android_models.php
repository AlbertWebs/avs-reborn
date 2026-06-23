<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('sub_category', 'slung')) {
            Schema::table('sub_category', function (Blueprint $table) {
                $table->string('slung')->nullable()->after('name');
            });
        }

        // Normalize duplicate names per parent category before adding unique constraint.
        $duplicates = DB::table('sub_category')
            ->select('cat_id', DB::raw('LOWER(name) as lower_name'), DB::raw('MIN(id) as keep_id'), DB::raw('COUNT(*) as total'))
            ->groupBy('cat_id', DB::raw('LOWER(name)'))
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicates as $duplicate) {
            DB::table('sub_category')
                ->where('cat_id', $duplicate->cat_id)
                ->whereRaw('LOWER(name) = ?', [$duplicate->lower_name])
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
        }

        // Backfill slugs for existing rows.
        $categories = DB::table('sub_category')->orderBy('cat_id')->orderBy('id')->get();
        foreach ($categories as $subCategory) {
            $base = Str::slug($subCategory->name ?: 'model');
            $slug = $base !== '' ? $base : 'model';
            $suffix = 2;

            while (
                DB::table('sub_category')
                    ->where('cat_id', $subCategory->cat_id)
                    ->where('slung', $slug)
                    ->where('id', '!=', $subCategory->id)
                    ->exists()
            ) {
                $slug = $base . '-' . $suffix;
                $suffix++;
            }

            DB::table('sub_category')
                ->where('id', $subCategory->id)
                ->update(['slung' => $slug]);
        }

        try {
            Schema::table('sub_category', function (Blueprint $table) {
                $table->index('cat_id', 'sub_category_cat_id_idx');
            });
        } catch (\Throwable $e) {
            // Index may already exist on some environments.
        }

        try {
            Schema::table('sub_category', function (Blueprint $table) {
                $table->unique(['cat_id', 'name'], 'sub_category_cat_id_name_unique');
            });
        } catch (\Throwable $e) {
            // Unique may already exist on some environments.
        }

        try {
            Schema::table('product', function (Blueprint $table) {
                $table->index('sub_cat', 'product_sub_cat_idx');
            });
        } catch (\Throwable $e) {
            // Index may already exist on some environments.
        }

        $androidCategoryId = DB::table('category')
            ->where('slung', 'android-radios-by-car-model')
            ->value('id');

        if ($androidCategoryId) {
            $models = [
                'Toyota',
                'Nissan',
                'Honda',
                'Mazda',
                'Subaru',
                'Mitsubishi',
                'Volkswagen',
                'Mercedes',
                'BMW',
                'Audi',
                'Universal',
            ];

            foreach ($models as $model) {
                $exists = DB::table('sub_category')
                    ->where('cat_id', $androidCategoryId)
                    ->whereRaw('LOWER(name) = ?', [Str::lower($model)])
                    ->exists();

                if ($exists) {
                    continue;
                }

                $base = Str::slug($model);
                $slug = $base;
                $suffix = 2;
                while (
                    DB::table('sub_category')
                        ->where('cat_id', $androidCategoryId)
                        ->where('slung', $slug)
                        ->exists()
                ) {
                    $slug = $base . '-' . $suffix;
                    $suffix++;
                }

                DB::table('sub_category')->insert([
                    'name' => $model,
                    'cat_id' => $androidCategoryId,
                    'slung' => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Backfill android radios products without sub_cat using simple model keyword matching.
            $modelMap = [];
            $modelRows = DB::table('sub_category')
                ->where('cat_id', $androidCategoryId)
                ->get(['id', 'name']);
            foreach ($modelRows as $row) {
                $modelMap[Str::lower($row->name)] = $row->id;
            }

            $androidProducts = DB::table('product')
                ->where('cat', $androidCategoryId)
                ->whereNull('sub_cat')
                ->get();

            foreach ($androidProducts as $product) {
                $haystack = Str::lower(trim(($product->name ?? '') . ' ' . ($product->meta ?? '')));
                if ($haystack === '') {
                    continue;
                }

                $matchedSubCategoryIds = [];
                foreach ($modelMap as $modelName => $subCategoryId) {
                    if ($modelName !== '' && Str::contains($haystack, $modelName)) {
                        $matchedSubCategoryIds[] = $subCategoryId;
                    }
                }

                $matchedSubCategoryIds = array_values(array_unique($matchedSubCategoryIds));
                if (count($matchedSubCategoryIds) === 1) {
                    DB::table('product')
                        ->where('id', $product->id)
                        ->update(['sub_cat' => $matchedSubCategoryIds[0]]);
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('product')) {
            try {
                Schema::table('product', function (Blueprint $table) {
                    $table->dropIndex('product_sub_cat_idx');
                });
            } catch (\Throwable $e) {
                // Ignore if index does not exist.
            }
        }

        if (Schema::hasTable('sub_category')) {
            try {
                Schema::table('sub_category', function (Blueprint $table) {
                    $table->dropUnique('sub_category_cat_id_name_unique');
                });
            } catch (\Throwable $e) {
                // Ignore if unique does not exist.
            }

            try {
                Schema::table('sub_category', function (Blueprint $table) {
                    $table->dropIndex('sub_category_cat_id_idx');
                });
            } catch (\Throwable $e) {
                // Ignore if index does not exist.
            }

            if (Schema::hasColumn('sub_category', 'slung')) {
                Schema::table('sub_category', function (Blueprint $table) {
                    $table->dropColumn('slung');
                });
            }
        }
    }
};
