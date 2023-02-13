<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submenu;
use App\Models\Menu;

class SubmenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      'title' => 'Submenu management',
      'breadcrumbs' => [
        ['name' => 'Master Data', 'url' => 'master-data/submenu'],
        ['name' => 'Submenu', 'url' => '']
      ]
    ];
    return view('master-data.submenu.Submenu', $data);
  }

  public function list_submenu()
  {
    $columns      = ['id', 'name', 'icon', 'url', 'is_active'];
    $column_index = request('order')[0]['column'];

    $Submenu = new Submenu();
    
    $result = $Submenu->list_submenu([
      'skip'   => request('start'),
      'take'   => request('length'),
      'column' => $columns[$column_index],
      'order'  => request('order')[0]['dir'],
      'search' => request('search')['value']
    ]);

    echo json_encode($result);
  }

  public function menus()
  {
    $result = Menu::where(['is_active' => 1, 'is_deleted' => 0])->get();
    
    return response()->json([
      'status'  => true,
      'message' => 'Menu has been loaded',
      'data'    => $result
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $Submenu = new Submenu();
    $result = $Submenu->destroy_item($id);
    return response()->json($result);
  }
}
