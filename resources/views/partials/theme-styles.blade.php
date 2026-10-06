    <style>
        [x-cloak] { display: none !important; }

        :root {
            --ink: #16120a;
            --stone: #4a4128;
            --line: #9c8752;
            --paper: #d9c99a;
            --paper-deep: #c3ae76;
            --paper-dark: #a68f57;
            --moss: #2c4025;
            --moss-dark: #0e130a;
            --fern: #6a8850;
            --fog: #c7cdb0;
            --rust: #8c4322;
            --mustard: #a3721f;
            --teal: #2c544c;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Arvo', Georgia, serif;
            color: var(--ink);
            background:
                url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='220' height='220'><g fill='none' stroke='%232c4025' stroke-width='1.4' stroke-opacity='0.14'><path d='M20 200 Q45 155 20 110 Q55 120 60 65 Q66 110 100 98'/><path d='M180 40 Q155 85 185 120 Q150 114 138 165 Q132 125 98 142'/><path d='M110 10 Q100 40 125 55'/></g></svg>"),
                radial-gradient(ellipse 900px 550px at 8% -8%, rgba(163,114,31,.14), transparent 60%),
                radial-gradient(ellipse 1000px 650px at 96% 8%, rgba(44,64,37,.20), transparent 55%),
                radial-gradient(ellipse 800px 550px at 40% 105%, rgba(44,64,37,.16), transparent 60%),
                var(--paper);
            position: relative;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.01em;
        }
        .type-stamp {
            font-family: 'Special Elite', 'Courier New', monospace;
            letter-spacing: .12em;
        }

        /* ================= Global atmosphere: grain + vignette ================= */
        .grain {
            position: fixed;
            inset: -60px;
            z-index: 999;
            pointer-events: none;
            opacity: .05;
            mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/></filter><rect width='100%25' height='100%25' filter='url(%23n)'/></svg>");
        }
        .vignette {
            position: fixed;
            inset: 0;
            z-index: 998;
            pointer-events: none;
            background: radial-gradient(ellipse at center, transparent 45%, rgba(15,12,6,.28) 100%);
        }

        /* ================= Ambient jungle layer ================= */
        .jungle-fx {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }
        .canopy-glow {
            position: absolute;
            width: 46vw;
            height: 46vw;
            max-width: 620px;
            max-height: 620px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .28;
            animation: canopy-drift ease-in-out infinite;
        }
        .canopy-glow-1 { top: -12%; left: -8%; background: radial-gradient(circle, var(--fern), transparent 70%); animation-duration: 26s; }
        .canopy-glow-2 { top: 30%; right: -12%; background: radial-gradient(circle, var(--mustard), transparent 70%); animation-duration: 34s; animation-delay: -8s; }
        .canopy-glow-3 { bottom: -16%; left: 30%; background: radial-gradient(circle, var(--moss), transparent 70%); animation-duration: 30s; animation-delay: -14s; }
        @keyframes canopy-drift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(3vw, -3vw) scale(1.12); }
        }

        .firefly {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--mustard);
            box-shadow: 0 0 8px 2px rgba(192,138,46,.85);
            opacity: 0;
            animation-name: firefly-float;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }
        @keyframes firefly-float {
            0%, 100% { opacity: 0; transform: translate(0, 0); }
            15% { opacity: .9; }
            50% { transform: translate(18px, -26px); opacity: .55; }
            85% { opacity: .9; }
        }

        .leaf-fall {
            position: absolute;
            top: -6%;
            width: 16px;
            height: 16px;
            opacity: 0;
            animation-name: leaf-fall;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
        @keyframes leaf-fall {
            0% { transform: translate(0, 0) rotate(0deg); opacity: 0; }
            8% { opacity: .65; }
            50% { transform: translate(40px, 55vh) rotate(170deg); }
            92% { opacity: .65; }
            100% { transform: translate(-25px, 112vh) rotate(360deg); opacity: 0; }
        }

        /* ================= Corner canopy frame (arching overhead branches) ================= */
        .canopy-frame {
            position: absolute;
            top: -4px;
            left: -4px;
            width: 240px;
            max-width: 46vw;
            height: auto;
            z-index: 3;
            pointer-events: none;
            filter: drop-shadow(0 12px 16px rgba(0,0,0,.4));
        }
        .canopy-frame-r { left: auto; right: -4px; transform: scaleX(-1); }
        @media (min-width: 768px) { .canopy-frame { width: 320px; } }

        .bird {
            position: absolute;
            left: -8%;
            width: 30px;
            height: 15px;
            opacity: 0;
            animation-name: fly-across;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
        .bird-sm { width: 20px; height: 10px; opacity: 0; }
        .bird-flap {
            display: block;
            width: 100%;
            height: 100%;
            animation: wing-flap .5s ease-in-out infinite alternate;
        }
        @keyframes wing-flap {
            from { transform: scaleY(1); }
            to { transform: scaleY(.35); }
        }
        @keyframes fly-across {
            0% { transform: translate(0, 0); opacity: 0; }
            6% { opacity: .45; }
            50% { transform: translate(62vw, -8vh); }
            94% { opacity: .45; }
            100% { transform: translate(126vw, 4vh); opacity: 0; }
        }

        /* ================= Mist & god-rays (scoped inside dark hero blocks) ================= */
        .mist { position: absolute; inset: 0; overflow: hidden; pointer-events: none; z-index: 1; }
        .mist span {
            position: absolute;
            height: 160px;
            width: 75%;
            border-radius: 50%;
            background: radial-gradient(ellipse, rgba(235,229,204,.55), transparent 70%);
            filter: blur(18px);
            animation-name: mist-drift;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }
        @keyframes mist-drift {
            0% { transform: translateX(-15%); }
            50% { transform: translateX(15%); }
            100% { transform: translateX(-15%); }
        }
        .godrays { position: absolute; inset: 0; overflow: hidden; pointer-events: none; z-index: 1; mix-blend-mode: screen; }
        .godrays::before {
            content: '';
            position: absolute;
            top: -60%; left: -30%;
            width: 160%; height: 220%;
            background: repeating-linear-gradient(70deg,
                rgba(255,244,214,.09) 0px, rgba(255,244,214,.09) 40px,
                transparent 70px, transparent 140px);
            filter: blur(14px);
            animation: rays-drift 22s linear infinite;
        }
        @keyframes rays-drift {
            0% { transform: translateX(0) rotate(0deg); }
            100% { transform: translateX(-80px) rotate(1deg); }
        }

        /* ================= Hanging vines ================= */
        .vine-hanger {
            position: absolute;
            top: -6px;
            width: 32px;
            height: auto;
            z-index: 2;
            pointer-events: none;
            filter: drop-shadow(0 3px 4px rgba(0,0,0,.25));
            transform-origin: top center;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }
        .vine-sway-l { left: 16px; animation-name: vine-sway; }
        .vine-sway-r { right: 16px; animation-name: vine-sway-mirror; }
        @keyframes vine-sway {
            0%, 100% { transform: rotate(-4deg); }
            50% { transform: rotate(4deg); }
        }
        @keyframes vine-sway-mirror {
            0%, 100% { transform: scaleX(-1) rotate(-4deg); }
            50% { transform: scaleX(-1) rotate(4deg); }
        }

        /* ================= Torn-edge section divider ================= */
        .torn-divider { line-height: 0; }
        .torn-divider svg { width: 100%; height: 46px; display: block; }
        @media (min-width: 768px) { .torn-divider svg { height: 68px; } }

        /* ================= Buttons: expedition ticket style ================= */
        .btn-ticket {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            font-family: 'Special Elite', 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-size: .78rem;
            background: var(--ink);
            color: var(--paper);
            padding: .9rem 1.7rem;
            border-radius: 3px;
            box-shadow: 0 4px 0 var(--moss-dark), 0 8px 18px -6px rgba(0,0,0,.5);
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        }
        .btn-ticket:hover { background: var(--rust); transform: translateY(2px); box-shadow: 0 2px 0 var(--moss-dark), 0 5px 12px -4px rgba(0,0,0,.5); }
        .btn-ticket:active { transform: translateY(4px); box-shadow: none; }

        .btn-ticket-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            font-family: 'Special Elite', 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-size: .78rem;
            background: transparent;
            color: var(--ink);
            border: 2px dashed var(--ink);
            padding: .8rem 1.6rem;
            border-radius: 3px;
            transition: all .2s ease;
        }
        .btn-ticket-outline:hover { background: var(--ink); color: var(--paper); border-style: solid; }

        /* ================= Field-journal photo cards ================= */
        .field-card {
            position: relative;
            background: var(--paper);
            padding: 9px;
            border: 1px solid var(--paper-dark);
            box-shadow: 0 1px 0 rgba(255,255,255,.5) inset, 0 20px 36px -20px rgba(15,12,6,.6);
            transition: transform .35s cubic-bezier(.2,.8,.2,1), box-shadow .35s ease, z-index 0s;
        }
        .field-card.tilt-l { transform: rotate(-1.6deg); }
        .field-card.tilt-r { transform: rotate(1.4deg); }
        .field-card:hover {
            transform: rotate(0deg) translateY(-8px);
            box-shadow: 0 30px 50px -20px rgba(15,12,6,.7);
            z-index: 5;
        }
        .field-card .item-media { position: relative; border: 1px solid var(--ink); overflow: hidden; }
        .field-card .item-media img {
            filter: sepia(.16) saturate(1.2) contrast(1.06) brightness(.94);
            transition: transform .6s cubic-bezier(.2,.8,.2,1);
        }
        .field-card:hover .item-media img { transform: scale(1.08); }
        .photo-grade { filter: sepia(.2) saturate(1.25) contrast(1.08) brightness(.88) hue-rotate(-6deg); }
        .field-card .item-arrow {
            transition: transform .3s ease, opacity .3s ease;
            opacity: 0;
            transform: translateX(-6px);
        }
        .field-card:hover .item-arrow { opacity: 1; transform: translateX(0); }

        .tape {
            position: absolute;
            top: -11px;
            width: 68px;
            height: 24px;
            background: rgba(192,138,46,.55);
            box-shadow: 0 3px 5px rgba(0,0,0,.25);
            z-index: 4;
        }
        .tape-l { left: 20px; transform: rotate(-7deg); }
        .tape-r { right: 20px; left: auto; transform: rotate(6deg); }

        .price-stamp {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 4;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--paper);
            border: 2px dashed var(--ink);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transform: rotate(-9deg);
            box-shadow: 0 6px 14px rgba(0,0,0,.4);
            font-family: 'Special Elite', monospace;
            text-align: center;
            line-height: 1.05;
        }
        .price-stamp b { font-size: .92rem; color: var(--ink); }
        .price-stamp small { font-size: .5rem; text-transform: uppercase; letter-spacing: .05em; color: var(--stone); }

        /* ================= Nav ================= */
        .nav-paper {
            background: var(--paper);
            border-bottom: 3px solid var(--ink);
            box-shadow: 0 1px 0 var(--line) inset;
        }
        .nav-link {
            position: relative;
            font-family: 'Special Elite', monospace;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--stone);
            transition: color .25s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: -4px;
            height: 2px;
            background: var(--rust);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform .3s ease;
        }
        .nav-link:hover { color: var(--ink); }
        .nav-link:hover::after { transform: scaleX(1); transform-origin: left; }
        .brand-badge {
            width: 42px; height: 42px;
            border-radius: 50%;
            border: 2px dashed var(--moss);
            display: flex; align-items: center; justify-content: center;
            background: var(--paper-deep);
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--ink);
            background: var(--paper);
            border: 2px dashed var(--ink);
            padding: 22px;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            top: 45%;
            box-shadow: 0 8px 18px -4px rgba(0,0,0,.45);
            transition: all 0.25s ease;
        }
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: var(--ink);
            color: var(--paper);
            border-style: solid;
            border-color: var(--ink);
            transform: scale(1.06);
        }
        .swiper-button-next::after,
        .swiper-button-prev::after { font-size: 15px; font-weight: bold; }
        .swiper-pagination-bullet {
            background: transparent;
            border: 1.5px solid var(--paper);
            opacity: .8;
            width: 9px;
            height: 9px;
        }
        .swiper-pagination-bullet-active { background: var(--mustard); border-color: var(--mustard); }

        /* ================= Number stepper (no native spinner) ================= */
        .no-spinner::-webkit-outer-spin-button,
        .no-spinner::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .no-spinner { -moz-appearance: textfield; }
        .stepper-btn {
            width: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--ink);
            transition: background .2s ease;
            user-select: none;
        }
        .stepper-btn:hover { background: var(--paper-deep); }
        .stepper-btn:active { background: var(--paper-dark); }

        /* ================= Flatpickr theme (retro) ================= */
        .flatpickr-calendar {
            background: var(--paper) !important;
            border: 2px solid var(--ink) !important;
            border-radius: 0 !important;
            box-shadow: 0 16px 34px -8px rgba(0,0,0,.5) !important;
            font-family: 'Arvo', Georgia, serif !important;
        }
        .flatpickr-calendar.arrowTop::before,
        .flatpickr-calendar.arrowTop::after { display: none !important; }
        .flatpickr-months { background: var(--ink); padding: .6rem 0; }
        .flatpickr-current-month { color: var(--paper) !important; font-family: 'Playfair Display', serif !important; }
        .flatpickr-current-month input.cur-year { color: var(--paper) !important; font-family: 'Playfair Display', serif !important; }
        .flatpickr-current-month .flatpickr-monthDropdown-months { color: var(--ink) !important; background: var(--paper) !important; }
        .flatpickr-prev-month, .flatpickr-next-month { color: var(--paper) !important; fill: var(--paper) !important; }
        .flatpickr-prev-month:hover svg, .flatpickr-next-month:hover svg { fill: var(--mustard) !important; }
        .flatpickr-weekdays { background: var(--paper-deep) !important; }
        span.flatpickr-weekday {
            color: var(--stone) !important;
            background: var(--paper-deep) !important;
            font-family: 'Special Elite', monospace !important;
            font-size: .62rem !important;
            text-transform: uppercase;
        }
        .flatpickr-day { color: var(--ink) !important; border-radius: 0 !important; }
        .flatpickr-day.today { border-color: var(--rust) !important; }
        .flatpickr-day:hover { background: var(--paper-deep) !important; border-color: var(--paper-dark) !important; }
        .flatpickr-day.selected, .flatpickr-day.selected:hover {
            background: var(--rust) !important;
            border-color: var(--rust) !important;
            color: var(--paper) !important;
        }
        .flatpickr-day.flatpickr-disabled, .flatpickr-day.flatpickr-disabled:hover,
        .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay {
            color: var(--paper-dark) !important;
        }

        @media (prefers-reduced-motion: reduce) {
            .canopy-glow, .firefly, .bird, .bird-flap, .vine-hanger, .leaf-fall, .field-card,
            .field-card .item-media img, .mist span, .godrays::before {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
