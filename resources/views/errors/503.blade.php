<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} — Under Maintenance</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Mono:wght@400;500&display=swap');

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #0a0a0f;
            --surface: #13131a;
            --border: #1e1e2e;
            --accent: #f0a500;
            --text: #e8e8f0;
            --muted: #6b6b80;
            --glow: rgba(240, 165, 0, 0.25);
        }

        html,
        body {
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Mono', monospace;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.18;
            pointer-events: none;
            animation: drift 14s ease-in-out infinite alternate;
        }

        .blob-1 {
            width: 500px;
            height: 500px;
            background: var(--accent);
            top: -200px;
            left: -150px;
        }

        .blob-2 {
            width: 380px;
            height: 380px;
            background: #7c3aed;
            bottom: -180px;
            right: -120px;
            animation-delay: -7s;
        }

        @keyframes drift {
            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(40px, 30px) scale(1.08);
            }
        }

        .scene {
            position: relative;
            z-index: 1;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.9rem;
            border: 1px solid var(--border);
            border-radius: 99px;
            background: var(--surface);
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 2.5rem;
        }

        .badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(0.7);
            }
        }

        .headline {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.8rem, 8vw, 6.5rem);
            line-height: 1.05;
            letter-spacing: -0.02em;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .headline em {
            font-style: italic;
            color: var(--accent);
        }

        .sub {
            font-size: clamp(0.8rem, 2vw, 0.95rem);
            color: var(--muted);
            text-align: center;
            max-width: 440px;
            line-height: 1.7;
            margin-bottom: 3.5rem;
        }

        .countdown {
            display: flex;
            gap: 1.25rem;
            margin-bottom: 3.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .unit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
        }

        .unit-value {
            width: 72px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: 12px;
            font-size: 1.75rem;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            transition: border-color 0.3s;
        }

        .unit-value::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.04) 0%, transparent 60%);
        }

        .unit-value.tick {
            border-color: var(--accent);
            box-shadow: 0 0 16px var(--glow);
        }

        .unit-label {
            font-size: 0.6rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .divider {
            width: 1px;
            height: 40px;
            background: var(--border);
            margin: 0 0.25rem;
            align-self: center;
        }

        .status-bar {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 0.9rem 1.6rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
            font-size: 0.72rem;
            color: var(--muted);
            letter-spacing: 0.06em;
            flex-wrap: wrap;
            justify-content: center;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 6px #22c55e;
        }

        .status-dot.warn {
            background: var(--accent);
            box-shadow: 0 0 6px var(--accent);
        }

        .brand {
            position: fixed;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            opacity: 0.5;
        }

        @media (max-width: 480px) {
            .unit-value {
                width: 58px;
                height: 58px;
                font-size: 1.4rem;
            }

            .divider {
                display: none;
            }

            .status-bar {
                gap: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="scene">
        <span class="badge"><span class="dot"></span>Scheduled Maintenance</span>

        <h1 class="headline">We're<br><em>rebuilding</em><br>things.</h1>

        <p class="sub">
            Our team is working hard to bring you something better.
            The site will be back online shortly — thank you for your patience.
        </p>

        <div class="status-bar">
            <div class="status-item"><span class="status-dot"></span>Database — Operational</div>
            <div class="status-item"><span class="status-dot warn"></span>Web App — Maintenance</div>
            <div class="status-item"><span class="status-dot"></span>API — Operational</div>
        </div>
    </div>

    <span class="brand">{{ config('app.name') }}</span>

</body>

</html>