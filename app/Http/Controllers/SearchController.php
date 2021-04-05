<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Search;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a search results.
     *
     * @param $value
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search.index', [
            'title' => 'Szukaj',
        ]);
    }

    /**
     * Display a search results.
     *
     * @param $value
     * @return \Illuminate\Http\Response
     */
    public function search(Search $request, string $scope)
    {
        $value = trim($request->value);

        // MAYBE TO DO: departments, users, file categories, files, notes, replies, permissions, post categories, attachments
        /**
         * Return Systems
         * TODO: search by:  name url description
         */
        // $systems = \App\Models\Protective

        /**
         * Return Partners
         * TODO: search by  name number_rau code nip regon type
         */
        // $partners = \App\Models\Protective

        /**
         * Return News
         * TODO: search by  content
         */
        // $news = \App\Models\Protective

        /**
         * Return Posts
         * TODO: search by  title content
         */
        // $posts = \App\Models\Protective

        /**
         * Return Risks
         * TODO: search by  code name category group grace_period
         */
        // $risks = \App\Models\Protective

        /**
         * Return Funds
         * TODO: search by  code name type currency status start_date
         */
        // $funds = \App\Models\Protective

        /**
         * Return Employees
         * TODO: search by  name code_owu edit_date status
         */
        $employees = \App\Models\Employee::select('*')
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('code_owu', 'like', '%' . $value . '%')
            ->take(25)
            ->get();

        /**
         * Return Bancassurances
         * TODO: search by  name code dist_short dist code_owu subscription edit_date status
         */
        $bancassurances = \App\Models\Bancassurance::select('*')
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('code', 'like', '%' . $value . '%')
            ->orWhere('code_owu', 'like', '%' . $value . '%')
            ->take(25)
            ->get();

        /**
         * Return Protectives
         * search by  name code dist_short dist code_owu subscription edit_date status
         */
        $protectives = \App\Models\Protective::select('*')
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('code', 'like', '%' . $value . '%')
            ->orWhere('code_owu', 'like', '%' . $value . '%')
            ->take(25)
            ->get();

        /**
         * Return Investments
         * search by  group name code dist_short dist code_owu code_toil edit_date type status
         */
        $investments = \App\Models\Investment::select('*')
            ->where('name', 'like', '%' . $value . '%')
            ->orWhere('code', 'like', '%' . $value . '%')
            ->orWhere('code_owu', 'like', '%' . $value . '%')
            ->orWhere('code_toil', 'like', '%' . $value . '%')
            ->take(25)
            ->get();

        return view('search.results', [
            'title' => 'Wyniki wyszukiwania',
            'value' => $value,
            'investments' => $investments,
            'protectives' => $protectives,
            'bancassurances' => $bancassurances,
            'employees' => $employees,
        ]);
    }
}