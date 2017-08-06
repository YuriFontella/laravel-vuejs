<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notebook;
use App\User;

class NotebookController extends Controller
{
  public function index() {
    // return Notebook::all();
    return Notebook::with('user')->latest()->get();
  }

  public function store(Request $request) {
    $this->validate($request, [
      'name' => 'required',
      'body' => 'required'
    ]);

    $user = User::find(1);

    $user->notebooks()->create($request->all());
    return 'Criado com sucesso!';  
  }

  public function update(Request $request, Notebook $notebook) {

    $notebook->update($request->all());
    return 'Alterado com sucesso';

  }

  public function destroy(Notebook $notebook) {
    $notebook->delete();
    return 'Deletado!';
  }
}
