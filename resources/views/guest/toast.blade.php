@if (Session::has('flash_message'))
    <div class="position-fixed bottom-0 start-50 translate-middle-x mt-3" style="z-index: 11">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert"
            aria-live="assertive" aria-atomic="true" style="min-height: 60px">
            <div class="d-flex">
                <div class="toast-body">
                    {{ Session::get('flash_message') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
