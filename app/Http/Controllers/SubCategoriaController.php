<?php

namespace BuscaSorocaba\Http\Controllers;

use BuscaSorocaba\Models\SubCategoria;
use BuscaSorocaba\Repositories\CategoriaRepository;
use BuscaSorocaba\Repositories\SubCategoriaRepository;
use Illuminate\Http\Request;

use BuscaSorocaba\Http\Requests;
use BuscaSorocaba\Http\Controllers\Controller;

class SubCategoriaController extends Controller
{
    /**
     * @var SubCategoriaRepository
     */
    private $repository;
    /**
     * @var CategoriaRepository
     */
    private $categoriaRepository;

    public function __construct(SubCategoriaRepository $repository, CategoriaRepository $categoriaRepository)
    {
        $this->repository = $repository;
        $this->categoriaRepository = $categoriaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub = $this->repository->paginate();

        if(!$sub->items())
            $sub = false;

        return view('admin.subcategoria.index', compact('sub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = $this->categoriaRepository->lists('nome', 'id');

        return view('admin.subcategoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SubCategoriaRequest $request)
    {
        $data = $request->all();

        $sub = new SubCategoria([
            'categoria_id' => $data['categoria_id']
        ]);

        $this->repository->create($data);

        return redirect()->route('admin.subcategoria.index');
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
        $sub = $this->repository->find($id);
        $categoria = $this->categoriaRepository->lists('nome', 'id');

        return view('admin.subcategoria.edit', compact('sub', 'categoria'));
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

        $sub = new SubCategoria([
            'categoria_id' => $data['categoria_id']
        ]);

        $nomeSub = $this->repository->find($id);

        if ($nomeSub->nome == $data['nome'])
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

        return redirect()->route('admin.subcategoria.index');
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

        return redirect()->route('admin.subcategoria.index');
    }
}
