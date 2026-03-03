<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'LuxeStay — Extraordinary Places to Stay') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
      :root {
        --cream: #FAF7F2;
        --warm-white: #FFFDF9;
        --charcoal: #1C1C1E;
        --stone: #6B6560;
        --sand: #C9B99A;
        --gold: #B8976A;
        --gold-light: #D4B896;
        --terracotta: #C4714A;
        --sage: #7A8C6E;
        --deep: #0F0E0C;
        --border: rgba(184,151,106,0.2);
        --shadow: 0 8px 40px rgba(28,28,30,0.12);
        --shadow-lg: 0 24px 80px rgba(28,28,30,0.18);
      }

      * { margin: 0; padding: 0; box-sizing: border-box; }
      html { scroll-behavior: smooth; }
      body {
        font-family: 'DM Sans', sans-serif;
        background: var(--cream);
        color: var(--charcoal);
        overflow-x: hidden;
      }

      nav {
        position: fixed; top: 0; left: 0; right: 0; z-index: 100;
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 48px;
        background: rgba(250,247,242,0.88);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid var(--border);
        transition: padding 0.3s;
      }
      .nav-logo {
        font-family: 'Cormorant Garamond', serif;
        font-size: 26px; font-weight: 500; letter-spacing: 0.04em;
        color: var(--charcoal);
        text-decoration: none;
      }
      .nav-logo span { color: var(--gold); font-style: italic; }
      .nav-links {
        display: flex; gap: 36px; list-style: none;
      }
      .nav-links a {
        font-size: 14px; font-weight: 400; color: var(--stone);
        text-decoration: none; letter-spacing: 0.02em;
        transition: color 0.2s;
      }
      .nav-links a:hover { color: var(--charcoal); }
      .nav-actions { display: flex; gap: 12px; align-items: center; }
      .btn-ghost {
        padding: 9px 20px; border: 1px solid var(--border); border-radius: 100px;
        background: transparent; font-family: 'DM Sans', sans-serif;
        font-size: 14px; color: var(--charcoal); cursor: pointer;
        transition: all 0.2s; letter-spacing: 0.02em;
      }
      .btn-ghost:hover { background: var(--charcoal); color: var(--cream); border-color: var(--charcoal); }
      .btn-primary {
        padding: 9px 20px; border: none; border-radius: 100px;
        background: var(--gold); font-family: 'DM Sans', sans-serif;
        font-size: 14px; color: white; cursor: pointer;
        transition: all 0.2s; letter-spacing: 0.02em;
      }
      .btn-primary:hover { background: var(--charcoal); transform: translateY(-1px); }

      .hero {
        min-height: 100vh;
        background: linear-gradient(165deg, #1a1714 0%, #2d2520 40%, #3d3128 70%, #261e18 100%);
        position: relative; overflow: hidden;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 120px 48px 80px;
      }
      .hero-bg-text {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(120px, 20vw, 280px);
        font-weight: 300; color: rgba(184,151,106,0.06);
        white-space: nowrap; pointer-events: none; letter-spacing: -0.02em;
        user-select: none;
      }
      .hero-content { position: relative; z-index: 2; text-align: center; max-width: 860px; }
      .hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 16px; border: 1px solid rgba(184,151,106,0.4);
        border-radius: 100px; color: var(--gold-light);
        font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase;
        margin-bottom: 28px;
        animation: fadeInDown 0.8s ease both;
      }
      .hero-badge::before { content: '✦'; font-size: 10px; }
      .hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(52px, 8vw, 96px);
        font-weight: 300; line-height: 1.0;
        color: var(--warm-white); letter-spacing: -0.01em;
        animation: fadeInUp 0.9s ease 0.1s both;
      }
      .hero h1 em { font-style: italic; color: var(--gold-light); }
      .hero-sub {
        margin-top: 20px; font-size: 17px; color: rgba(250,247,242,0.55);
        font-weight: 300; line-height: 1.6; letter-spacing: 0.01em;
        animation: fadeInUp 0.9s ease 0.2s both;
      }

      .search-box {
        margin-top: 48px; width: 100%; max-width: 860px;
        background: rgba(250,247,242,0.97);
        border-radius: 20px; padding: 8px;
        box-shadow: 0 32px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(184,151,106,0.2);
        animation: fadeInUp 0.9s ease 0.3s both;
      }
      .search-inner {
        display: flex; align-items: stretch; gap: 0;
      }
      .search-field {
        flex: 1; padding: 16px 20px;
        border-right: 1px solid var(--border);
        cursor: pointer; border-radius: 12px;
        transition: background 0.2s;
      }
      .search-field:hover { background: rgba(184,151,106,0.06); }
      .search-field:last-of-type { border-right: none; }
      .search-field label {
        display: block; font-size: 10px; font-weight: 500;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--stone); margin-bottom: 4px;
      }
      .search-field input, .search-field select {
        width: 100%; border: none; background: transparent;
        font-family: 'DM Sans', sans-serif; font-size: 15px;
        font-weight: 400; color: var(--charcoal);
        outline: none; cursor: pointer;
        appearance: none; -webkit-appearance: none;
      }
      .search-field input::placeholder { color: var(--stone); }
      .search-btn {
        margin: 4px; padding: 0 28px;
        background: var(--gold); border: none; border-radius: 12px;
        cursor: pointer; display: flex; align-items: center; gap: 10px;
        font-family: 'DM Sans', sans-serif; font-size: 15px;
        font-weight: 500; color: white; white-space: nowrap;
        transition: all 0.25s; min-width: 130px; justify-content: center;
      }
      .search-btn:hover { background: var(--charcoal); transform: scale(1.02); }
      .search-btn svg { width: 18px; height: 18px; }

      .hero-stats {
        margin-top: 36px; display: flex; gap: 40px;
        animation: fadeInUp 0.9s ease 0.4s both;
      }
      .stat { text-align: center; }
      .stat-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; font-weight: 500; color: var(--gold-light);
      }
      .stat-label { font-size: 12px; color: rgba(250,247,242,0.45); letter-spacing: 0.05em; margin-top: 2px; }

      .section { padding: 80px 48px; }
      .section-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 40px; }
      .section-label {
        font-size: 11px; letter-spacing: 0.14em; text-transform: uppercase;
        color: var(--gold); font-weight: 500; margin-bottom: 10px;
      }
      .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(32px, 4vw, 48px); font-weight: 400;
        line-height: 1.1; color: var(--charcoal);
      }
      .section-title em { font-style: italic; color: var(--stone); }
      .see-all {
        font-size: 14px; color: var(--gold); text-decoration: none;
        display: flex; align-items: center; gap: 6px; font-weight: 500;
        transition: gap 0.2s;
      }
      .see-all:hover { gap: 10px; }

      .categories-grid {
        display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px;
      }
      .cat-card {
        position: relative; border-radius: 16px; overflow: hidden;
        aspect-ratio: 3/4; cursor: pointer;
        transition: transform 0.35s cubic-bezier(0.22,0.61,0.36,1);
      }
      .cat-card:hover { transform: translateY(-6px); }
      .cat-card:hover .cat-overlay { background: linear-gradient(to top, rgba(15,14,12,0.85) 0%, rgba(15,14,12,0.1) 60%); }
      .cat-img {
        width: 100%; height: 100%; object-fit: cover;
        background-size: cover; background-position: center;
        transition: transform 0.6s ease;
      }
      .cat-card:hover .cat-img { transform: scale(1.06); }
      .cat-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(15,14,12,0.75) 0%, rgba(15,14,12,0.05) 55%);
        transition: background 0.35s;
      }
      .cat-info {
        position: absolute; bottom: 0; left: 0; right: 0; padding: 20px;
      }
      .cat-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; font-weight: 500; color: white; line-height: 1.2;
      }
      .cat-count { font-size: 12px; color: rgba(255,255,255,0.6); margin-top: 3px; }

      .rooms-section { background: var(--warm-white); padding: 80px 48px; }
      .filter-row {
        display: flex; gap: 10px; margin-bottom: 36px; flex-wrap: wrap;
      }
      .filter-pill {
        padding: 8px 20px; border-radius: 100px;
        border: 1px solid var(--border); background: transparent;
        font-family: 'DM Sans', sans-serif; font-size: 14px;
        color: var(--stone); cursor: pointer; transition: all 0.2s;
      }
      .filter-pill.active, .filter-pill:hover {
        background: var(--charcoal); color: white; border-color: var(--charcoal);
      }

      .rooms-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;
      }
      .room-card {
        background: white; border-radius: 20px; overflow: hidden;
        box-shadow: 0 2px 20px rgba(28,28,30,0.06);
        transition: all 0.35s cubic-bezier(0.22,0.61,0.36,1);
        cursor: pointer;
      }
      .room-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
      }
      .room-card:hover .room-img { transform: scale(1.05); }
      .room-img-wrap {
        position: relative; overflow: hidden; aspect-ratio: 4/3;
      }
      .room-img {
        width: 100%; height: 100%;
        background-size: cover; background-position: center;
        transition: transform 0.6s ease;
      }
      .room-badge {
        position: absolute; top: 14px; left: 14px;
        padding: 5px 12px; border-radius: 100px;
        font-size: 11px; font-weight: 500; letter-spacing: 0.04em;
        backdrop-filter: blur(12px);
      }
      .badge-luxury { background: rgba(184,151,106,0.9); color: white; }
      .badge-suite { background: rgba(28,28,30,0.85); color: white; }
      .badge-new { background: rgba(122,140,110,0.9); color: white; }
      .room-wish {
        position: absolute; top: 14px; right: 14px;
        width: 34px; height: 34px; border-radius: 50%;
        background: rgba(255,255,255,0.9); backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s; border: none;
        font-size: 16px;
      }
      .room-wish:hover { background: white; transform: scale(1.1); }
      .room-body { padding: 20px; }
      .room-loc {
        font-size: 12px; color: var(--stone); letter-spacing: 0.03em;
        display: flex; align-items: center; gap: 4px; margin-bottom: 8px;
      }
      .room-loc::before { content: '◎'; font-size: 10px; color: var(--gold); }
      .room-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px; font-weight: 500; color: var(--charcoal);
        line-height: 1.2; margin-bottom: 10px;
      }
      .room-amenities {
        display: flex; gap: 14px; margin-bottom: 14px;
      }
      .amenity {
        font-size: 12px; color: var(--stone);
        display: flex; align-items: center; gap: 4px;
      }
      .amenity-icon { font-size: 14px; }
      .room-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 14px; border-top: 1px solid var(--border);
      }
      .room-rating {
        display: flex; align-items: center; gap: 5px;
        font-size: 13px; font-weight: 500; color: var(--charcoal);
      }
      .star { color: var(--gold); font-size: 13px; }
      .rating-count { color: var(--stone); font-weight: 400; }
      .room-price { text-align: right; }
      .price-val {
        font-family: 'Cormorant Garamond', serif;
        font-size: 24px; font-weight: 500; color: var(--charcoal);
      }
      .price-night { font-size: 12px; color: var(--stone); }

      .modal-overlay {
        position: fixed; inset: 0; z-index: 200;
        background: rgba(15,14,12,0.7); backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        padding: 20px; opacity: 0; pointer-events: none;
        transition: opacity 0.3s;
      }
      .modal-overlay.active { opacity: 1; pointer-events: all; }
      .modal {
        background: var(--warm-white); border-radius: 24px;
        width: 100%; max-width: 920px; max-height: 90vh; overflow-y: auto;
        transform: translateY(30px) scale(0.97);
        transition: transform 0.35s cubic-bezier(0.22,0.61,0.36,1);
        box-shadow: var(--shadow-lg);
      }
      .modal-overlay.active .modal { transform: translateY(0) scale(1); }
      .modal-imgs {
        display: grid; grid-template-columns: 2fr 1fr; gap: 4px; height: 340px;
      }
      .modal-img-main {
        background-size: cover; background-position: center;
        border-radius: 24px 0 0 0;
      }
      .modal-img-grid { display: grid; grid-template-rows: 1fr 1fr; gap: 4px; }
      .modal-img-sm {
        background-size: cover; background-position: center;
      }
      .modal-img-sm:first-child { border-radius: 0 24px 0 0; }
      .modal-body { padding: 36px; }
      .modal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
      .modal-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px; font-weight: 400; color: var(--charcoal); line-height: 1.1;
      }
      .modal-loc { font-size: 14px; color: var(--stone); margin-top: 6px; display: flex; align-items: center; gap: 5px; }
      .modal-price-box { text-align: right; }
      .modal-price { font-family: 'Cormorant Garamond', serif; font-size: 38px; font-weight: 400; color: var(--charcoal); }
      .modal-price-label { font-size: 13px; color: var(--stone); }
      .modal-divider { height: 1px; background: var(--border); margin: 24px 0; }
      .modal-desc { font-size: 15px; color: var(--stone); line-height: 1.75; margin-bottom: 28px; }
      .features-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
      .feature-item {
        display: flex; flex-direction: column; align-items: center;
        padding: 18px 12px; border: 1px solid var(--border);
        border-radius: 14px; text-align: center; gap: 8px;
        background: var(--cream);
      }
      .feature-icon { font-size: 22px; }
      .feature-name { font-size: 12px; color: var(--stone); font-weight: 500; }
      .modal-actions { display: flex; gap: 12px; justify-content: flex-end; }
      .btn-close-modal {
        padding: 14px 28px; border: 1px solid var(--border);
        border-radius: 12px; background: transparent; cursor: pointer;
        font-family: 'DM Sans', sans-serif; font-size: 15px; color: var(--stone);
        transition: all 0.2s;
      }
      .btn-close-modal:hover { border-color: var(--charcoal); color: var(--charcoal); }
      .btn-book-now {
        padding: 14px 36px; border: none; border-radius: 12px;
        background: var(--charcoal); cursor: pointer;
        font-family: 'DM Sans', sans-serif; font-size: 15px;
        font-weight: 500; color: white; transition: all 0.25s;
      }
      .btn-book-now:hover { background: var(--gold); transform: translateY(-2px); }
      .modal-close-btn {
        position: absolute; top: 20px; right: 20px;
        width: 38px; height: 38px; border-radius: 50%;
        background: white; border: none; cursor: pointer;
        font-size: 18px; display: flex; align-items: center; justify-content: center;
        box-shadow: var(--shadow); z-index: 10; transition: all 0.2s;
      }
      .modal-close-btn:hover { background: var(--charcoal); color: white; }
      .modal-wrapper { position: relative; }

      .login-overlay {
        position: fixed; inset: 0; z-index: 300;
        background: rgba(15,14,12,0.8); backdrop-filter: blur(12px);
        display: flex; align-items: center; justify-content: center;
        padding: 20px; opacity: 0; pointer-events: none;
        transition: opacity 0.3s;
      }
      .login-overlay.active { opacity: 1; pointer-events: all; }
      .login-modal {
        background: var(--warm-white); border-radius: 28px;
        width: 100%; max-width: 460px; padding: 48px;
        transform: translateY(30px) scale(0.97);
        transition: transform 0.35s cubic-bezier(0.22,0.61,0.36,1);
        box-shadow: var(--shadow-lg); position: relative;
      }
      .login-overlay.active .login-modal { transform: translateY(0) scale(1); }
      .login-logo {
        text-align: center; margin-bottom: 8px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px; font-weight: 400; color: var(--charcoal);
      }
      .login-logo span { color: var(--gold); font-style: italic; }
      .login-sub { text-align: center; font-size: 14px; color: var(--stone); margin-bottom: 36px; }
      .form-group { margin-bottom: 20px; }
      .form-group label {
        display: block; font-size: 12px; font-weight: 500;
        letter-spacing: 0.08em; text-transform: uppercase;
        color: var(--stone); margin-bottom: 8px;
      }
      .form-group input {
        width: 100%; padding: 14px 18px;
        border: 1px solid var(--border); border-radius: 12px;
        background: var(--cream); font-family: 'DM Sans', sans-serif;
        font-size: 15px; color: var(--charcoal); outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
      }
      .form-group input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(184,151,106,0.12);
      }
      .form-group input::placeholder { color: rgba(107,101,96,0.5); }
      .login-btn {
        width: 100%; padding: 16px; border: none; border-radius: 14px;
        background: var(--charcoal); color: white;
        font-family: 'DM Sans', sans-serif; font-size: 16px;
        font-weight: 500; cursor: pointer; transition: all 0.25s;
        margin-top: 8px;
      }
      .login-btn:hover { background: var(--gold); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(184,151,106,0.3); }
      .login-divider { text-align: center; font-size: 13px; color: var(--stone); margin: 20px 0; }
      .login-note { text-align: center; font-size: 13px; color: var(--stone); margin-top: 20px; }
      .login-note a { color: var(--gold); text-decoration: none; }

      .toast {
        position: fixed; bottom: 32px; right: 32px; z-index: 400;
        background: var(--charcoal); color: white;
        padding: 16px 24px; border-radius: 14px;
        font-size: 14px; font-weight: 500;
        display: flex; align-items: center; gap: 10px;
        box-shadow: var(--shadow-lg);
        transform: translateY(80px); opacity: 0;
        transition: all 0.35s cubic-bezier(0.22,0.61,0.36,1);
      }
      .toast.show { transform: translateY(0); opacity: 1; }
      .toast-icon { font-size: 18px; }

      .xp-strip {
        background: var(--charcoal); padding: 64px 48px;
        display: flex; gap: 0; overflow: hidden;
      }
      .xp-item {
        flex: 1; padding: 0 40px; text-align: center;
        border-right: 1px solid rgba(184,151,106,0.15);
      }
      .xp-item:last-child { border-right: none; }
      .xp-icon { font-size: 32px; margin-bottom: 14px; }
      .xp-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px; color: var(--gold-light); margin-bottom: 8px;
      }
      .xp-desc { font-size: 13px; color: rgba(250,247,242,0.45); line-height: 1.6; }

      .testimonials { padding: 80px 48px; background: var(--cream); }
      .testimonials-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 48px; }
      .testimonial-card {
        background: white; border-radius: 20px; padding: 32px;
        box-shadow: 0 2px 16px rgba(28,28,30,0.05);
      }
      .testimonial-stars { color: var(--gold); font-size: 14px; letter-spacing: 2px; margin-bottom: 16px; }
      .testimonial-text { font-size: 15px; color: var(--stone); line-height: 1.7; font-style: italic; margin-bottom: 24px; }
      .testimonial-author { display: flex; align-items: center; gap: 12px; }
      .author-avatar {
        width: 44px; height: 44px; border-radius: 50%;
        background-size: cover; background-position: center;
        background-color: var(--sand);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Cormorant Garamond', serif; font-size: 18px; color: white;
      }
      .author-name { font-size: 14px; font-weight: 500; color: var(--charcoal); }
      .author-loc { font-size: 12px; color: var(--stone); }

      footer {
        background: var(--deep); padding: 64px 48px 32px;
      }
      .footer-top {
        display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px;
        padding-bottom: 48px; border-bottom: 1px solid rgba(184,151,106,0.1);
      }
      .footer-brand {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px; color: var(--warm-white); font-weight: 400;
        margin-bottom: 16px;
      }
      .footer-brand span { color: var(--gold); font-style: italic; }
      .footer-desc { font-size: 13px; color: rgba(250,247,242,0.4); line-height: 1.7; }
      .footer-col h4 {
        font-size: 11px; letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--gold); margin-bottom: 20px; font-weight: 500;
      }
      .footer-col ul { list-style: none; }
      .footer-col li { margin-bottom: 10px; }
      .footer-col a { font-size: 13px; color: rgba(250,247,242,0.45); text-decoration: none; transition: color 0.2s; }
      .footer-col a:hover { color: var(--gold-light); }
      .footer-bottom {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 28px; font-size: 12px; color: rgba(250,247,242,0.25);
      }

      @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
      }
      @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
      }

      .reveal {
        opacity: 0; transform: translateY(32px);
        transition: opacity 0.7s ease, transform 0.7s ease;
      }
      .reveal.visible { opacity: 1; transform: translateY(0); }
      .reveal-delay-1 { transition-delay: 0.1s; }
      .reveal-delay-2 { transition-delay: 0.2s; }
      .reveal-delay-3 { transition-delay: 0.3s; }

      @media (max-width: 1024px) {
        nav { padding: 16px 24px; }
        .nav-links { display: none; }
        .section, .rooms-section, .testimonials, .xp-strip { padding: 60px 24px; }
        .hero { padding: 100px 24px 64px; }
        .categories-grid { grid-template-columns: repeat(3, 1fr); }
        .rooms-grid { grid-template-columns: repeat(2, 1fr); }
        .footer-top { grid-template-columns: 1fr 1fr; gap: 32px; }
      }
      @media (max-width: 768px) {
        .search-inner { flex-direction: column; gap: 4px; }
        .search-field { border-right: none; border-bottom: 1px solid var(--border); }
        .search-field:last-of-type { border-bottom: none; }
        .search-btn { margin: 4px; padding: 16px; width: calc(100% - 8px); }
        .categories-grid { grid-template-columns: repeat(2, 1fr); }
        .rooms-grid { grid-template-columns: 1fr; }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
        .modal-imgs { grid-template-columns: 1fr; height: 220px; }
        .modal-img-grid { display: none; }
        .modal-img-main { border-radius: 24px 24px 0 0; }
        .modal-body { padding: 24px; }
        .modal-header { flex-direction: column; gap: 12px; }
        .testimonials-grid { grid-template-columns: 1fr; }
        .xp-strip { flex-direction: column; gap: 32px; }
        .xp-item { border-right: none; border-bottom: 1px solid rgba(184,151,106,0.1); padding: 0 0 32px; }
        .xp-item:last-child { border-bottom: none; }
        .footer-top { grid-template-columns: 1fr; gap: 28px; }
        .hero-stats { gap: 24px; }
      }
    </style>
</head>
<body>

<!-- NAV -->
<nav id="navbar">
  <a href="#" class="nav-logo">Luxe<span>Stay</span></a>
  <ul class="nav-links">
    <li><a href="#categories">Properties</a></li>
    <li><a href="#rooms">Rooms</a></li>
    <li><a href="#">Experiences</a></li>
    <li><a href="#">About</a></li>
  </ul>
  <div class="nav-actions">
    <button class="btn-ghost" onclick="showLogin()">Sign In</button>
    <button class="btn-primary" onclick="showLogin()">List a Property</button>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg-text">Stay</div>
  <div class="hero-content">
    <div class="hero-badge">Curated Luxury Stays Worldwide</div>
    <h1>Find Your <em>Perfect</em><br>Escape</h1>
    <p class="hero-sub">Handpicked villas, suites & private residences<br>in the world's most breathtaking destinations.</p>

    <!-- SEARCH BOX -->
    <div class="search-box">
      <div class="search-inner">
        <div class="search-field">
          <label>Destination</label>
          <input type="text" placeholder="Where are you going?" id="dest-input">
        </div>
        <div class="search-field">
          <label>Check-in</label>
          <input type="date" id="checkin">
        </div>
        <div class="search-field">
          <label>Check-out</label>
          <input type="date" id="checkout">
        </div>
        <div class="search-field">
          <label>Guests</label>
          <select id="guests">
            <option>1 Adult</option>
            <option>2 Adults</option>
            <option>2 Adults, 1 Child</option>
            <option>2 Adults, 2 Children</option>
            <option>3 Adults</option>
            <option>Family (4+)</option>
            <option>Group (6+)</option>
          </select>
        </div>
        <button class="search-btn" onclick="handleSearch()">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
          </svg>
          Search
        </button>
      </div>
    </div>

    <div class="hero-stats">
      <div class="stat">
        <div class="stat-num">12K+</div>
        <div class="stat-label">Properties</div>
      </div>
      <div class="stat">
        <div class="stat-num">80+</div>
        <div class="stat-label">Countries</div>
      </div>
      <div class="stat">
        <div class="stat-num">4.9★</div>
        <div class="stat-label">Avg Rating</div>
      </div>
      <div class="stat">
        <div class="stat-num">98%</div>
        <div class="stat-label">Happy Guests</div>
      </div>
    </div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="section" id="categories">
  <div class="section-header reveal">
    <div>
      <div class="section-label">Browse by Type</div>
      <h2 class="section-title">Every Kind of <em>Extraordinary</em></h2>
    </div>
    <a href="#rooms" class="see-all">View All →</a>
  </div>
  <div class="categories-grid">
    <div class="cat-card reveal reveal-delay-1" onclick="filterRooms('Villa')">
      <div class="cat-img" style="background-image: url('https://images.unsplash.com/photo-1613977257363-707ba9348227?w=600&q=80');"></div>
      <div class="cat-overlay"></div>
      <div class="cat-info">
        <div class="cat-name">Private Villas</div>
        <div class="cat-count">2,840 properties</div>
      </div>
    </div>
    <div class="cat-card reveal reveal-delay-2" onclick="filterRooms('Suite')">
      <div class="cat-img" style="background-image: url('https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80');"></div>
      <div class="cat-overlay"></div>
      <div class="cat-info">
        <div class="cat-name">Luxury Suites</div>
        <div class="cat-count">3,210 properties</div>
      </div>
    </div>
    <div class="cat-card reveal reveal-delay-3" onclick="filterRooms('Apartment')">
      <div class="cat-img" style="background-image: url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80');"></div>
      <div class="cat-overlay"></div>
      <div class="cat-info">
        <div class="cat-name">City Apartments</div>
        <div class="cat-count">4,560 properties</div>
      </div>
    </div>
    <div class="cat-card reveal reveal-delay-1" onclick="filterRooms('Resort')">
      <div class="cat-img" style="background-image: url('https://images.unsplash.com/photo-1561501900-3701fa6a0864?w=600&q=80');"></div>
      <div class="cat-overlay"></div>
      <div class="cat-info">
        <div class="cat-name">Beach Resorts</div>
        <div class="cat-count">1,870 properties</div>
      </div>
    </div>
    <div class="cat-card reveal reveal-delay-2" onclick="filterRooms('Cabin')">
      <div class="cat-img" style="background-image: url('https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=600&q=80');"></div>
      <div class="cat-overlay"></div>
      <div class="cat-info">
        <div class="cat-name">Mountain Cabins</div>
        <div class="cat-count">980 properties</div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURED ROOMS -->
<section class="rooms-section" id="rooms">
  <div class="section-header reveal">
    <div>
      <div class="section-label">Featured Stays</div>
      <h2 class="section-title">Rooms & <em>Retreats</em></h2>
    </div>
    <a href="#" class="see-all">View All →</a>
  </div>

  <div class="filter-row reveal">
    <button class="filter-pill active" onclick="filterRooms('all', this)">All</button>
    <button class="filter-pill" onclick="filterRooms('Villa', this)">Villas</button>
    <button class="filter-pill" onclick="filterRooms('Suite', this)">Suites</button>
    <button class="filter-pill" onclick="filterRooms('Apartment', this)">Apartments</button>
    <button class="filter-pill" onclick="filterRooms('Resort', this)">Resorts</button>
    <button class="filter-pill" onclick="filterRooms('Cabin', this)">Cabins</button>
  </div>

  <div class="rooms-grid" id="rooms-grid">
    <!-- Rendered by JS -->
  </div>
</section>

<!-- EXPERIENCE STRIP -->
<div class="xp-strip">
  <div class="xp-item">
    <div class="xp-icon">🏆</div>
    <div class="xp-name">Vetted Properties</div>
    <div class="xp-desc">Every property personally inspected and verified by our team of hospitality experts.</div>
  </div>
  <div class="xp-item">
    <div class="xp-icon">🔐</div>
    <div class="xp-name">Secure Booking</div>
    <div class="xp-desc">End-to-end encrypted transactions and flexible cancellation policies on all bookings.</div>
  </div>
  <div class="xp-item">
    <div class="xp-icon">🛎</div>
    <div class="xp-name">Concierge Service</div>
    <div class="xp-desc">24/7 dedicated concierge available before, during and after every stay.</div>
  </div>
  <div class="xp-item">
    <div class="xp-icon">🌍</div>
    <div class="xp-name">Global Reach</div>
    <div class="xp-desc">Exceptional stays in 80+ countries across 6 continents — your world awaits.</div>
  </div>
</div>

<!-- TESTIMONIALS -->
<section class="testimonials">
  <div class="section-header reveal">
    <div>
      <div class="section-label">Guest Stories</div>
      <h2 class="section-title">Loved by <em>Travellers</em></h2>
    </div>
  </div>
  <div class="testimonials-grid">
    <div class="testimonial-card reveal">
      <div class="testimonial-stars">★★★★★</div>
      <p class="testimonial-text">"The Santorini villa was nothing short of breathtaking. LuxeStay's attention to detail and the seamless booking process made this our best holiday ever."</p>
      <div class="testimonial-author">
        <div class="author-avatar" style="background: linear-gradient(135deg, #C9B99A, #B8976A);">S</div>
        <div>
          <div class="author-name">Sophie Laurent</div>
          <div class="author-loc">Paris, France</div>
        </div>
      </div>
    </div>
    <div class="testimonial-card reveal reveal-delay-1">
      <div class="testimonial-stars">★★★★★</div>
      <p class="testimonial-text">"Booked the Maldives overwater bungalow for our anniversary. The concierge arranged everything perfectly. Will absolutely be returning guests."</p>
      <div class="testimonial-author">
        <div class="author-avatar" style="background: linear-gradient(135deg, #7A8C6E, #5a6b50);">J</div>
        <div>
          <div class="author-name">James & Priya Chen</div>
          <div class="author-loc">Singapore</div>
        </div>
      </div>
    </div>
    <div class="testimonial-card reveal reveal-delay-2">
      <div class="testimonial-stars">★★★★★</div>
      <p class="testimonial-text">"The mountain cabin in the Swiss Alps exceeded every expectation. Waking up to those views — it changed how I think about travel entirely."</p>
      <div class="testimonial-author">
        <div class="author-avatar" style="background: linear-gradient(135deg, #C4714A, #a05535);">M</div>
        <div>
          <div class="author-name">Marco Bianchi</div>
          <div class="author-loc">Milan, Italy</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div>
      <div class="footer-brand">Luxe<span>Stay</span></div>
      <p class="footer-desc">Curating the world's most extraordinary stays for discerning travellers since 2018. Every booking is a promise of excellence.</p>
    </div>
    <div class="footer-col">
      <h4>Discover</h4>
      <ul>
        <li><a href="#">Villas</a></li>
        <li><a href="#">Suites</a></li>
        <li><a href="#">Apartments</a></li>
        <li><a href="#">Resorts</a></li>
        <li><a href="#">Mountain Cabins</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Press</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Partners</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Support</h4>
      <ul>
        <li><a href="#">Help Centre</a></li>
        <li><a href="#">Cancellations</a></li>
        <li><a href="#">Safety</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Privacy</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2025 LuxeStay. All rights reserved.</span>
    <span>Made with ♥ for extraordinary travellers</span>
  </div>
</footer>

<!-- ROOM DETAIL MODAL -->
<div class="modal-overlay" id="room-modal">
  <div class="modal-wrapper" style="width:100%;max-width:920px;">
    <button class="modal-close-btn" onclick="closeModal()">✕</button>
    <div class="modal" id="modal-inner">
      <div class="modal-imgs" id="modal-imgs"></div>
      <div class="modal-body">
        <div class="modal-header">
          <div>
            <div class="modal-title" id="modal-title"></div>
            <div class="modal-loc" id="modal-loc">📍 <span></span></div>
          </div>
          <div class="modal-price-box">
            <div class="modal-price" id="modal-price"></div>
            <div class="modal-price-label">per night</div>
          </div>
        </div>
        <div class="modal-divider"></div>
        <p class="modal-desc" id="modal-desc"></p>
        <div class="features-grid" id="modal-features"></div>
        <div class="modal-actions">
          <button class="btn-close-modal" onclick="closeModal()">Cancel</button>
          <button class="btn-book-now" onclick="openLogin()">Book This Room</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- LOGIN MODAL -->
<div class="login-overlay" id="login-modal">
  <div class="login-modal">
    <button class="modal-close-btn" style="position:absolute;top:20px;right:20px;" onclick="closeLogin()">✕</button>
    <div class="login-logo">Luxe<span>Stay</span></div>
    <p class="login-sub">Sign in to complete your booking</p>
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" placeholder="John Doe" id="login-name">
    </div>
    <div class="form-group">
      <label>Phone Number</label>
      <input type="tel" placeholder="+1 (555) 000-0000" id="login-phone">
    </div>
    <div class="form-group">
      <label>Email Address</label>
      <input type="email" placeholder="john@example.com" id="login-email">
    </div>
    <button class="login-btn" onclick="handleLogin()">Continue to Booking →</button>
    <div class="login-divider">— or continue with —</div>
    <div style="display:flex;gap:10px;">
      <button onclick="handleLogin()" style="flex:1;padding:12px;border:1px solid var(--border);border-radius:12px;background:white;cursor:pointer;font-size:14px;font-family:'DM Sans',sans-serif;transition:all 0.2s;" onmouseover="this.style.borderColor='#4285f4'" onmouseout="this.style.borderColor='var(--border)'">🌐 Google</button>
      <button onclick="handleLogin()" style="flex:1;padding:12px;border:1px solid var(--border);border-radius:12px;background:white;cursor:pointer;font-size:14px;font-family:'DM Sans',sans-serif;transition:all 0.2s;" onmouseover="this.style.borderColor='#000'" onmouseout="this.style.borderColor='var(--border)'"> Apple</button>
    </div>
    <p class="login-note">By continuing you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a></p>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <span class="toast-icon">✅</span>
  <span id="toast-msg">Booking confirmed! Check your email.</span>
</div>

<script>
const rooms = [
  {
    id: 1, type: 'Villa',
    name: 'Aegean Clifftop Villa',
    location: 'Santorini, Greece',
    price: '$980',
    rating: 4.98, reviews: 214,
    badge: 'Luxury', badgeClass: 'badge-luxury',
    img: 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=400&q=80',
    desc: 'Perched on the caldera cliffs of Santorini, this private villa offers uninterrupted views of the Aegean Sea and the iconic blue-domed churches. The sunsets here are legendary — golden hour lasts nearly two hours and paints the entire sky in shades of amber, coral and violet.',
    amenities: ['🛏 2 Beds', '🛁 2 Baths', '👥 4 Guests'],
    features: [
      { icon: '🏊', name: 'Infinity Pool' },
      { icon: '🍳', name: 'Full Kitchen' },
      { icon: '🌅', name: 'Sea View' },
      { icon: '🚗', name: 'Free Parking' },
      { icon: '📶', name: 'Fast WiFi' },
      { icon: '❄️', name: 'Air Con' },
      { icon: '🏋', name: 'Gym Access' },
      { icon: '🍾', name: 'Welcome Kit' }
    ]
  },
  {
    id: 2, type: 'Suite',
    name: 'Royal Penthouse Suite',
    location: 'Paris, France',
    price: '$1,240',
    rating: 4.96, reviews: 189,
    badge: 'Suite', badgeClass: 'badge-suite',
    img: 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&q=80',
    desc: 'On the top floor of a historic Haussmann building in the 8th arrondissement, this penthouse suite offers panoramic views of the Eiffel Tower. Blending classical French architecture with contemporary luxury, every detail has been thoughtfully curated.',
    amenities: ['🛏 3 Beds', '🛁 3 Baths', '👥 6 Guests'],
    features: [
      { icon: '🗼', name: 'Tower View' },
      { icon: '🛁', name: 'Marble Bath' },
      { icon: '🍽', name: 'Private Chef' },
      { icon: '🍾', name: 'Bar & Lounge' },
      { icon: '📶', name: 'Fast WiFi' },
      { icon: '🎭', name: 'Concierge' },
      { icon: '🚁', name: 'Helipad' },
      { icon: '🌸', name: 'Terrace' }
    ]
  },
  {
    id: 3, type: 'Apartment',
    name: 'Designer Loft SoHo',
    location: 'New York, USA',
    price: '$420',
    rating: 4.91, reviews: 342,
    badge: 'New', badgeClass: 'badge-new',
    img: 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400&q=80',
    desc: 'A stunning industrial-chic loft in the heart of SoHo, steps from world-class galleries, restaurants and boutiques. Featuring exposed brick walls, soaring ceilings and floor-to-ceiling windows, this space was designed by award-winning interior studio Form+Function.',
    amenities: ['🛏 1 Bed', '🛁 1 Bath', '👥 2 Guests'],
    features: [
      { icon: '🏙', name: 'City View' },
      { icon: '🎨', name: 'Art Studio' },
      { icon: '🍳', name: 'Full Kitchen' },
      { icon: '🏋', name: 'Gym Access' },
      { icon: '📶', name: 'Gig WiFi' },
      { icon: '🚿', name: 'Rain Shower' },
      { icon: '🔑', name: 'Smart Lock' },
      { icon: '🐾', name: 'Pet Friendly' }
    ]
  },
  {
    id: 4, type: 'Resort',
    name: 'Overwater Bungalow',
    location: 'Baa Atoll, Maldives',
    price: '$1,890',
    rating: 5.0, reviews: 98,
    badge: 'Luxury', badgeClass: 'badge-luxury',
    img: 'https://images.unsplash.com/photo-1561501900-3701fa6a0864?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&q=80',
    desc: 'Float above crystal-clear turquoise lagoon waters in this private overwater bungalow. With direct ocean access, a glass-floor sitting area, and your own sundeck, you are entirely surrounded by the Indian Ocean\'s natural splendour.',
    amenities: ['🛏 1 King', '🛁 2 Baths', '👥 2 Guests'],
    features: [
      { icon: '🐠', name: 'Snorkel Direct' },
      { icon: '🌊', name: 'Ocean Below' },
      { icon: '🛁', name: 'Outdoor Bath' },
      { icon: '🍹', name: 'Butler Service' },
      { icon: '🤿', name: 'Dive Centre' },
      { icon: '🚤', name: 'Island Hopping' },
      { icon: '🌅', name: 'Sunrise View' },
      { icon: '🍽', name: 'In-Room Dining' }
    ]
  },
  {
    id: 5, type: 'Cabin',
    name: 'Alpine Lodge Chalet',
    location: 'Zermatt, Switzerland',
    price: '$740',
    rating: 4.97, reviews: 156,
    badge: 'Suite', badgeClass: 'badge-suite',
    img: 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=400&q=80',
    desc: 'Nestled in the Swiss Alps with direct Matterhorn views, this hand-crafted timber chalet marries rustic warmth with alpine luxury. A wood-burning fireplace, private sauna and slope-side access make this the ultimate winter retreat.',
    amenities: ['🛏 4 Beds', '🛁 3 Baths', '👥 8 Guests'],
    features: [
      { icon: '🏔', name: 'Matterhorn View' },
      { icon: '🔥', name: 'Fireplace' },
      { icon: '🧖', name: 'Private Sauna' },
      { icon: '⛷', name: 'Ski-in/out' },
      { icon: '🍫', name: 'Fondue Kit' },
      { icon: '🌨', name: 'Snow Deck' },
      { icon: '🍷', name: 'Wine Cellar' },
      { icon: '📶', name: 'WiFi' }
    ]
  },
  {
    id: 6, type: 'Villa',
    name: 'Balinese Jungle Villa',
    location: 'Ubud, Bali',
    price: '$380',
    rating: 4.94, reviews: 267,
    badge: 'New', badgeClass: 'badge-new',
    img: 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=700&q=80',
    img2: 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=400&q=80',
    img3: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&q=80',
    desc: 'Secluded within a verdant jungle canopy in Ubud\'s sacred rice terraces, this traditional Balinese villa offers absolute serenity. The sound of gamelan music, tropical birdsong and a private infinity pool overlooking the rainforest awaits.',
    amenities: ['🛏 2 Beds', '🛁 2 Baths', '👥 4 Guests'],
    features: [
      { icon: '🌴', name: 'Jungle View' },
      { icon: '🏊', name: 'Infinity Pool' },
      { icon: '🧘', name: 'Yoga Deck' },
      { icon: '🌺', name: 'Garden Bath' },
      { icon: '🍚', name: 'Rice Terrace' },
      { icon: '🌿', name: 'Eco Design' },
      { icon: '🐦', name: 'Wildlife' },
      { icon: '🛺', name: 'Driver Incl.' }
    ]
  }
];

let currentFilter = 'all';

function renderRooms(filter) {
  const grid = document.getElementById('rooms-grid');
  const filtered = filter === 'all' ? rooms : rooms.filter(r => r.type === filter);
  grid.innerHTML = filtered.map(room => `
    <div class="room-card reveal" onclick="openRoom(${room.id})">
      <div class="room-img-wrap">
        <div class="room-img" style="background-image:url('${room.img}');"></div>
        <span class="room-badge ${room.badgeClass}">${room.badge}</span>
        <button class="room-wish" onclick="event.stopPropagation(); this.textContent=this.textContent==='🤍'?'❤️':'🤍'">🤍</button>
      </div>
      <div class="room-body">
        <div class="room-loc">${room.location}</div>
        <div class="room-name">${room.name}</div>
        <div class="room-amenities">
          ${room.amenities.map(a => `<span class="amenity"><span class="amenity-icon">${a.split(' ')[0]}</span>${a.split(' ').slice(1).join(' ')}</span>`).join('')}
        </div>
        <div class="room-footer">
          <div class="room-rating">
            <span class="star">★</span> ${room.rating}
            <span class="rating-count">(${room.reviews})</span>
          </div>
          <div class="room-price">
            <span class="price-val">${room.price}</span>
            <span class="price-night"> /night</span>
          </div>
        </div>
      </div>
    </div>
  `).join('');
  observeReveal();
}

function filterRooms(type, btn) {
  currentFilter = type;
  if (btn) {
    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
  }
  renderRooms(type);
  document.getElementById('rooms').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function openRoom(id) {
  const room = rooms.find(r => r.id === id);
  if (!room) return;
  document.getElementById('modal-title').textContent = room.name;
  document.getElementById('modal-loc').querySelector('span').textContent = room.location;
  document.getElementById('modal-price').textContent = room.price;
  document.getElementById('modal-desc').textContent = room.desc;
  document.getElementById('modal-imgs').innerHTML = `
    <div class="modal-img-main" style="background-image:url('${room.img}');"></div>
    <div class="modal-img-grid">
      <div class="modal-img-sm" style="background-image:url('${room.img2}');"></div>
      <div class="modal-img-sm" style="background-image:url('${room.img3}');"></div>
    </div>
  `;
  document.getElementById('modal-features').innerHTML = room.features.map(f => `
    <div class="feature-item">
      <span class="feature-icon">${f.icon}</span>
      <span class="feature-name">${f.name}</span>
    </div>
  `).join('');
  document.getElementById('room-modal').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('room-modal').classList.remove('active');
  document.body.style.overflow = '';
}

function openLogin() {
  closeModal();
  setTimeout(() => {
    document.getElementById('login-modal').classList.add('active');
    document.body.style.overflow = 'hidden';
  }, 200);
}

function closeLogin() {
  document.getElementById('login-modal').classList.remove('active');
  document.body.style.overflow = '';
}

function showLogin() {
  document.getElementById('login-modal').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function handleLogin() {
  const name = document.getElementById('login-name').value;
  const phone = document.getElementById('login-phone').value;
  const email = document.getElementById('login-email').value;
  if (!name || !phone || !email) {
    showToast('⚠️ Please fill in all fields to continue.');
    return;
  }
  closeLogin();
  setTimeout(() => showToast(`🎉 Welcome, ${name.split(' ')[0]}! Booking confirmed!`), 400);
}

function handleSearch() {
  const dest = document.getElementById('dest-input').value;
  if (dest) showToast(`🔍 Searching stays in ${dest}…`);
  document.getElementById('rooms').scrollIntoView({ behavior: 'smooth' });
}

function showToast(msg) {
  const t = document.getElementById('toast');
  document.getElementById('toast-msg').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 4000);
}

document.getElementById('room-modal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
document.getElementById('login-modal').addEventListener('click', function(e) {
  if (e.target === this) closeLogin();
});

function observeReveal() {
  const els = document.querySelectorAll('.reveal:not(.visible)');
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } });
  }, { threshold: 0.08 });
  els.forEach(el => obs.observe(el));
}

renderRooms('all');
observeReveal();

const today = new Date();
const tomorrow = new Date(today); tomorrow.setDate(today.getDate() + 1);
const nextWeek = new Date(today); nextWeek.setDate(today.getDate() + 7);
document.getElementById('checkin').valueAsDate = tomorrow;
document.getElementById('checkout').valueAsDate = nextWeek;
</script>
</body>
</html>
