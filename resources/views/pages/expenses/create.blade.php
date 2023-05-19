<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="hostel-expenses"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Expenses'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('{{ asset('assets') }}/img/expenses/costs-vs-expenses.jpg'); background-size: cover;"> <span
                    class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Add Expense Details</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                         <form method='POST'
                            action="{{ route('expenses.create') }}">

                            @csrf
                            <div class="row">
                                <div class="form-inline mb-3 col-md-9">
                                    <label class="my-1 mr-2 fs-5 text-dark">Expense category</label>
                                    <select class="form-control custom-select border border-2 p-2 my-1 mr-sm-2"
                                        name="category">
                                        <option>Utilities</option>
                                        <option>Maintenance</option>
                                        <option>Kitchen equipment</option>
                                        <option>Staff salaries</option>
                                        <option>Security</option>
                                        <option>Office Supplies</option>
                                        <option>Furniture</option>
                                        <option>Bedding</option>
                                        <option>Property Taxes</option>
                                        <option>Others</option>
                                    </select>
                                    @error('category')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                 <div class="mb-3 col-md-9">
                                    <label class="form-label d-block fs-5 text-dark">Description</label>
                                    <textarea class=" p-2 form-control border" placeholder="Leave a description here" style="resize: none" name="description" id="" rows="10"></textarea>
                                    @error('description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                 </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Amount spent</label>
                                    <input type="number" placeholder="eg.1000000" name="amount_spent"
                                        class="form-control border border-2 p-2">
                                    @error('amount_spent')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label class="form-label fs-5 text-dark">Date</label>
                                    <input type="date" name="date_of_expenditure"
                                        class="form-control border border-2 p-2">
                                    @error('date_of_expenditure')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
