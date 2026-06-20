<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayYoga — Find Your Flow</title>
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
            --terra-light:#F9EBE3;
            --gold:       #B08A3E;
            --gold-light: #FAF3E0;
            --text-dark:  #1E1E1E;
            --text-mid:   #4A4A4A;
            --text-light: #7A7A7A;
            --shadow-sm:  0 2px 8px rgba(0,0,0,.07);
            --shadow-md:  0 8px 32px rgba(0,0,0,.10);
            --shadow-lg:  0 20px 60px rgba(0,0,0,.14);
            --radius:     20px;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: var(--warm-white); color: var(--text-dark); min-height: 100vh; }
        nav {
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2.5rem; height: 68px;
            background: rgba(253,250,246,.88);
            backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(42,74,46,.08);
        }
        .nav-logo { font-family: 'Playfair Display', serif; font-size: 1.45rem; font-weight: 700; color: var(--green-dark); text-decoration: none; letter-spacing: -.3px; }
        .nav-logo span { color: var(--terra); }
        .nav-links { display: flex; align-items: center; gap: 2rem; list-style: none; }
        .nav-links a { text-decoration: none; font-size: .875rem; font-weight: 500; color: var(--text-mid); transition: color .2s; }
        .nav-links a:hover { color: var(--green-dark); }
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
        .nav-cta { background: var(--green-dark) !important; color: #fff !important; padding: .5rem 1.25rem; border-radius: 50px; font-weight: 600 !important; transition: background .2s, transform .15s !important; }
        .nav-cta:hover { background: var(--green-mid) !important; transform: translateY(-1px); }
        .hero {
            text-align: center;
            min-height: calc(100vh - 68px);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 4rem 1.5rem 5rem;
            background: linear-gradient(160deg, var(--green-light) 0%, var(--warm-white) 60%);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background-image: radial-gradient(circle at 15% 50%, rgba(176,138,62,.10) 0%, transparent 55%), radial-gradient(circle at 85% 20%, rgba(42,74,46,.08) 0%, transparent 50%);
            pointer-events: none;
        }
        .hero-eyebrow { display: inline-block; font-size: .75rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--terra); margin-bottom: 1rem; }
        .hero h1 { font-family: 'Playfair Display', serif; font-size: clamp(2.4rem,5vw,3.8rem); font-weight: 700; line-height: 1.15; color: var(--green-dark); max-width: 640px; margin: 0 auto 1rem; }
        .hero h1 em { font-style: italic; color: var(--terra); }
        .hero-sub { font-size: 1.05rem; color: var(--text-mid); max-width: 460px; margin: 0 auto 0; line-height: 1.7; font-weight: 300; }
        .hero-scroll { position: absolute; bottom: 2.25rem; left: 50%; transform: translateX(-50%); display: flex; flex-direction: column; align-items: center; gap: .4rem; color: var(--text-light); font-size: .72rem; letter-spacing: .1em; text-transform: uppercase; text-decoration: none; transition: color .2s; }
        .hero-scroll:hover { color: var(--green-dark); }
        .hero-scroll svg { animation: bounce 1.8s ease-in-out infinite; }
        @keyframes bounce { 0%,100% { transform: translateY(0); } 50% { transform: translateY(5px); } }
        .plans-section { padding: 4rem 1.5rem 6rem; max-width: 1160px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 3.5rem; }
        .section-eyebrow { font-size: .75rem; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; color: var(--gold); display: block; margin-bottom: .65rem; }
        .section-header h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem,3.5vw,2.6rem); font-weight: 700; color: var(--green-dark); margin-bottom: .75rem; }
        .section-header p { color: var(--text-light); font-size: .95rem; max-width: 420px; margin: 0 auto; line-height: 1.7; }
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; align-items: start; }
        .plan-card {
            background: #fff; border-radius: var(--radius); padding: 2rem 1.75rem 2.25rem;
            box-shadow: var(--shadow-sm); border: 1.5px solid rgba(42,74,46,.09);
            position: relative; transition: transform .25s, box-shadow .25s;
            display: flex; flex-direction: column;
        }
        .plan-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); }
        .plan-card.popular { background: var(--green-dark); border-color: transparent; box-shadow: var(--shadow-lg); transform: scale(1.04); color: #fff; }
        .plan-card.popular:hover { transform: scale(1.04) translateY(-6px); }
        .popular-badge { position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background: var(--terra); color: #fff; font-size: .7rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; padding: .3rem .9rem; border-radius: 50px; white-space: nowrap; }
        .plan-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 1.25rem; }
        .plan-card:not(.popular) .plan-icon { background: var(--green-light); }
        .plan-card.popular .plan-icon { background: rgba(255,255,255,.15); }
        .plan-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 600; margin-bottom: .35rem; }
        .plan-card:not(.popular) .plan-name { color: var(--green-dark); }
        .plan-card.popular .plan-name { color: #fff; }
        .plan-tagline { font-size: .8rem; margin-bottom: 1.5rem; line-height: 1.5; }
        .plan-card:not(.popular) .plan-tagline { color: var(--text-light); }
        .plan-card.popular .plan-tagline { color: rgba(255,255,255,.65); }
        .plan-price-row { display: flex; align-items: baseline; gap: .3rem; margin-bottom: 1.5rem; }
        .price-amount { font-family: 'Playfair Display', serif; font-size: 2.4rem; font-weight: 700; line-height: 1; }
        .plan-card:not(.popular) .price-amount { color: var(--green-dark); }
        .plan-card.popular .price-amount { color: #fff; }
        .price-currency { font-size: 1.1rem; font-weight: 600; align-self: flex-start; margin-top: .3rem; }
        .price-period { font-size: .8rem; }
        .plan-card:not(.popular) .price-period { color: var(--text-light); }
        .plan-card.popular .price-period { color: rgba(255,255,255,.6); }
        .price-savings { display: inline-block; font-size: .72rem; font-weight: 600; padding: .2rem .65rem; border-radius: 50px; margin-bottom: 1.5rem; letter-spacing: .03em; }
        .plan-card:not(.popular) .price-savings { background: var(--gold-light); color: var(--gold); }
        .plan-card.popular .price-savings { background: rgba(176,138,62,.25); color: #F5D98A; }
        .plan-divider { height: 1px; margin-bottom: 1.25rem; border: none; }
        .plan-card:not(.popular) .plan-divider { background: rgba(42,74,46,.09); }
        .plan-card.popular .plan-divider { background: rgba(255,255,255,.15); }
        .features-list { list-style: none; display: flex; flex-direction: column; gap: .65rem; margin-bottom: 2rem; flex-grow: 1; }
        .features-list li { display: flex; align-items: flex-start; gap: .6rem; font-size: .855rem; line-height: 1.5; }
        .plan-card:not(.popular) .features-list li { color: var(--text-mid); }
        .plan-card.popular .features-list li { color: rgba(255,255,255,.85); }
        .check-icon { width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; font-size: .65rem; }
        .plan-card:not(.popular) .check-icon { background: var(--green-light); color: var(--green-mid); }
        .plan-card.popular .check-icon { background: rgba(255,255,255,.2); color: #fff; }
        .btn-plan { display: block; text-align: center; padding: .85rem 1.5rem; border-radius: 50px; font-size: .9rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: transform .15s, background .2s, box-shadow .2s; letter-spacing: .01em; }
        .btn-plan:hover { transform: translateY(-2px); }
        .plan-card:not(.popular) .btn-plan { background: var(--green-light); color: var(--green-dark); }
        .plan-card:not(.popular) .btn-plan:hover { background: var(--green-dark); color: #fff; box-shadow: 0 6px 20px rgba(42,74,46,.25); }
        .plan-card.popular .btn-plan { background: #fff; color: var(--green-dark); box-shadow: 0 4px 18px rgba(0,0,0,.18); }
        .plan-card.popular .btn-plan:hover { background: var(--cream); box-shadow: 0 8px 28px rgba(0,0,0,.22); }
        .guarantee { text-align: center; margin-top: 2.5rem; display: flex; align-items: center; justify-content: center; gap: .6rem; font-size: .85rem; color: var(--text-light); }
        footer { border-top: 1px solid rgba(42,74,46,.09); padding: 1.75rem 2.5rem; display: flex; align-items: center; justify-content: space-between; font-size: .8rem; color: var(--text-light); flex-wrap: wrap; gap: .5rem; }
        footer a { color: var(--text-light); text-decoration: none; transition: color .2s; }
        footer a:hover { color: var(--green-dark); }
        .footer-links { display: flex; gap: 1.5rem; }
        @media (max-width: 860px) { .plan-card.popular { transform: scale(1); } .plan-card.popular:hover { transform: translateY(-6px); } }
        @media (max-width: 600px) { nav { padding: 0 1.25rem; } .nav-links { display: none; } .hero { padding: 3rem 1.25rem 5rem; } .plans-section { padding: 2.5rem 1.25rem 4rem; } footer { justify-content: center; text-align: center; } }
    </style>
</head>
<body>

    <nav>
        <a class="nav-logo" href="{{ url('/') }}">Pay<span>Yoga</span></a>
        <ul class="nav-links">
            <li><a href="{{ route('about') }}">{{ __('messages.nav_about') }}</a></li>
            <li><a href="{{ route('schedule') }}">{{ __('messages.nav_plans') }}</a></li>
            <li><a href="#plans">{{ __('messages.our_plans') }}</a></li>
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
                    @endif
                @endauth
            @endif
            <li class="language-switcher">
                <select onchange="window.location.href = '/language/' + this.value" class="lang-select">
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    <option value="ro" {{ app()->getLocale() === 'ro' ? 'selected' : '' }}>Română</option>
                    <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>Русский</option>
                </select>
            </li>
            <li><a class="nav-cta" href="#plans">{{ __('messages.start_free_trial') }}</a></li>
        </ul>
    </nav>

    <section class="hero">
        <span class="hero-eyebrow">✦ {{ __('messages.welcome') }}</span>
        <h1>{{ __('messages.find_your_flow') }}<br><em>{{ __('messages.discover') }}</em></h1>
        <p class="hero-sub">{{ __('messages.choose_plan') }}</p>
        <a class="hero-scroll" href="#plans">
            {{ __('messages.scroll_down') }}
            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
        </a>
    </section>

    <section class="plans-section" id="plans">
        <div class="section-header">
            <span class="section-eyebrow">✦ {{ __('messages.our_plans') }}</span>
            <h2>{{ __('messages.plans_header') }}</h2>
            <p>{{ __('messages.plans_subtitle') }}</p>
        </div>

        <div class="cards-grid">

            <div class="plan-card">
                <div class="plan-icon">🧘</div>
                <div class="plan-name">{{ __('messages.single_session') }}</div>
                <div class="plan-tagline">{{ __('messages.single_tagline') }}</div>
                <div class="plan-price-row">
                    <span class="price-currency">$</span>
                    <span class="price-amount">18</span>
                    <span class="price-period">{{ __('messages.per_session') }}</span>
                </div>
                <hr class="plan-divider">
                <ul class="features-list">
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_1_pass') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_1_valid') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_1_style') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_1_materials') }}</li>
                </ul>
                <a href="#" class="btn-plan">{{ __('messages.book_class') }}</a>
            </div>

            <div class="plan-card">
                <div class="plan-icon">🌿</div>
                <div class="plan-name">{{ __('messages.monthly') }}</div>
                <div class="plan-tagline">{{ __('messages.monthly_tagline') }}</div>
                <div class="plan-price-row">
                    <span class="price-currency">$</span>
                    <span class="price-amount">59</span>
                    <span class="price-period">{{ __('messages.per_month') }}</span>
                </div>
                <span class="price-savings">{{ __('messages.price_per_class') }}</span>
                <hr class="plan-divider">
                <ul class="features-list">
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_2_unlimited') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_2_posture') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_2_priority') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_2_levels') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_2_cancel') }}</li>
                </ul>
                <a href="#" class="btn-plan">{{ __('messages.get_started') }}</a>
            </div>

            <div class="plan-card popular">
                <span class="popular-badge">{{ __('messages.most_popular') }}</span>
                <div class="plan-icon">🌸</div>
                <div class="plan-name">{{ __('messages.three_months') }}</div>
                <div class="plan-tagline">{{ __('messages.three_months_tagline') }}</div>
                <div class="plan-price-row">
                    <span class="price-currency">$</span>
                    <span class="price-amount">149</span>
                    <span class="price-period">{{ __('messages.per_3_months') }}</span>
                </div>
                <span class="price-savings">{{ __('messages.save_16_percent') }}</span>
                <hr class="plan-divider">
                <ul class="features-list">
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_3_everything') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_3_checkin') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_3_personalized') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_3_booking') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_3_workshops') }}</li>
                </ul>
                <a href="#" class="btn-plan">{{ __('messages.choose_plan_btn') }}</a>
            </div>

            <div class="plan-card">
                <div class="plan-icon">🌟</div>
                <div class="plan-name">{{ __('messages.annual') }}</div>
                <div class="plan-tagline">{{ __('messages.annual_tagline') }}</div>
                <div class="plan-price-row">
                    <span class="price-currency">$</span>
                    <span class="price-amount">499</span>
                    <span class="price-period">{{ __('messages.per_year') }}</span>
                </div>
                <span class="price-savings">{{ __('messages.save_30_percent') }}</span>
                <hr class="plan-divider">
                <ul class="features-list">
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_4_everything') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_4_session') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_4_wellness') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_4_retreat') }}</li>
                    <li><span class="check-icon">✓</span> {{ __('messages.feature_4_friend') }}</li>
                </ul>
                <a href="#" class="btn-plan">{{ __('messages.go_annual') }}</a>
            </div>

        </div>

        <div class="guarantee">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            {{ __('messages.guarantee_money_back') }} &nbsp;·&nbsp; {{ __('messages.guarantee_secure') }} &nbsp;·&nbsp; {{ __('messages.guarantee_no_fees') }}
        </div>
    </section>

    <footer>
        <span>© {{ date('Y') }} PayYoga. {{ __('messages.copyright') }}</span>
        <div class="footer-links">
            <a href="#">{{ __('messages.privacy_policy') }}</a>
            <a href="#">{{ __('messages.terms') }}</a>
            <a href="#">{{ __('messages.contact') }}</a>
        </div>
    </footer>

</body>
</html>
