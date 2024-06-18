<?php
namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Advertisement::with(['agent', 'images']); // Загрузка данных агента и изображений

        // Логика фильтрации объявлений
        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }

        if ($request->filled('deal_type')) {
            $query->where('deal_type', $request->deal_type);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }

        if ($request->filled('price')) {
            $query->where('price', '<=', $request->price);
        }

        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->filled('floor')) {
            $query->where('floor', '<=', $request->floor);
        }

        if ($request->filled('total_floors')) {
            $query->where('total_floors', $request->total_floors);
        }

        if ($request->filled('area')) {
            $query->where('area', '<=', $request->area);
        }

        if ($request->filled('balcony')) {
            $query->where('balcony', $request->balcony);
        }

        if ($request->filled('bathroom')) {
            $query->where('bathroom', $request->bathroom);
        }

        if ($request->filled('view')) {
            $query->where('view', $request->view);
        }

        if ($request->filled('renovation')) {
            $query->where('renovation', $request->renovation);
        }

        if ($request->filled('house_type')) {
            $query->where('house_type', $request->house_type);
        }

        $advertisements = $query->get();

        return view('catalog', [
            'advertisements' => $advertisements
        ]);
    }
}

