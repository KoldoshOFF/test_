<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SaleService
{
    public function getSale(array $filters): LengthAwarePaginator
    {
        return Category::query()
            ->when(isset($filters['dateFrom']), fn ($q) => $q->where('date', '>=', $filters['dateFrom']))
            ->when(isset($filters['dateTo']), fn ($q) => $q->where('date', '<=', $filters['dateTo']))
            ->paginate($filters['limit'] ?? 500);
    }
}
