<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PayYoga - Weekly Schedule</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 3.25rem 1.5rem 4.5rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2.2rem;
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
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: .55rem;
        }

        .subtitle {
            color: var(--text-light);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
            font-size: .98rem;
        }

        .table-wrap {
            background: #fff;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .desktop-table {
            width: 100%;
            border-collapse: collapse;
        }

        .desktop-table thead th {
            background: linear-gradient(135deg, var(--green-dark), var(--green-mid));
            color: #fff;
            text-align: left;
            padding: 1rem 1.1rem;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 600;
        }

        .desktop-table tbody tr {
            transition: background .2s;
        }

        .desktop-table tbody tr:nth-child(2n) {
            background: rgba(235,241,232,.35);
        }

        .desktop-table tbody tr:hover {
            background: rgba(192,88,42,.08);
        }

        .desktop-table td {
            border-top: 1px solid var(--border);
            padding: 1rem 1.1rem;
            font-size: .93rem;
            vertical-align: top;
            color: var(--text-mid);
        }

        .day {
            font-weight: 600;
            color: var(--green-dark);
            width: 16%;
            white-space: nowrap;
        }

        .slot {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            background: var(--green-light);
            color: var(--green-dark);
            font-size: .77rem;
            font-weight: 600;
            border-radius: 999px;
            padding: .25rem .65rem;
            margin-bottom: .5rem;
        }

        .class-title {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: .2rem;
        }

        .class-level {
            font-size: .8rem;
            color: var(--text-light);
        }

        .mobile-cards {
            display: none;
            padding: 1rem;
            gap: .9rem;
        }

        .day-card {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: .95rem;
            background: #fff;
            box-shadow: var(--shadow-sm);
        }

        .day-name {
            font-family: 'Playfair Display', serif;
            color: var(--green-dark);
            font-size: 1.2rem;
            margin-bottom: .55rem;
        }

        .day-card + .day-card {
            margin-top: .8rem;
        }

        .legend {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: .8rem;
            color: var(--text-light);
            font-size: .78rem;
            flex-wrap: wrap;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot.focus { background: var(--terra); }
        .dot.studio { background: var(--green-mid); }
        .dot.restore { background: var(--gold); }

        footer {
            border-top: 1px solid rgba(42,74,46,.09);
            margin-top: 3.5rem;
            padding: 1.6rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
            font-size: .8rem;
            flex-wrap: wrap;
            gap: .5rem;
        }

        @media (max-width: 920px) {
            .desktop-table { display: none; }
            .mobile-cards { display: block; }
            nav { padding: 0 1.2rem; }
            .nav-links { display: none; }
            .page { padding: 2.2rem 1rem 3.5rem; }
            footer { justify-content: center; text-align: center; }
        }
    </style>
</head>
<body>
    <nav>
        <a class="nav-logo" href="{{ url('/') }}">Pay<span>Yoga</span></a>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">{{ __('messages.our_plans') }}</a></li>
            <li><a class="active" href="{{ route('schedule') }}">{{ __('messages.nav_plans') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('messages.nav_about') }}</a></li>
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
        <header class="page-header">
            <span class="eyebrow">{{ __('messages.schedule_timetable') }}</span>
            <h1>{{ __('messages.schedule_title') }}</h1>
            <p class="subtitle">{{ __('messages.schedule_subtitle') }}</p>
        </header>

        <section class="table-wrap" aria-label="Yoga class schedule Monday to Friday">
            <table class="desktop-table">
                <thead>
                    <tr>
                        <th>{{ __('messages.table_day') }}</th>
                        <th>{{ __('messages.table_morning') }}</th>
                        <th>{{ __('messages.table_evening') }}</th>
                        <th>{{ __('messages.table_focus') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="day">{{ __('messages.day_monday') }}</td>
                        <td>
                            <div class="slot"><span class="dot studio"></span> 07:00 - 08:00</div>
                            <div class="class-title">{{ __('messages.class_sunrise_flow') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>
                            <div class="slot"><span class="dot focus"></span> 18:30 - 19:30</div>
                            <div class="class-title">{{ __('messages.class_core_balance') }}</div>
                            <div class="class-level">{{ __('messages.level_intermediate') }}</div>
                        </td>
                        <td>{{ __('messages.focus_strength_alignment') }}</td>
                    </tr>
                    <tr>
                        <td class="day">{{ __('messages.day_tuesday') }}</td>
                        <td>
                            <div class="slot"><span class="dot studio"></span> 07:30 - 08:15</div>
                            <div class="class-title">{{ __('messages.class_breath_mobility') }}</div>
                            <div class="class-level">{{ __('messages.level_beginner_friendly') }}</div>
                        </td>
                        <td>
                            <div class="slot"><span class="dot restore"></span> 19:00 - 20:00</div>
                            <div class="class-title">{{ __('messages.class_vinyasa_energy') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>{{ __('messages.focus_mobility_endurance') }}</td>
                    </tr>
                    <tr>
                        <td class="day">{{ __('messages.day_wednesday') }}</td>
                        <td>
                            <div class="slot"><span class="dot restore"></span> 07:00 - 08:00</div>
                            <div class="class-title">{{ __('messages.class_power_flow') }}</div>
                            <div class="class-level">{{ __('messages.level_intermediate') }}</div>
                        </td>
                        <td>
                            <div class="slot"><span class="dot focus"></span> 18:00 - 19:00</div>
                            <div class="class-title">{{ __('messages.class_deep_stretch') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>{{ __('messages.focus_cardio_recovery') }}</td>
                    </tr>
                    <tr>
                        <td class="day">{{ __('messages.day_thursday') }}</td>
                        <td>
                            <div class="slot"><span class="dot studio"></span> 07:30 - 08:30</div>
                            <div class="class-title">{{ __('messages.class_posture_lab') }}</div>
                            <div class="class-level">{{ __('messages.level_beginner_intermediate') }}</div>
                        </td>
                        <td>
                            <div class="slot"><span class="dot restore"></span> 19:00 - 20:00</div>
                            <div class="class-title">{{ __('messages.class_flow_meditation') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>{{ __('messages.focus_technique_mindfulness') }}</td>
                    </tr>
                    <tr>
                        <td class="day">{{ __('messages.day_friday') }}</td>
                        <td>
                            <div class="slot"><span class="dot focus"></span> 08:00 - 08:45</div>
                            <div class="class-title">{{ __('messages.class_gentle_morning') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>
                            <div class="slot"><span class="dot studio"></span> 18:30 - 19:30</div>
                            <div class="class-title">{{ __('messages.class_weekend_reset') }}</div>
                            <div class="class-level">{{ __('messages.level_all') }}</div>
                        </td>
                        <td>Relax + Restore</td>
                    </tr>
                </tbody>
            </table>

            <div class="mobile-cards" aria-hidden="true">
                <article class="day-card">
                    <div class="day-name">Monday</div>
                    <div class="slot"><span class="dot studio"></span> 07:00 - 08:00</div>
                    <div class="class-title">Sunrise Flow</div>
                    <div class="class-level">Evening: 18:30 - 19:30, Core &amp; Balance</div>
                </article>
                <article class="day-card">
                    <div class="day-name">Tuesday</div>
                    <div class="slot"><span class="dot studio"></span> 07:30 - 08:15</div>
                    <div class="class-title">Breath &amp; Mobility</div>
                    <div class="class-level">Evening: 19:00 - 20:00, Vinyasa Energy</div>
                </article>
                <article class="day-card">
                    <div class="day-name">Wednesday</div>
                    <div class="slot"><span class="dot restore"></span> 07:00 - 08:00</div>
                    <div class="class-title">Power Flow</div>
                    <div class="class-level">Evening: 18:00 - 19:00, Deep Stretch Reset</div>
                </article>
                <article class="day-card">
                    <div class="day-name">Thursday</div>
                    <div class="slot"><span class="dot studio"></span> 07:30 - 08:30</div>
                    <div class="class-title">Posture Lab</div>
                    <div class="class-level">Evening: 19:00 - 20:00, Flow &amp; Meditation</div>
                </article>
                <article class="day-card">
                    <div class="day-name">Friday</div>
                    <div class="slot"><span class="dot focus"></span> 08:00 - 08:45</div>
                    <div class="class-title">Gentle Morning Flow</div>
                    <div class="class-level">Evening: 18:30 - 19:30, Weekend Reset Yin</div>
                </article>
            </div>
        </section>

        <div class="legend">
            <span><span class="dot studio"></span> Studio Flow</span>
            <span><span class="dot focus"></span> Studio Strength</span>
            <span><span class="dot restore"></span> Studio Restore</span>
        </div>
    </main>

    <footer>
        <span>&copy; {{ date('Y') }} PayYoga. {{ __('messages.copyright') }}</span>
        <span>{{ __('messages.footer_weekday_only') }}</span>
    </footer>
</body>
</html>
