<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function search($query)
    {
        try{
            $customer = Customer::where('name', 'like', '%' . $query . '%')->get();
            return response()->json($customer, 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

    public function list()
    {
        try{
            return response()->json(Customer::all(), 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }

    }

    public function store(Request $request){

        try{
            $data = $request->all();
            $customer = new Customer();
            $customer->fill($data);
            if($customer->save())
                return redirect()->route('customer.index')->with('success', 'Cliente registrar com sucesso!');
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }
        return response()->json('Erro ao registrar cliente', 500);
    }

    public function create(){

        return view('customer.create');
    }

    public function index(){

        return view('customer.index', ['customers' => Customer::all()->sortBy('name')]);

    }
}
