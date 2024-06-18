<?php
namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Advertisement::with(['agent', 'images']);

        if ($request->filled('property_type')) {
            $query->where('property_type', $request->property_type);
        }
        if ($request->filled('deal_type')) {
            $query->where('deal_type', $request->deal_type);
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->filled('min_area')) {
            $query->where('area', '>=', $request->min_area);
        }
        if ($request->filled('max_area')) {
            $query->where('area', '<=', $request->max_area);
        }
        if ($request->filled('rooms')) {
            $query->where('rooms', $request->rooms);
        }
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }
        if ($request->filled('house_floors_from')) {
            $query->where('total_floors', '>=', $request->house_floors_from);
        }
        if ($request->filled('house_floors_to')) {
            $query->where('total_floors', '<=', $request->house_floors_to);
        }
        if ($request->filled('balcony') && $request->balcony != 'any') {
            $query->where('balcony', $request->balcony == 'yes');
        }
        if ($request->filled('bathroom') && $request->bathroom != 'any') {
            $query->where('bathroom', $request->bathroom);
        }
        if ($request->filled('view') && $request->view != 'any') {
            $query->where('view', $request->view);
        }
        if ($request->filled('renovation') && $request->renovation != 'any') {
            $query->where('renovation', $request->renovation);
        }
        if ($request->filled('house_type') && $request->house_type != 'any') {
            $query->where('house_type', $request->house_type);
        }

        $advertisements = $query->get();

        $propertyTypes = [
            'flat' => 'Квартира',
            'house' => 'Дом',
            'land' => 'Участок'
        ];
        return view('catalog', [
            'advertisements' => $advertisements,
            'propertyTypes' => $propertyTypes,
        ]);
    }
    public function show($id)
    {
        $propertyTypes = [
            'flat' => 'Квартира',
            'house' => 'Дом',
            'land' => 'Участок',
            'no' => 'Нет',
            'yes' => 'Да',
            'street' => 'На улицу',
            'any' => 'Неважно',
            'courtyard' => 'Во двор',
            'euro' => 'Евроремонт',
            'cosmetic' => 'Косметический',
            'brick' => 'Кирпичный',
            'panel' => 'панельный',
            'monolithic' => 'Монолитный',
            'wood' => "Деревянный",

        ];
        $advertisement = Advertisement::with(['agent', 'images'])->findOrFail($id);
        return view('show', compact('advertisement'),['propertyTypes' => $propertyTypes]);
    }
}
