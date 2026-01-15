<!DOCTYPE html>
<html lang="bn">
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>সাইফুল আলম নীরব - ঢাকা ১২ এলাকার প্রার্থী | নির্বাচনী প্রতীক: ফুটবল ⚽ | ১২ ফেব্রুয়ারি ২০২৬</title>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" type="image/jpeg">
  <link href="assets/img/favicon.png" rel="apple-touch-icon" sizes="180x180">
  <link href="assets/img/favicon.png" rel="icon" type="image/jpeg" sizes="32x32">
  <link href="assets/img/favicon.png" rel="icon" type="image/jpeg" sizes="16x16">
  
    <!-- Fonts - Bangla Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100;200;300;400;500;600;700;800;900&family=Hind+Siliguri:wght@300;400;500;600;700&family=Kalpurush&display=swap" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    
    <!-- PDF.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.css">
    
    <style>
        * {
            font-family: 'Noto Sans Bengali', 'Hind Siliguri', 'Kalpurush', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 0px;
            padding-bottom: 20px;
        }
        
        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .header-section {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(22, 163, 74, 0.3);
        }
        
        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .header-section p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin: 0;
        }
        
        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        
        .search-form {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .search-input-group {
            flex: 1;
            min-width: 250px;
        }
        
        .search-input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
            font-size: 1rem;
        }
        
        .search-input-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input-group input:focus {
            outline: none;
            border-color: #16a34a;
            box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.25);
        }
        
        .search-btn {
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-end;
            height: fit-content;
        }
        
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(22, 163, 74, 0.4);
        }
        
        .search-btn:active {
            transform: translateY(0);
        }
        
        .search-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .search-btn:disabled:hover {
            transform: none;
            box-shadow: none;
        }
        
        .search-btn .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
            margin-right: 0.5rem;
        }
        
        .search-btn .btn-text {
            display: inline-block;
        }
        
        .search-btn .btn-spinner {
            display: none;
        }
        
        .search-btn:disabled .btn-text {
            display: none;
        }
        
        .search-btn:disabled .btn-spinner {
            display: inline-block;
        }
        
        .pdf-list-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid #16a34a;
        }
        
        .pdf-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .pdf-card {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .pdf-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #16a34a 0%, #15803d 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .pdf-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #16a34a;
        }
        
        .pdf-card:hover::before {
            transform: scaleX(1);
        }
        
        .pdf-icon {
            font-size: 3rem;
            color: #dc3545;
            margin-bottom: 1rem;
            display: block;
        }
        
        .pdf-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
            word-break: break-word;
        }
        
        .pdf-size {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .loading-spinner {
            text-align: center;
            padding: 3rem;
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.3em;
            color: #16a34a;
        }
        
        .no-pdfs {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
            font-size: 1.1rem;
        }
        
        /* PDF Modal Styles */
        .pdf-modal .modal-dialog {
            max-width: 95%;
            height: 95vh;
        }
        
        .pdf-modal .modal-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .pdf-modal .modal-header {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            border-bottom: none;
            padding: 1.25rem 1.5rem;
        }
        
        .pdf-modal .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .pdf-modal .btn-close {
            filter: invert(1);
            opacity: 0.9;
        }
        
        .pdf-modal .btn-close:hover {
            opacity: 1;
        }
        
        .pdf-modal .modal-body {
            flex: 1;
            padding: 0;
            overflow: hidden;
            position: relative;
        }
        
        #pdfViewer {
            width: 100%;
            height: 100%;
            overflow: auto;
            background: #525252;
        }
        
        .pdf-controls {
            background: #f8f9fa;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .pdf-controls button {
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .pdf-controls button:hover {
            background: #16a34a;
            color: white;
            border-color: #16a34a;
        }
        
        .pdf-controls input {
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            width: 80px;
            text-align: center;
        }
        
        .search-status {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            display: none;
        }
        
        .search-status.success {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        
        .search-status.error {
            background: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        
        .search-status.info {
            background: #cff4fc;
            color: #055160;
            border: 1px solid #b6effb;
        }
        
        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 1.75rem;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .search-btn {
                width: 100%;
            }
            
            .pdf-grid {
                grid-template-columns: 1fr;
            }
            
            .pdf-modal .modal-dialog {
                max-width: 100%;
                height: 100vh;
                margin: 0;
            }
        }
        
        /* Premium Voter Campaign Section */
        .voter-campaign-section {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 50%, #166534 100%);
            padding: 3rem 1rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 40px rgba(22, 163, 74, 0.3);
        }
        
        .campaign-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        .campaign-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 2px, transparent 2px),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.08) 2px, transparent 2px),
                radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.08) 2px, transparent 2px);
            background-size: 100px 100px, 150px 150px, 200px 200px;
            animation: campaignPatternMove 25s linear infinite;
        }
        
        @keyframes campaignPatternMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }
        
        .campaign-gradient {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            animation: campaignPulse 5s ease-in-out infinite;
        }
        
        @keyframes campaignPulse {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.9; transform: scale(1.1); }
        }
        
        .campaign-content {
            position: relative;
            z-index: 2;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .campaign-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .campaign-text {
            flex: 1;
            min-width: 300px;
        }
        
        .campaign-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1rem;
            animation: badgeFloat 3s ease-in-out infinite;
        }
        
        @keyframes badgeFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .campaign-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .campaign-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .campaign-highlight {
            background: linear-gradient(45deg, #fff, #e0f2fe, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: campaignShimmer 3s ease-in-out infinite;
            background-size: 200% 100%;
        }
        
        @keyframes campaignShimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .campaign-features {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }
        
        .campaign-feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .campaign-feature:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .campaign-feature-icon {
            font-size: 1.5rem;
            color: white;
        }
        
        .campaign-feature-text {
            color: white;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .campaign-visual {
            flex: 0 0 auto;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .campaign-football {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
            border-radius: 50%;
            position: relative;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.4),
                inset -20px -20px 40px rgba(0, 0, 0, 0.1),
                inset 20px 20px 40px rgba(255, 255, 255, 0.8);
            animation: campaignFootballRotate 10s linear infinite, campaignFootballFloat 4s ease-in-out infinite;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .campaign-football:hover {
            transform: scale(1.15);
            animation-play-state: paused;
        }
        
        @keyframes campaignFootballRotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes campaignFootballFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }
        
        .campaign-football-glow {
            position: absolute;
            width: 120%;
            height: 120%;
            top: -10%;
            left: -10%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, transparent 70%);
            border-radius: 50%;
            animation: campaignGlowPulse 2.5s ease-in-out infinite;
            pointer-events: none;
        }
        
        @keyframes campaignGlowPulse {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        
        .campaign-football-pattern {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        
        .campaign-pentagon {
            position: absolute;
            width: 0;
            height: 0;
            border: 2px solid #000;
        }
        
        .campaign-pentagon-1 {
            top: 20%;
            left: 40%;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
        }
        
        .campaign-pentagon-2 {
            top: 45%;
            left: 15%;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
            transform: rotate(72deg);
        }
        
        .campaign-pentagon-3 {
            top: 45%;
            right: 15%;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
            transform: rotate(144deg);
        }
        
        .campaign-pentagon-4 {
            bottom: 20%;
            left: 25%;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
            transform: rotate(216deg);
        }
        
        .campaign-pentagon-5 {
            bottom: 20%;
            right: 25%;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
            transform: rotate(288deg);
        }
        
        .campaign-pentagon-6 {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 16px solid #000;
        }
        
        .campaign-cta {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .campaign-btn {
            padding: 1rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            color: #16a34a;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .campaign-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            background: white;
            color: #15803d;
        }
        
        .campaign-btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }
        
        .campaign-btn-outline:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-color: white;
        }
        
        .campaign-floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .campaign-mini-football {
            position: absolute;
            font-size: 1.5rem;
            animation: campaignMiniFloat 8s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
            opacity: 0.7;
        }
        
        .campaign-mini-1 {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .campaign-mini-2 {
            top: 25%;
            right: 12%;
            animation-delay: 2s;
        }
        
        .campaign-mini-3 {
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }
        
        .campaign-mini-4 {
            bottom: 30%;
            right: 8%;
            animation-delay: 6s;
        }
        
        @keyframes campaignMiniFloat {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.5;
            }
            25% {
                transform: translate(15px, -20px) rotate(90deg);
                opacity: 0.8;
            }
            50% {
                transform: translate(-10px, -35px) rotate(180deg);
                opacity: 0.6;
            }
            75% {
                transform: translate(20px, -15px) rotate(270deg);
                opacity: 0.8;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1400px) {
            .voter-campaign-section {
                padding: 1.5rem 1.5rem;
                max-height: 30vh;
                min-height: 30vh;
                overflow: hidden;
            }
            
            .campaign-content {
                height: 100%;
                display: flex;
                align-items: center;
            }
            
            .campaign-row {
                align-items: center;
                gap: 2rem;
            }
            
            .campaign-badge {
                padding: 0.4rem 1.25rem;
                font-size: 0.85rem;
                margin-bottom: 0.75rem;
            }
            
            .campaign-title {
                font-size: 1.5rem;
                margin-bottom: 0.75rem;
                line-height: 1.3;
            }
            
            .campaign-subtitle {
                font-size: 0.95rem;
                margin-bottom: 1rem;
                line-height: 1.5;
            }
            
            .campaign-features {
                gap: 1rem;
                margin-top: 1rem;
            }
            
            .campaign-feature {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .campaign-feature-icon {
                font-size: 1.2rem;
            }
            
            .campaign-cta {
                margin-top: 1rem;
                gap: 0.75rem;
            }
            
            .campaign-btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
            }
            
            .campaign-football {
                width: 100px;
                height: 100px;
            }
            
            .campaign-pentagon-1,
            .campaign-pentagon-2,
            .campaign-pentagon-3,
            .campaign-pentagon-4,
            .campaign-pentagon-5,
            .campaign-pentagon-6 {
                border-left-width: 8px;
                border-right-width: 8px;
                border-bottom-width: 12px;
            }
            
            .campaign-floating-elements {
                opacity: 0.5;
            }
        }
        
        @media (max-width: 992px) {
            .campaign-title {
                font-size: 2rem;
            }
            
            .campaign-subtitle {
                font-size: 1.1rem;
            }
            
            .campaign-football {
                width: 120px;
                height: 120px;
            }
        }
        
        @media (max-width: 768px) {
            .voter-campaign-section {
                padding: 1rem 0.75rem;
                max-height: 30vh;
                min-height: 30vh;
                overflow: hidden;
            }
            
            .header-section h1 {
                font-size: 1.75rem;
            }
            
            .campaign-content {
                height: 100%;
                display: flex;
                align-items: center;
            }
            
            .campaign-row {
                flex-direction: row;
                text-align: left;
                align-items: center;
                gap: 1rem;
                width: 100%;
            }
            
            .campaign-text {
                flex: 1;
                min-width: 0;
            }
            
            .campaign-badge {
                padding: 0.3rem 1rem;
                font-size: 0.75rem;
                margin-bottom: 0.5rem;
            }
            
            .campaign-title {
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }
            
            .campaign-subtitle {
                font-size: 0.85rem;
                margin-bottom: 0.75rem;
                line-height: 1.4;
            }
            
            .campaign-features {
                display: none;
            }
            
            .campaign-cta {
                margin-top: 0.75rem;
                gap: 0.5rem;
                justify-content: flex-start;
            }
            
            .campaign-btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
                width: auto;
                flex: 1;
                min-width: 0;
            }
            
            .campaign-visual {
                flex: 0 0 auto;
            }
            
            .campaign-football {
                width: 70px;
                height: 70px;
            }
            
            .campaign-pentagon-1,
            .campaign-pentagon-2,
            .campaign-pentagon-3,
            .campaign-pentagon-4,
            .campaign-pentagon-5,
            .campaign-pentagon-6 {
                border-left-width: 6px;
                border-right-width: 6px;
                border-bottom-width: 8px;
            }
            
            .campaign-floating-elements {
                display: none;
            }
            
            .campaign-background {
                opacity: 0.7;
            }
        }
        
        @media (max-width: 576px) {
            .voter-campaign-section {
                padding: 0.75rem 0.5rem;
                max-height: 30vh;
                min-height: 30vh;
            }
            
            .campaign-title {
                font-size: 1rem;
            }
            
            .campaign-subtitle {
                font-size: 0.8rem;
            }
            
            .campaign-btn {
                padding: 0.4rem 0.75rem;
                font-size: 0.75rem;
            }
            
            .campaign-football {
                width: 60px;
                height: 60px;
            }
            
            .campaign-row {
                gap: 0.75rem;
            }
        }
        
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
            }
            
            .search-btn {
                width: 100%;
            }
            
            .pdf-grid {
                grid-template-columns: 1fr;
            }
            
            .pdf-modal .modal-dialog {
                max-width: 100%;
                height: 100vh;
                margin: 0;
            }
        }
    </style>

</head>
<body>
    <!-- Premium Voter Campaign Section -->
    <div class="voter-campaign-section">
        <div class="campaign-background">
            <div class="campaign-pattern"></div>
            <div class="campaign-gradient"></div>
        </div>
        
        <div class="campaign-floating-elements">
            <div class="campaign-mini-football campaign-mini-1">⚽</div>
            <div class="campaign-mini-football campaign-mini-2">⚽</div>
            <div class="campaign-mini-football campaign-mini-3">⚽</div>
            <div class="campaign-mini-football campaign-mini-4">⚽</div>
        </div>
        
        <div class="campaign-content">
            <div class="campaign-row">
                <div class="campaign-text">
                    <div class="campaign-badge">
                        <i class="bi bi-star-fill me-2"></i>নির্বাচনী প্রচারণা ২০২৬
                    </div>
                    <h1 class="campaign-title">
                        <span class="campaign-highlight2">⚽ ফুটবল</span> প্রতীকে<br>
                        ভোট দিন, জয়যুক্ত করুন
                    </h1>
                    <p class="campaign-subtitle">
                        <strong translate="no">সাইফুল আলম নীরব</strong> - ঢাকা ১২ এলাকার উন্নয়ন, জনগণের কল্যাণ ও সমৃদ্ধির জন্য আপনার ভোট প্রয়োজন
                    </p>
                    
                    <div class="campaign-features">
                        <div class="campaign-feature">
                            <i class="bi bi-calendar-check campaign-feature-icon"></i>
                            <span class="campaign-feature-text">১২ ফেব্রুয়ারি ২০২৬</span>
                        </div>
                        <div class="campaign-feature">
                            <i class="bi bi-geo-alt campaign-feature-icon"></i>
                            <span class="campaign-feature-text">ঢাকা ১২ এলাকা</span>
                        </div>
                        <div class="campaign-feature">
                            <i class="bi bi-trophy campaign-feature-icon"></i>
                            <span class="campaign-feature-text">⚽ ফুটবল প্রতীক</span>
                        </div>
                    </div>
                    
                    <div class="campaign-cta">
                        <a href="{{url('/')}}" class="campaign-btn">
                            <i class="bi bi-house-door"></i>
                            হোমপেজে যান
                        </a>
                        <a href="{{url('/')}}#about" class="campaign-btn campaign-btn-outline">
                            <i class="bi bi-person-circle"></i>
                            প্রার্থী সম্পর্কে
                        </a>
                    </div>
                </div>
                
                <div class="campaign-visual">
                    <div class="campaign-football" id="campaignFootball">
                        <div class="campaign-football-pattern">
                            <div class="campaign-pentagon campaign-pentagon-1"></div>
                            <div class="campaign-pentagon campaign-pentagon-2"></div>
                            <div class="campaign-pentagon campaign-pentagon-3"></div>
                            <div class="campaign-pentagon campaign-pentagon-4"></div>
                            <div class="campaign-pentagon campaign-pentagon-5"></div>
                            <div class="campaign-pentagon campaign-pentagon-6"></div>
                        </div>
                        <div class="campaign-football-glow"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="main-container pt-2">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="bi bi-search me-2"></i>কেন্দ্র অনুসন্ধান</h1>
            <p>ভোটার নং (NID) দিয়ে PDF-এ আপনার তথ্য খুঁজুন</p>
        </div>
        
        <!-- Search Section -->
        <div class="search-section">
            <form id="nidSearchForm" class="search-form mb-2">
                <div class="search-input-group">
                    <label for="nidInput"><i class="bi bi-card-text me-2"></i>ভোটার নং (NID) লিখুন</label>
                    <input type="text" id="nidInput" name="nid" placeholder="উদাহরণ: ১২৩৪৫৬৭৮৯০১২৩ বা 1234567890123" required>
                </div>
                <button type="submit" class="search-btn" id="searchBtn">
                    <span class="btn-spinner">
                        <span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span>
                    </span>
                    <span class="btn-text">
                        <i class="bi bi-search me-2"></i>অনুসন্ধান করুন
                    </span>
                </button>
            </form>
            <div id="searchStatus" class="search-status"></div>
        </div>
        
        <!-- PDF List Section -->
        <div class="pdf-list-section" style="display: none;">
            <h2 class="section-title">
                <i class="bi bi-file-pdf me-2"></i>সমস্ত PDF ফাইল
            </h2>
            <div id="pdfListContainer">
                <div class="loading-spinner">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">লোড হচ্ছে...</span>
                    </div>
                    <p class="mt-3">PDF ফাইল লোড হচ্ছে...</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- PDF Viewer Modal -->
    <div class="modal fade pdf-modal" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    কেন্দ্র 
                    <h5 class="modal-title" id="pdfViewerModalLabel">
                        <i class="bi bi-file-pdf me-2"></i>PDF Viewer
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pdfViewer"></div>
                </div>

                <div class="pdf-controls">
                    {{-- <button id="prevPage" class="btn btn-sm">
                        <i class="bi bi-chevron-left"></i> পূর্ববর্তী
                    </button> --}}
                    <span>
                        পাতা: <input type="number" id="pageNum" value="1" min="1"> / <span id="pageCount">0</span>
                    </span>
                    {{-- <button id="nextPage" class="btn btn-sm">
                        পরবর্তী <i class="bi bi-chevron-right"></i>
                    </button> --}}
                    <button id="zoomOut" class="btn btn-sm">
                        <i class="bi bi-zoom-out"></i>
                    </button>
                    <span id="zoomLevel">100%</span>
                    <button id="zoomIn" class="btn btn-sm">
                        <i class="bi bi-zoom-in"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- PDF.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    
    <script>
        // Set PDF.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        
        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        // Helper function to escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }
        
        // Convert Bangla digits to English digits
        function banglaToEnglish(text) {
            if (!text) return '';
            const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let result = String(text);
            for (let i = 0; i < banglaDigits.length; i++) {
                result = result.replace(new RegExp(banglaDigits[i], 'g'), englishDigits[i]);
            }
            return result;
        }
        
        // Convert English digits to Bangla digits
        function englishToBangla(text) {
            if (!text) return '';
            const banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let result = String(text);
            for (let i = 0; i < englishDigits.length; i++) {
                result = result.replace(new RegExp(englishDigits[i], 'g'), banglaDigits[i]);
            }
            return result;
        }
        
        // Normalize text for searching - converts to English digits and removes spaces
        function normalizeForSearch(text) {
            if (!text) return '';
            return banglaToEnglish(String(text)).replace(/\s/g, '').toLowerCase();
        }
        
        // Global variables
        let currentPdf = null;
        let currentPage = 1;
        let pdfDoc = null;
        let scale = 1.0;
        const scaleDelta = 0.2;
        let pdfListData = []; // Store PDF data with titles
        let searchedNid = null; // Store the searched NID for highlighting
        
        // Load PDF list on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPdfList();
            
            // Setup search form
            const searchForm = document.getElementById('nidSearchForm');
            const searchBtn = document.getElementById('searchBtn');
            
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const nid = document.getElementById('nidInput').value.trim();
                if (nid) {
                    // Disable button and show spinner
                    searchBtn.disabled = true;
                    searchNidInPdfs(nid);
                }
            });
        });
        
        // Load PDF list
        async function loadPdfList() {
            try {
                const response = await fetch('{{ route("pdfs.list") }}');
                const data = await response.json();
                
                const container = document.getElementById('pdfListContainer');
                
                if (data.success && data.pdfs.length > 0) {
                    // Store PDF data globally
                    pdfListData = data.pdfs;
                    
                    let html = '<div class="pdf-grid">';
                    data.pdfs.forEach(pdf => {
                        const sizeInMB = (pdf.size / (1024 * 1024)).toFixed(2);
                        const displayTitle = pdf.title && pdf.title !== pdf.name ? pdf.title : pdf.name;
                        // Use data attributes to avoid escaping issues
                        html += `
                            <div class="pdf-card" 
                                 data-pdf-path="${escapeHtml(pdf.path)}" 
                                 data-pdf-name="${escapeHtml(pdf.name)}" 
                                 data-pdf-title="${escapeHtml(pdf.title || pdf.name)}"
                                 style="cursor: pointer;">
                                <i class="bi bi-file-pdf pdf-icon"></i>
                                <div class="pdf-name">${escapeHtml(displayTitle)}</div>
                                <div class="pdf-size">${sizeInMB} MB</div>
                            </div>
                        `;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                    
                    // Add click event listeners to PDF cards
                    container.querySelectorAll('.pdf-card').forEach(card => {
                        card.addEventListener('click', function() {
                            const path = this.getAttribute('data-pdf-path');
                            const name = this.getAttribute('data-pdf-name');
                            const title = this.getAttribute('data-pdf-title');
                            openPdf(path, name, title);
                        });
                    });
                } else {
                    container.innerHTML = '<div class="no-pdfs">কোন PDF ফাইল পাওয়া যায়নি</div>';
                }
            } catch (error) {
                console.error('Error loading PDFs:', error);
                document.getElementById('pdfListContainer').innerHTML = 
                    '<div class="no-pdfs">PDF ফাইল লোড করতে সমস্যা হয়েছে</div>';
            }
        }
        
        // Search NID in all PDFs
        async function searchNidInPdfs(nid) {
            const statusDiv = document.getElementById('searchStatus');
            const searchBtn = document.getElementById('searchBtn');
            
            statusDiv.style.display = 'block';
            statusDiv.className = 'search-status info';
            statusDiv.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>অনুসন্ধান করা হচ্ছে... অনুগ্রহ করে অপেক্ষা করুন...';
            
            try {
                // Use stored pdfListData or fetch if not available
                let pdfsToSearch = pdfListData;
                if (!pdfsToSearch || pdfsToSearch.length === 0) {
                    const response = await fetch('{{ route("pdfs.list") }}');
                    const data = await response.json();
                    if (data.success && data.pdfs) {
                        pdfsToSearch = data.pdfs;
                        pdfListData = data.pdfs; // Store for future use
                    }
                }
                
                if (!pdfsToSearch || pdfsToSearch.length === 0) {
                    statusDiv.className = 'search-status error';
                    statusDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>কোন PDF ফাইল পাওয়া যায়নি';
                    searchBtn.disabled = false;
                    return;
                }
                
                let found = false;
                const searchTexts = ['ভোটার নং', 'ভোটার নম্বর', 'NID', 'nid', 'নং'];
                
                // Normalize the search NID to English digits for consistent searching
                const normalizedNid = normalizeForSearch(nid);
                const nidEnglish = banglaToEnglish(nid).replace(/\s/g, '');
                const nidBangla = englishToBangla(nid).replace(/\s/g, '');
                
                // Create pattern that matches both English and Bangla versions
                const nidPattern = new RegExp(normalizedNid.replace(/(\d)/g, '\\s*$1'), 'i');
                
                // Search in each PDF
                for (let pdfIndex = 0; pdfIndex < pdfsToSearch.length; pdfIndex++) {
                    const pdf = pdfsToSearch[pdfIndex];
                    statusDiv.innerHTML = `<i class="bi bi-hourglass-split me-2"></i>অনুসন্ধান করা হচ্ছে... (${pdfIndex + 1}/${pdfsToSearch.length}): ${pdf.name}`;
                    
                    try {
                        const loadingTask = pdfjsLib.getDocument({
                            url: pdf.path,
                            cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                            cMapPacked: true,
                        });
                        const pdfDocument = await loadingTask.promise;
                        
                        // Search through all pages
                        for (let pageNum = 1; pageNum <= pdfDocument.numPages; pageNum++) {
                            try {
                                const page = await pdfDocument.getPage(pageNum);
                                const textContent = await page.getTextContent();
                                
                                // Get all text from the page
                                let pageText = '';
                                for (const item of textContent.items) {
                                    if (item.str) {
                                        pageText += item.str + ' ';
                                    }
                                }
                                
                                // Normalize page text for searching (convert to English digits)
                                const normalizedPageText = normalizeForSearch(pageText);
                                const originalPageText = pageText.replace(/\s+/g, ' ').trim();
                                
                                // Check if page contains search text
                                const hasSearchText = searchTexts.some(text => originalPageText.includes(text));
                                
                                // Check if normalized page text contains normalized NID
                                // Also check for both English and Bangla versions in original text
                                const hasNid = normalizedPageText.includes(normalizedNid) || 
                                             originalPageText.includes(nidEnglish) || 
                                             originalPageText.includes(nidBangla) ||
                                             nidPattern.test(normalizedPageText);
                                
                                if (hasSearchText && hasNid) {
                                    found = true;
                                    const pdfTitle = pdf.title || pdf.name;
                                    statusDiv.className = 'search-status success';
                                    statusDiv.innerHTML = `<i class="bi bi-check-circle me-2"></i>পাওয়া গেছে! PDF: ${pdf.name}, পাতা: ${pageNum}`;
                                    
                                    // Open PDF at the found page with title and NID for highlighting
                                    setTimeout(() => {
                                        openPdfAtPage(pdf.path, pdf.name, pageNum, pdfTitle, nid);
                                    }, 500);
                                    
                                    return; // Stop searching
                                }
                            } catch (pageError) {
                                console.error(`Error reading page ${pageNum} of ${pdf.name}:`, pageError);
                            }
                        }
                    } catch (error) {
                        console.error(`Error searching in ${pdf.name}:`, error);
                        // Continue with next PDF
                    }
                }
                
                if (!found) {
                    statusDiv.className = 'search-status error';
                    statusDiv.innerHTML = `<i class="bi bi-x-circle me-2"></i>এই NID (${nid}) কোন PDF-এ পাওয়া যায়নি। অনুগ্রহ করে NID নম্বরটি সঠিক কিনা যাচাই করুন।`;
                }
            } catch (error) {
                console.error('Error searching PDFs:', error);
                statusDiv.className = 'search-status error';
                statusDiv.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>অনুসন্ধান করতে সমস্যা হয়েছে: ' + error.message;
            } finally {
                // Re-enable button after search completes
                const searchBtn = document.getElementById('searchBtn');
                if (searchBtn) {
                    searchBtn.disabled = false;
                }
            }
        }
        
        // Open PDF in modal
        function openPdf(pdfPath, pdfName, pdfTitle = null) {
            // Clear searched NID when opening PDF manually (not from search)
            searchedNid = null;
            
            // If title not provided, try to find it from pdfListData
            if (!pdfTitle) {
                const pdfData = pdfListData.find(p => p.name === pdfName || p.path === pdfPath);
                pdfTitle = pdfData ? (pdfData.title || pdfData.name) : pdfName;
            }
            openPdfAtPage(pdfPath, pdfName, 1, pdfTitle);
        }
        
        // Open PDF at specific page
        async function openPdfAtPage(pdfPath, pdfName, pageNum = 1, pdfTitle = null, nidToHighlight = null) {
            const modal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
            
            // Store the NID for highlighting
            searchedNid = nidToHighlight;
            
            // Use provided title or find from pdfListData
            let displayTitle = pdfTitle;
            if (!displayTitle) {
                const pdfData = pdfListData.find(p => p.name === pdfName || p.path === pdfPath);
                displayTitle = pdfData ? (pdfData.title || pdfData.name) : pdfName;
            }
            
            // Set modal title (escape HTML for safety)
            document.getElementById('pdfViewerModalLabel').innerHTML = 
                `<i class="bi bi-file-pdf me-2"></i>${escapeHtml(displayTitle)}`;
            
            currentPdf = pdfPath;
            currentPage = pageNum;
            scale = 1.0;
            
            try {
                const loadingTask = pdfjsLib.getDocument({
                    url: pdfPath,
                    cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                    cMapPacked: true,
                });
                pdfDoc = await loadingTask.promise;
                
                document.getElementById('pageCount').textContent = pdfDoc.numPages;
                document.getElementById('pageNum').max = pdfDoc.numPages;
                
                await renderPage(currentPage);
                modal.show();
            } catch (error) {
                console.error('Error loading PDF:', error);
                alert('PDF লোড করতে সমস্যা হয়েছে');
            }
        }
        
        // Render PDF page
        async function renderPage(pageNum) {
            if (!pdfDoc) return;
            
            try {
                const page = await pdfDoc.getPage(pageNum);
                const viewport = page.getViewport({ scale: scale });
                
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                
                await page.render(renderContext).promise;
                
                // Highlight NID if it exists and we're on the page where it was found
                if (searchedNid && currentPage === pageNum) {
                    await highlightNidOnPage(page, context, viewport, searchedNid);
                }
                
                const viewer = document.getElementById('pdfViewer');
                viewer.innerHTML = '';
                viewer.appendChild(canvas);
                
                document.getElementById('pageNum').value = pageNum;
                document.getElementById('zoomLevel').textContent = Math.round(scale * 100) + '%';
            } catch (error) {
                console.error('Error rendering page:', error);
            }
        }
        
        // Highlight NID on the rendered page
        async function highlightNidOnPage(page, context, viewport, nid) {
            try {
                const textContent = await page.getTextContent();
                // Normalize NID to English digits for consistent matching
                const nidClean = normalizeForSearch(nid);
                const nidEnglish = banglaToEnglish(nid).replace(/\s/g, '').toLowerCase();
                const nidBangla = englishToBangla(nid).replace(/\s/g, '').toLowerCase();
                const nidPattern = new RegExp(nidClean.replace(/(\d)/g, '\\s*$1'), 'i'); // Allow spaces between digits
                
                // Get the default viewport for coordinate transformation
                const defaultViewport = page.getViewport({ scale: 1.0 });
                const scaleX = viewport.width / defaultViewport.width;
                const scaleY = viewport.height / defaultViewport.height;
                
                // Find text items that contain the NID
                const highlightRects = [];
                
                // First, try to find exact matches in individual text items
                for (const item of textContent.items) {
                    if (item.str) {
                        const itemText = item.str.replace(/\s/g, '').toLowerCase();
                        const normalizedItemText = normalizeForSearch(item.str);
                        // Check if this text item contains the NID (in any form)
                        if (normalizedItemText.includes(nidClean) || 
                            itemText.includes(nidEnglish) || 
                            itemText.includes(nidBangla)) {
                            const transform = item.transform;
                            if (transform && transform.length >= 6) {
                                // PDF coordinates
                                const pdfX = transform[4];
                                const pdfY = transform[5];
                                
                                // Transform to viewport coordinates
                                const viewportX = pdfX * scaleX;
                                const viewportY = (defaultViewport.height - pdfY) * scaleY;
                                
                                // Calculate dimensions
                                const fontSize = item.fontSize || 12;
                                const itemWidth = item.width || (item.str.length * fontSize * 0.5);
                                const itemHeight = fontSize * 1.2;
                                
                                // Calculate the portion of the item that contains the NID
                                const nidStartInItem = itemText.indexOf(nidClean);
                                const nidLength = nidClean.length;
                                const itemLength = itemText.length;
                                
                                const highlightX = viewportX + (itemWidth * (nidStartInItem / itemLength) * scaleX);
                                const highlightWidth = (itemWidth * (nidLength / itemLength)) * scaleX;
                                
                                highlightRects.push({
                                    x: highlightX,
                                    y: viewportY - (itemHeight * scaleY),
                                    width: highlightWidth,
                                    height: itemHeight * scaleY
                                });
                            }
                        }
                    }
                }
                
                // If no matches found, try searching across multiple text items
                if (highlightRects.length === 0) {
                    let combinedText = '';
                    const textItems = [];
                    
                    for (const item of textContent.items) {
                        if (item.str) {
                            combinedText += item.str;
                            textItems.push(item);
                        }
                    }
                    
                    // Normalize combined text for searching
                    const combinedTextNormalized = normalizeForSearch(combinedText);
                    const combinedTextClean = combinedText.replace(/\s/g, '').toLowerCase();
                    
                    // Check for NID in normalized text, English, or Bangla form
                    let nidIndex = combinedTextNormalized.indexOf(nidClean);
                    if (nidIndex === -1) {
                        nidIndex = combinedTextClean.indexOf(nidEnglish);
                    }
                    if (nidIndex === -1) {
                        nidIndex = combinedTextClean.indexOf(nidBangla);
                    }
                    
                    if (nidIndex !== -1) {
                        // Find which text item(s) contain the NID
                        let charCount = 0;
                        let startItem = null;
                        let endItem = null;
                        let startOffset = 0;
                        let endOffset = 0;
                        
                        // Use normalized text for character counting
                        let normalizedCharCount = 0;
                        for (let i = 0; i < textItems.length; i++) {
                            const item = textItems[i];
                            const itemText = item.str.replace(/\s/g, '').toLowerCase();
                            const normalizedItemText = normalizeForSearch(item.str);
                            const itemStart = normalizedCharCount;
                            const itemEnd = normalizedCharCount + normalizedItemText.length;
                            
                            if (nidIndex >= itemStart && nidIndex < itemEnd) {
                                if (!startItem) {
                                    startItem = item;
                                    // Find position in normalized item text
                                    const itemNormalized = normalizeForSearch(item.str);
                                    startOffset = Math.min(nidIndex - itemStart, itemNormalized.length);
                                }
                            }
                            
                            if (nidIndex + nidClean.length > itemStart && nidIndex + nidClean.length <= itemEnd) {
                                endItem = item;
                                const itemNormalized = normalizeForSearch(item.str);
                                endOffset = Math.min((nidIndex + nidClean.length) - itemStart, itemNormalized.length);
                                break;
                            }
                            
                            normalizedCharCount = itemEnd;
                        }
                        
                        if (startItem) {
                            const transform = startItem.transform;
                            if (transform && transform.length >= 6) {
                                const pdfX = transform[4];
                                const pdfY = transform[5];
                                
                                const viewportX = pdfX * scaleX;
                                const viewportY = (defaultViewport.height - pdfY) * scaleY;
                                
                                const fontSize = startItem.fontSize || 12;
                                const itemWidth = startItem.width || (startItem.str.length * fontSize * 0.5);
                                const itemHeight = fontSize * 1.2;
                                
                                const startItemTextNormalized = normalizeForSearch(startItem.str);
                                const startItemTextLength = startItemTextNormalized.length || startItem.str.length;
                                const highlightX = viewportX + (itemWidth * (startOffset / Math.max(startItemTextLength, 1)) * scaleX);
                                
                                // Calculate width - if spans multiple items, estimate
                                let highlightWidth = 0;
                                if (endItem && endItem !== startItem) {
                                    // Span multiple items - estimate total width
                                    const startItemTextNormalized = normalizeForSearch(startItem.str);
                                    const startItemTextLength = startItemTextNormalized.length || startItem.str.length;
                                    highlightWidth = (itemWidth * ((startItemTextLength - startOffset) / Math.max(startItemTextLength, 1))) * scaleX;
                                    // Add width of items in between
                                    const startIndex = textItems.indexOf(startItem);
                                    const endIndex = textItems.indexOf(endItem);
                                    for (let i = startIndex + 1; i < endIndex; i++) {
                                        const midItem = textItems[i];
                                        const midFontSize = midItem.fontSize || 12;
                                        const midWidth = midItem.width || (midItem.str.length * midFontSize * 0.5);
                                        highlightWidth += midWidth * scaleX;
                                    }
                                    // Add width of end item portion
                                    const endItemTextNormalized = normalizeForSearch(endItem.str);
                                    const endItemTextLength = endItemTextNormalized.length || endItem.str.length;
                                    const endFontSize = endItem.fontSize || 12;
                                    const endWidth = endItem.width || (endItem.str.length * endFontSize * 0.5);
                                    highlightWidth += (endWidth * (endOffset / Math.max(endItemTextLength, 1))) * scaleX;
                                } else {
                                    // Single item
                                    const startItemTextNormalized = normalizeForSearch(startItem.str);
                                    const startItemTextLength = startItemTextNormalized.length || startItem.str.length;
                                    highlightWidth = (itemWidth * (nidClean.length / Math.max(startItemTextLength, 1))) * scaleX;
                                }
                                
                                highlightRects.push({
                                    x: highlightX,
                                    y: viewportY - (itemHeight * scaleY),
                                    width: highlightWidth,
                                    height: itemHeight * scaleY
                                });
                            }
                        }
                    }
                }
                
                // Draw highlight rectangles
                if (highlightRects.length > 0) {
                    context.save();
                    context.globalAlpha = 0.4;
                    context.fillStyle = '#7df865'; // Yellow highlight
                    
                    highlightRects.forEach(rect => {
                        context.fillRect(rect.x, rect.y, rect.width, rect.height);
                    });
                    
                    // Add border for better visibility
                    context.globalAlpha = 0.4;
                    context.strokeStyle = '#7df865'; // Same color as fill
                    context.lineWidth = 10;
                    highlightRects.forEach(rect => {
                        context.strokeRect(rect.x, rect.y, rect.width, rect.height);
                    });
                    
                    context.restore();
                }
            } catch (error) {
                console.error('Error highlighting NID:', error);
            }
        }
        

        
        // PDF navigation controls
        document.getElementById('prevPage').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderPage(currentPage);
            }
        });
        
        document.getElementById('nextPage').addEventListener('click', function() {
            if (pdfDoc && currentPage < pdfDoc.numPages) {
                currentPage++;
                renderPage(currentPage);
            }
        });
        
        document.getElementById('pageNum').addEventListener('change', function() {
            const page = parseInt(this.value);
            if (page >= 1 && page <= (pdfDoc ? pdfDoc.numPages : 1)) {
                currentPage = page;
                renderPage(currentPage);
            }
        });
        
        document.getElementById('zoomIn').addEventListener('click', function() {
            scale += scaleDelta;
            renderPage(currentPage);
        });
        
        document.getElementById('zoomOut').addEventListener('click', function() {
            if (scale > scaleDelta) {
                scale -= scaleDelta;
                renderPage(currentPage);
            }
        });
        
        // Close modal and cleanup
        document.getElementById('pdfViewerModal').addEventListener('hidden.bs.modal', function() {
            if (pdfDoc) {
                pdfDoc.destroy();
                pdfDoc = null;
            }
            document.getElementById('pdfViewer').innerHTML = '';
            // Clear searched NID when modal closes
            searchedNid = null;
        });
        
        // Campaign Football Interactive Effect
        const campaignFootball = document.getElementById('campaignFootball');
        if (campaignFootball) {
            campaignFootball.addEventListener('click', function() {
                this.style.animation = 'none';
                setTimeout(() => {
                    this.style.animation = 'campaignFootballRotate 10s linear infinite, campaignFootballFloat 4s ease-in-out infinite';
                }, 10);
                
                // Create ripple effect
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.width = '150px';
                ripple.style.height = '150px';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.4)';
                ripple.style.transform = 'translate(-50%, -50%) scale(0)';
                ripple.style.top = '50%';
                ripple.style.left = '50%';
                ripple.style.animation = 'campaignRipple 0.6s ease-out';
                ripple.style.pointerEvents = 'none';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        }
        
        // Add ripple animation for campaign football
        const campaignStyle = document.createElement('style');
        campaignStyle.textContent = `
            @keyframes campaignRipple {
                to {
                    transform: translate(-50%, -50%) scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(campaignStyle);
    </script>

</body>
</html>

