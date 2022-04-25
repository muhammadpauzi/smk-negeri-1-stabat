<footer class="footer footer-transparent d-print-none">
    <div class="container-xl mt-5">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <p class="m-0">
                    Copyright &copy; {{ date('Y') }}
                    <a href="{{ route('home.index') }}" class="link-primary">SMK Negeri 1 Stabat</a>.
                    All rights reserved.
                </p>
            </div>
            <div class="col-md-6 flex-column flex-md-row text-end justify-content-end align-items-start align-items-md-center d-flex gap-2">
                <a href="mailto:{{ $schoolProfile->email }}" class="text-muted">
                    <span class="me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <polyline points="3 7 12 13 21 7" />
                        </svg>
                    </span>
                    {{ $schoolProfile->email }}
                </a>
                <a href="telp:{{ $schoolProfile->phone_number }}" class="text-muted">
                    <span class="me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg>
                    </span>
                    {{ $schoolProfile->phone_number }}
                </a>
                <span class="text-muted">
                    <span class="me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 21v-6.5a3.5 3.5 0 0 0 -7 0v6.5h18v-6a4 4 0 0 0 -4 -4h-10.5" />
                            <path d="M12 11v-8h4l2 2l-2 2h-4" />
                            <path d="M6 15h1" />
                        </svg>
                    </span>
                    {{ $schoolProfile->postal_number }}
                </span>
            </div>
        </div>
    </div>
</footer>