:::writing{variant="document" id="58321"}
@extends('Frontend.Layouts.main')

@section('content')
    <section class="error-page">
        <div class="error-bg-text">404</div>

        <div class="error-content">
            <span class="error-label">ERROR 404</span>

            <h1>
                This page<br>
                <span>got lost.</span>
            </h1>

            <p>
                Looks like the page you're looking for doesn't exist,
                has moved, or took an unexpected detour.
            </p>

            <a href="{{ url('/') }}" class="error-btn">
                <span>Back to Home</span>
                <span class="arrow">→</span>
            </a>
        </div>

        <div class="error-footer">
            <span>404 — PAGE NOT FOUND</span>
            <span>© {{ date('Y') }}</span>
        </div>
    </section>
@endsection

@push('styles')
<style>
    :root {
        --ink: #111;
        --muted: #777;
        --line: #e5e5e5;
        --soft: #f7f7f5;
        --accent: #c0392b;
    }

    .error-page {
        min-height: calc(100vh - 80px);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--soft);
        padding: 80px 24px;
    }

    /* Huge background 404 */
    .error-bg-text {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -56%);
        font-size: clamp(15rem, 35vw, 38rem);
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.08em;
        color: rgba(17, 17, 17, 0.035);
        user-select: none;
        pointer-events: none;
    }

    .error-content {
        position: relative;
        z-index: 2;
        width: min(680px, 100%);
        text-align: center;
    }

    .error-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        color: var(--accent);
    }

    .error-label::before,
    .error-label::after {
        content: "";
        width: 28px;
        height: 1px;
        background: var(--accent);
    }

    .error-content h1 {
        margin: 0;
        font-size: clamp(4rem, 9vw, 7.5rem);
        line-height: 0.9;
        font-weight: 700;
        letter-spacing: -0.07em;
        color: var(--ink);
    }

    .error-content h1 span {
        font-style: italic;
        font-weight: 400;
    }

    .error-content p {
        max-width: 470px;
        margin: 30px auto 0;
        color: var(--muted);
        font-size: 1rem;
        line-height: 1.8;
    }

    .error-btn {
        display: inline-flex;
        align-items: center;
        gap: 22px;
        margin-top: 36px;
        padding: 15px 22px;
        background: var(--ink);
        color: #fff;
        text-decoration: none;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition:
            background 0.25s ease,
            transform 0.25s ease,
            gap 0.25s ease;
    }

    .error-btn:hover {
        background: var(--accent);
        color: #fff;
        gap: 30px;
        transform: translateY(-2px);
    }

    .arrow {
        font-size: 1.2rem;
        line-height: 1;
        transition: transform 0.25s ease;
    }

    .error-btn:hover .arrow {
        transform: translateX(4px);
    }

    .error-footer {
        position: absolute;
        z-index: 2;
        bottom: 24px;
        left: 30px;
        right: 30px;

        display: flex;
        justify-content: space-between;

        color: #999;
        font-size: 0.65rem;
        letter-spacing: 0.12em;
    }

    /* Subtle entrance animation */
    .error-content {
        animation: errorReveal 0.7s ease-out both;
    }

    @keyframes errorReveal {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .error-page {
            min-height: calc(100vh - 60px);
            padding: 60px 20px;
        }

        .error-content h1 {
            font-size: 4.5rem;
        }

        .error-content p {
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .error-bg-text {
            font-size: 15rem;
        }

        .error-footer {
            left: 20px;
            right: 20px;
            bottom: 18px;
        }

        .error-footer span:last-child {
            display: none;
        }
    }
</style>
@endpush
:::
