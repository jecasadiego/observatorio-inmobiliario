<div class="toast-container" style="z-index: 5;">
    @if (session('success'))
        <div id="toast" class="toast bg-verde text-white show" role="alert" aria-live="assertive" aria-atomic="true">
            <span id="toast-message">{{ session('success') }}</span>

            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                onclick=closeToast() aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div id="toast" class="toast bg-danger text-white show" role="alert" aria-live="assertive"
            aria-atomic="true">
            <span id="toast-message">{{ session('error') }}</span>

            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                onclick=closeToast() aria-label="Close"></button>
        </div>
    @endif

    @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
        <div id="toast" class="toast bg-muted show" role="alert" aria-live="assertive" aria-atomic="true">
            <span id="toast-message">{{ auth()->user()->unreadNotifications->first()->data['message'] }}</span>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                onclick="closeToast('{{ auth()->user()->unreadNotifications->first()->id }}')"
                aria-label="Close"></button>
        </div>
    @endif

</div>
