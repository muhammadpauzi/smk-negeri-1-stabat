<div class="d-flex flex-column flex-sm-row align-items-sm-center gap-2 mb-4">
    <div class="d-flex align-items-center">
        <div class="rounded-circle me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="8.5" cy="8.5" r="1" fill="currentColor" />
                <path d="M4 7v3.859c0 .537 .213 1.052 .593 1.432l8.116 8.116a2.025 2.025 0 0 0 2.864 0l4.834 -4.834a2.025 2.025 0 0 0 0 -2.864l-8.117 -8.116a2.025 2.025 0 0 0 -1.431 -.593h-3.859a3 3 0 0 0 -3 3z" />
            </svg>
        </div>
        <a href="#" class="d-inline-block text-uppercase text-primary fw-normal fs-4">{{ $article->category->name }}</a>
    </div>

    <span class="d-none d-sm-inline-block">•</span>

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
        <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->created_at->format('D, d M Y H:i') }}</small>
    </div>

    <span class="d-none d-md-block">•</span>

    <div class="d-flex align-items-center">
        <div class="rounded-circle me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="12" cy="12" r="2" />
                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
            </svg>
        </div>
        <small class="d-inline-block text-uppercase text-muted fw-normal fs-4">{{ $article->views }} {{ Str::plural('view', $article->views) }}</small>
    </div>

    <span class="d-none d-md-block">•</span>

    <div class="d-flex align-items-center">
        <div class="rounded-circle me-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
            </svg>
        </div>
        <a href="" class="d-inline-block text-uppercase text-primary fw-normal fs-4">{{ $article->author->name }}</a>
    </div>
</div>