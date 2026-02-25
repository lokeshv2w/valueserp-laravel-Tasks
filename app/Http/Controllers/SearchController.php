<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ValueSerpService;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SearchResultsExport;

class SearchController extends Controller
{
    protected $valueSerp;

    public function __construct(ValueSerpService $valueSerp)
    {
        $this->valueSerp = $valueSerp;
    }

    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'queries' => 'required|string|min:2|max:500',
        ]);

        $queries = array_filter(array_map(
            'trim',
            explode(',', $request->queries)
        ));

        if (count($queries) > 5) {
            return back()
                ->withErrors('Maximum 5 search queries allowed.')
                ->withInput();
        }

        $finalResults = [];

        try {
            foreach ($queries as $query) {
                $response = $this->valueSerp->search($query);

                if (!empty($response['organic_results'])) {
                    foreach ($response['organic_results'] as $item) {
                        $finalResults[] = [
                            'query'   => $query,
                            'title'   => $item['title'] ?? '',
                            'link'    => $item['link'] ?? '',
                            'snippet' => $item['snippet'] ?? '',
                        ];
                    }
                }
            }

            if (empty($finalResults)) {
                return back()->withErrors('No results found.');
            }

            // Store full data in session
            session([
                'search_results' => $finalResults,
                'search_input'   => $request->queries
            ]);

            // Redirect to GET route (VERY IMPORTANT)
            return redirect()->route('results');

        } catch (\Exception $e) {
            return back()->withErrors('Something went wrong.');
        }
    }

    public function results(Request $request)
    {
        $results = session('search_results');

        if (!$results) {
            return redirect('/')->withErrors('Please search first.');
        }

        $page    = $request->get('page', 1);
        $perPage = 10;

        $collection = collect($results);

        $paginatedResults = new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => route('results'),
            ]
        );

        return view('search', [
            'finalResults' => $paginatedResults
        ]);
    }

    public function exportCsv()
    {
        $results = session('search_results');

        if (!$results) {
            return redirect('/')->withErrors('No data to export.');
        }

        return Excel::download(
            new SearchResultsExport($results),
            'search_results.xlsx'
        );
    }
}
