<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='hostel-expenses'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Hostel Expenses"></x-navbars.navs.auth>
        <!-- End Navbar -->
        @if (Session::has('flash_message'))
            <div class="position-fixed top-1 center z-index-3">
                <div class="toast fade p-2 bg-white show" role="alert" aria-live="assertive" id="successToast"
                    aria-atomic="true">
                    <div class="toast-header border-0">
                        <i class="material-icons text-success me-2">
                            check
                        </i>
                        <span class="me-auto font-weight-bold">Hostel Management Dashboard </span>
                        <small class="text-body">Just Now</small>
                        <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast"
                            aria-label="Close"></i>
                    </div>
                    <hr class="horizontal dark m-0">
                    <div class="toast-body">
                        {{ Session::get('flash_message') }}
                    </div>
                </div>
            </div>
        @endif
        @if (count($expenses) == 0)
            <div class="container-fluid py-4 min-vh-100 d-flex justify-content-center align-items-center">
                <div class="row">
                    <p class="text-7xl text-secondary">No Expenses Available</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn bg-gradient-dark mb-0" href={{ route('expenses.create') }}><i
                                class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                            Expense</a>
                    </div>
                </div>
            </div>
        @else
            <div class="container-fluid py-4 min-vh-100">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white mx-3"><strong>Expenses<strong>
                                </div>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                <a class="btn bg-gradient-dark mb-0" href={{ route('expenses.create') }}><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Expense</a>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    CATEGORY</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    DESCRIPTION</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    AMOUNT SPENT</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    DATE
                                                </th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{ $expense->id }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $expense->category }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $expense->description }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $expense->amount_spent }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-bold">{{ $expense->date_of_expenditure }}</span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a rel="tooltip" class="btn btn-info btn-link"
                                                            href="{{ route('expenses.show', $expense->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">visibility</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ route('expenses.edit', $expense->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('expenses.destroy', $expense->id) }}"
                                                            accept-charset="UTF-8" style="display:inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-link"
                                                                onclick="return confirm(&quot;Confirm delete?&quot;)"
                                                                data-original-title="" title="">
                                                                <i class="material-icons">delete</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    </div>
    @push('js')
        <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    @endpush
</x-layout>
