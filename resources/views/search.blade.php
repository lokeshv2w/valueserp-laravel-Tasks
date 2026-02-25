<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ValueSERP Search</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <div class="card shadow-lg border-0">
            <div class="card-body p-4">

                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="display-6">🔍</div>
                    <h3 class="fw-bold mb-1">Multi Search</h3>
                    <p class="text-muted mb-0">
                        Search multiple keywords using ValueSERP
                    </p>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center">
                        <span class="me-2">⚠️</span>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                {{-- Search Form --}}
                <form method="POST" action="{{ route('search') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Search Keywords
                        </label>

                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light">
                                🔎
                            </span>
                            <input
                                type="text"
                                name="queries"
                                class="form-control"
                                placeholder="Laravel, PHP Developer, REST API, MySQL"
                                value="{{ old('queries', session('search_input')) }}"
                            >
                        </div>

                        <div class="form-text">
                            Enter up to <strong>5 keywords</strong>, separated by commas
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        Search Results
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

    {{-- Results --}}
    @if (!empty($finalResults))
        <div class="card shadow mt-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Search Results</h4>
                    <a href="{{ route('export.csv') }}" class="btn btn-success btn-sm">
                        ⬇ Download CSV
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                        <tr>
                            <th>Query</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Snippet</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($finalResults as $row)
                            <tr>
                                <td>{{ $row['query'] }}</td>
                                <td>{{ $row['title'] }}</td>
                                <td>
                                    <a href="{{ $row['link'] }}" target="_blank">
                                        {{ $row['link'] }}
                                    </a>
                                </td>
                                <td>{{ $row['snippet'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $finalResults->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    @endif
</div>

</body>
</html>