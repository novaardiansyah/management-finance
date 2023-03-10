<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public function list_menu($params = [])
  {
    $skip   = $params['skip'] ?? 0;
    $take   = $params['take'] ?? 10;
    $column = $params['column'] ?? 'id';
    $order  = $params['order'] ?? 'ASC';
    $search = $params['search'] ?? '';

    $menus = Menu::where(['is_deleted' => 0])
      ->where(function ($query) use ($search) {
        $query->where('name', 'like', "%$search%")
          ->orWhere('icon', 'like', "%$search%")
          ->orWhere('url', 'like', "%$search%");
      })
      ->skip($skip)
      ->take($take)
      ->orderBy($column, $order)
      ->get();

    $totalRecords = Menu::where(['is_deleted' => 0])->where(function ($query) use ($search) {
      $query->where('name', 'like', "%$search%")
        ->orWhere('icon', 'like', "%$search%")
        ->orWhere('url', 'like', "%$search%");
    })->count();

    return [
      'recordsTotal'    => $totalRecords,
      'recordsFiltered' => $totalRecords,
      'data'            => $menus
    ];
  }

  public function store($request)
  {
    if (substr($request['icon'], 0, 3) == 'fa-') {
      $request['icon'] = 'fa-' . substr($request['icon'], 3);
    }

    if (substr($request['url'], 0, 1) == '/') {
      $request['url'] = '/' . substr($request['url'], 1);
    }

    $data = [
      'name'      => $request['name'],
      'is_active' => $request['status']
    ];
    if ($request['icon'] != '') $data = array_merge($data, ['icon' => $request['icon']]);
    if ($request['url'] != '') $data = array_merge($data, ['url' => $request['url']]);

    $menu = Menu::create($data);
    return ['status' => true, 'message' => 'Menu has been created', 'data' => $menu];
  }

  public function destroy_item($id)
  {
    date_default_timezone_set('Asia/Jakarta');
    $userId = auth()->user()->id;

    Menu::where(['id' => $id])->update(['is_deleted' => 1, 'deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $userId]);
    return ['status' => true, 'message' => 'Menu has been deleted'];
  }

  public function edit($id)
  {
    $menu = Menu::where(['id' => $id])->first();
    if (!$menu) return ['status' => false, 'message' => 'Sorry, menu that you are looking for is not found!', 'data' => []];
    return ['status' => true, 'message' => 'Menu found', 'data' => $menu];
  }

  public function update_item($id, $request)
  {
    date_default_timezone_set('Asia/Jakarta');
    
    if (substr($request['icon'], 0, 3) == 'fa-') {
      $request['icon'] = 'fa-' . substr($request['icon'], 3);
    } else {
      $request['icon'] = 'fa-' . $request['icon'];
    }

    if (substr($request['url'], 0, 1) == '/') {
      $request['url'] = '/' . substr($request['url'], 1);
    } else {
      $request['url'] = '/' . $request['url'];
    }

    $data = [
      'name'       => $request['name'],
      'is_active'  => $request['status'],
      'updated_at' => date('Y-m-d H:i:s'),
      'updated_by' => auth()->user()->id
    ];
    if ($request['icon'] != '') $data = array_merge($data, ['icon' => $request['icon']]);
    if ($request['url'] != '') $data = array_merge($data, ['url' => $request['url']]);

    Menu::where(['id' => $id])->update($data);
    return ['status' => true, 'message' => 'Menu has been updated'];
  }

  public function submenus()
  {
    return $this->hasMany(Submenu::class, 'parent_id', 'id')->where(['is_active' => 1, 'is_deleted' => 0]);
  }
}
