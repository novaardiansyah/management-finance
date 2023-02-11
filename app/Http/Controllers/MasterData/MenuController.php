<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      'title' => 'Menu management'
    ];
    return view('master-data.menu.Menu', $data);
  }

  public function list_menu()
  {
    $columns      = ['id', 'name', 'icon', 'url', 'is_active'];
    $column_index = request('order')[0]['column'];

    $Menu = new Menu();
    
    $result = $Menu->list_menu([
      'skip'   => request('start'),
      'take'   => request('length'),
      'column' => $columns[$column_index],
      'order'  => request('order')[0]['dir'],
      'search' => request('search')['value']
    ]);

    echo json_encode($result);
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
    $validate = $request->validate([
      'name'   => 'required',
      'status' => 'required|numeric|between:0,1'
    ]);

    $Menu = new Menu();
    $result = $Menu->store($request->all());

    return response()->json($result);
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
    $Menu = new Menu();
    $result = $Menu->destroy_item($id);
    return response()->json($result);
  }
}
