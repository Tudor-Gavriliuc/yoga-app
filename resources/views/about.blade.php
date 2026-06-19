<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayYoga - About Yoga</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream:      #F7F3EE;
            --warm-white: #FDFAF6;
            --green-dark: #2A4A2E;
            --green-mid:  #3E6B44;
            --green-light:#EBF1E8;
            --terra:      #C0582A;
            --gold:       #B08A3E;
            --text-dark:  #1E1E1E;
            --text-mid:   #4A4A4A;
            --text-light: #7A7A7A;
            --border:     rgba(42,74,46,.12);
            --shadow-sm:  0 2px 8px rgba(0,0,0,.07);
            --shadow-md:  0 10px 36px rgba(0,0,0,.12);
            --radius:     20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at 0% 0%, #EEF4EB 0%, var(--warm-white) 45%), var(--warm-white);
            color: var(--text-dark);
            min-height: 100vh;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            background: rgba(253,250,246,.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(42,74,46,.08);
        }

        .nav-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.45rem;
            font-weight: 700;
            color: var(--green-dark);
            text-decoration: none;
            letter-spacing: -.3px;
        }

        .nav-logo span { color: var(--terra); }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-mid);
            font-size: .875rem;
            font-weight: 500;
            transition: color .2s;
        }

        .nav-links a:hover,
        .nav-links a.active { color: var(--green-dark); }

        .language-switcher {
            display: flex;
            align-items: center;
        }

        .lang-select {
            padding: .4rem .75rem;
            border: 1px solid rgba(42,74,46,.15);
            border-radius: 6px;
            font-size: .875rem;
            font-weight: 500;
            background: #fff;
            color: var(--text-mid);
            cursor: pointer;
            transition: border-color .2s, background .2s;
            font-family: 'Inter', sans-serif;
        }

        .lang-select:hover {
            border-color: rgba(42,74,46,.3);
            background: var(--green-light);
        }

        .lang-select:focus {
            outline: none;
            border-color: var(--green-dark);
            background: var(--green-light);
        }

        .nav-cta {
            background: var(--green-dark);
            color: #fff !important;
            border-radius: 50px;
            padding: .5rem 1.2rem;
            font-weight: 600 !important;
        }

        .page {
            max-width: 1140px;
            margin: 0 auto;
            padding: 3rem 1.5rem 4.5rem;
        }

        .hero {
            background: linear-gradient(145deg, var(--green-light), #F8FBF6 58%, var(--warm-white));
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: var(--shadow-md);
            padding: 3rem 2rem;
            margin-bottom: 1.8rem;
            text-align: center;
        }

        .eyebrow {
            display: inline-block;
            font-size: .75rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--terra);
            font-weight: 600;
            margin-bottom: .8rem;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--green-dark);
            font-size: clamp(2rem, 4vw, 3.1rem);
            margin-bottom: .6rem;
        }

        .hero p {
            max-width: 700px;
            margin: 0 auto;
            color: var(--text-mid);
            line-height: 1.75;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .panel {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 1.4rem;
        }

        .panel h2 {
            font-family: 'Playfair Display', serif;
            color: var(--green-dark);
            margin-bottom: .55rem;
            font-size: 1.45rem;
        }

        .panel p {
            color: var(--text-mid);
            line-height: 1.75;
            font-size: .95rem;
        }

        .tags {
            margin-top: 1rem;
            display: flex;
            gap: .55rem;
            flex-wrap: wrap;
        }

        .tag {
            display: inline-block;
            border-radius: 999px;
            background: var(--green-light);
            color: var(--green-dark);
            font-size: .74rem;
            font-weight: 600;
            padding: .32rem .68rem;
            letter-spacing: .02em;
        }

        .facts {
            margin-top: .8rem;
        }

        .facts h2 {
            font-family: 'Playfair Display', serif;
            color: var(--green-dark);
            margin-bottom: .85rem;
            font-size: 1.7rem;
        }

        .facts-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .9rem;
        }

        .fact-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .fact-num {
            display: inline-block;
            color: var(--terra);
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .08em;
            margin-bottom: .4rem;
        }

        .fact-title {
            color: var(--green-dark);
            font-weight: 600;
            margin-bottom: .35rem;
            font-size: .98rem;
        }

        .fact-card p {
            color: var(--text-mid);
            line-height: 1.6;
            font-size: .88rem;
        }

        .cta-row {
            margin-top: 1.15rem;
            display: flex;
            gap: .65rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border-radius: 999px;
            padding: .72rem 1.25rem;
            font-size: .88rem;
            font-weight: 600;
            transition: transform .15s, box-shadow .2s, background .2s;
        }

        .btn:hover { transform: translateY(-2px); }

        .btn-primary {
            background: var(--green-dark);
            color: #fff;
            box-shadow: 0 8px 22px rgba(42,74,46,.22);
        }

        .btn-secondary {
            background: var(--cream);
            color: var(--green-dark);
            border: 1px solid rgba(42,74,46,.13);
        }

        footer {
            border-top: 1px solid rgba(42,74,46,.09);
            margin-top: 3rem;
            padding: 1.6rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: .8rem;
            flex-wrap: wrap;
            gap: .5rem;
        }

        @media (max-width: 960px) {
            .facts-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .about-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 700px) {
            nav { padding: 0 1.2rem; }
            .nav-links { display: none; }
            .page { padding: 2rem 1rem 3.2rem; }
            .hero { padding: 2.1rem 1.1rem; }
            .facts-grid { grid-template-columns: 1fr; }
            footer { justify-content: center; text-align: center; }
        }
    </style>
</head>
<body>
    <nav>
        <a class="nav-logo" href="{{ url('/') }}">Pay<span>Yoga</span></a>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">{{ __('messages.our_plans') }}</a></li>
            <li><a href="{{ route('schedule') }}">{{ __('messages.nav_plans') }}</a></li>
            <li><a class="active" href="{{ route('about') }}">{{ __('messages.nav_about') }}</a></li>
            <li class="language-switcher">
                <select onchange="window.location.href = '/language/' + this.value" class="lang-select">
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    <option value="ro" {{ app()->getLocale() === 'ro' ? 'selected' : '' }}>Română</option>
                    <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>Русский</option>
                </select>
            </li>
            <li><a class="nav-cta" href="{{ url('/') }}#plans">{{ __('messages.start_free_trial') }}</a></li>
        </ul>
    </nav>

    <main class="page">
        <section class="hero">
            <span class="eyebrow">{{ __('messages.about_yoga') }}</span>
            <h1>{{ __('messages.practice_title') }}</h1>
            <p>{{ __('messages.practice_desc') }}</p>
        </section>

        <section class="about-grid">
            <article class="panel">
                <h2>{{ __('messages.what_is_yoga') }}</h2>
                <p>{{ __('messages.what_is_yoga_desc') }}</p>
                <div class="tags">
                    <span class="tag">{{ __('messages.tag_movement') }}</span>
                    <span class="tag">{{ __('messages.tag_breath') }}</span>
                    <span class="tag">{{ __('messages.tag_focus') }}</span>
                    <span class="tag">{{ __('messages.tag_recovery') }}</span>
                </div>
            </article>
            <article class="panel">
                <h2>{{ __('messages.why_love_yoga') }}</h2>
                <p>{{ __('messages.why_love_yoga_desc') }}</p>
            </article>
        </section>

        <section class="facts">
            <h2>{{ __('messages.interesting_facts') }}</h2>
            <div class="facts-grid">
                <article class="fact-card">
                    <span class="fact-num">FACT 01</span>
                    <div class="fact-title">{{ __('messages.fact_ancient') }}</div>
                    <p>{{ __('messages.fact_ancient_desc') }}</p>
                </article>
                <article class="fact-card">
                    <span class="fact-num">FACT 02</span>
                    <div class="fact-title">{{ __('messages.fact_breathing') }}</div>
                    <p>{{ __('messages.fact_breathing_desc') }}</p>
                </article>
                <article class="fact-card">
                    <span class="fact-num">FACT 03</span>
                    <div class="fact-title">{{ __('messages.fact_consistency') }}</div>
                    <p>{{ __('messages.fact_consistency_desc') }}</p>
                </article>
                <article class="fact-card">
                    <span class="fact-num">FACT 04</span>
                    <div class="fact-title">{{ __('messages.fact_flexibility') }}</div>
                    <p>{{ __('messages.fact_flexibility_desc') }}</p>
                </article>
                <article class="fact-card">
                    <span class="fact-num">FACT 05</span>
                    <div class="fact-title">{{ __('messages.fact_strength') }}</div>
                    <p>{{ __('messages.fact_strength_desc') }}</p>
                </article>
                <article class="fact-card">
                    <span class="fact-num">FACT 06</span>
                    <div class="fact-title">{{ __('messages.fact_mobility') }}</div>
                    <p>{{ __('messages.fact_mobility_desc') }}</p>
                </article>
            </div>
        </section>

        <div class="cta-row">
            <a class="btn btn-primary" href="{{ route('schedule') }}">{{ __('messages.schedule_title') }}</a>
            <a class="btn btn-secondary" href="{{ url('/') }}#plans">{{ __('messages.our_plans') }}</a>
        </div>
    </main>

    <footer>
        <span>&copy; {{ date('Y') }} PayYoga. {{ __('messages.copyright') }}</span>
        <span>{{ __('messages.footer_studio_classes') }}</span>
    </footer>
</body>
</html>