<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('pages.expenses.index')->with('expenses', $expenses);
    }
    public function create()
    {
        return view('pages.expenses.create');
    }

    public function edit(string $id)
    {
        $expense = Expense::find($id);
        return view('pages.expenses.edit')->with('expense', $expense);
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'category' => 'required|max:255|',
            'description' => 'required|',
            'amount_spent' => 'required|numeric',
            'date_of_expenditure' => 'required|date',
        ]);

        Expense::create([
            'category' => $attributes['category'],
            'description' => $attributes['description'],
            'amount_spent' => $attributes['amount_spent'],
            'date_of_expenditure' => $attributes['date_of_expenditure'],
        ]);


        return redirect('expenses')->with('flash_message', 'Expense Added!');
    }
    public function show(string $id)
    {
        $expense = Expense::find($id);
        return view('pages.expenses.show')->with('expense', $expense);
    }

    public function update(Request $request, string $id){

        $expense = Expense::find($id);

        $attributes = request()->validate([
            'category' => 'required|max:255|',
            'description' => 'required|',
            'amount_spent' => 'required|numeric',
            'date_of_expenditure' => 'required|date',
        ]);

        $expense->category = $request->category;
        $expense->description = $request->description;
        $expense->amount_spent = $request->amount_spent;
        $expense->date_of_expenditure = $request->date_of_expenditure;
        $expense->save();

        return redirect('expenses')->with('flash_message', 'Expense Updated');
    }

    public function destroy(string $id)
    {
        Expense::destroy($id);
        return redirect('expenses')->with('flash_message', 'Expense deleted!');
    }
}
