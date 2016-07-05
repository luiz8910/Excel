<?php

namespace BuscaSorocaba\Http\Controllers;

use BuscaSorocaba\Repositories\CategoriaRepository;
use Illuminate\Http\Request;

use BuscaSorocaba\Http\Requests;
use BuscaSorocaba\Http\Controllers\Controller;

class CategoriaController extends Controller
{
    /**
     * @var CategoriaRepository
     */
    private $repository;

    public function __construct(CategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = $this->repository->paginate();

        return view('admin.categoria.index', compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CategoriaRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.categoria.index');
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
        $categoria = $this->repository->find($id);

        return view('admin.categoria.edit', compact('categoria'));
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
        $data = $request->all();

        session(['nome' => $data['nome']]);

        $cat = $this->repository->find($id);

        if ($cat->nome == $data['nome'])
        {
            $this->repository->update($data, $id);
        }

        else
        {
            $nome = $this->repository->all();
            $var = true;

            foreach($nome as $n)
            {
                if($data['nome'] == $n->nome)
                {
                    $var = false;
                }
            }

            if($var)
            {
                $this->repository->update($data, $id);
            }
            else{
                return $this->edit($id);
            }
        }



        return redirect()->route('admin.categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.categoria.index');
    }
}
