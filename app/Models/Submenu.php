<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public function list_submenu($params = [])
  {
    $skip   = $params['skip'] ?? 0;
    $take   = $params['take'] ?? 10;
    $column = $params['column'] ?? 'id';
    $order  = $params['order'] ?? 'ASC';
    $search = $params['search'] ?? '';

    $submenus = Submenu::where(['is_deleted' => 0])
      ->where(function ($query) use ($search) {
        $query->where('name', 'like', "%$search%")
          ->orWhere('icon', 'like', "%$search%")
          ->orWhere('url', 'like', "%$search%");
      })
      ->skip($skip)
      ->take($take)
      ->orderBy($column, $order)
      ->with('menu')
      ->get();

    $totalRecords = Submenu::where(['is_deleted' => 0])->where(function ($query) use ($search) {
      $query->where('name', 'like', "%$search%")
        ->orWhere('icon', 'like', "%$search%")
        ->orWhere('url', 'like', "%$search%");
    })->count();

    return [
      'recordsTotal'    => $totalRecords,
      'recordsFiltered' => $totalRecords,
      'data'            => $submenus
    ];
  }

  public function destroy_item($id)
  {
    date_default_timezone_set('Asia/Jakarta');
    $userId = auth()->user()->id;

    Submenu::where(['id' => $id])->update(['is_deleted' => 1, 'deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $userId]);
    return ['status' => true, 'message' => 'Submenu has been deleted'];
  }

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'parent_id', 'id');
  }
}
