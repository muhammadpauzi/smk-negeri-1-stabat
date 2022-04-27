<div class="d-flex flex-column flex-sm-row align-items-sm-center gap-2 mb-4">
    <div class="d-flex align-items-center">
        <div class="rounded-circle me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                <circle cx="18" cy="18" r="4" />
                <path d="M15 3v4" />
                <path d="M7 3v4" />
                <path d="M3 11h16" />
                <path d="M18 16.496v1.504l1 1" />
            </svg>
        </div>
        <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $page->created_at->format('D, d M Y H:i') }}</small>
    </div>
</div>