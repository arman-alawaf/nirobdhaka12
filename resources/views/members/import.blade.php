@extends('layouts.auth')

@section('title', 'সদস্য ইম্পোর্ট করুন - নিরব')

@section('container-class', 'container-form')

@section('content')
    <h1>এক্সেল থেকে সদস্য ইম্পোর্ট করুন</h1>


    <form action="{{ route('members.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="file">এক্সেল ফাইল নির্বাচন করুন <span style="color: red;">*</span></label>
            <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required>
            @error('file')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="update_existing" value="1">
                এনআইডি মিললে বিদ্যমান সদস্যদের আপডেট করুন (অন্যথায় ডুপ্লিকেট এড়িয়ে যান)
            </label>
        </div>

        <div class="btn-group">
            <button type="submit" id="importBtn" class="btn btn-primary">সদস্য ইম্পোর্ট করুন</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">বাতিল</a>
            <a href="{{ route('members.export') }}" class="btn btn-info">নমুনা এক্সেল ডাউনলোড করুন</a>
        </div>

        <div id="progressContainer" style="display: none; margin-top: 20px;">
            <div style="background-color: #f0f0f0; border-radius: 4px; height: 30px; position: relative; overflow: hidden;">
                <div id="progressBar" style="background-color: #007bff; height: 100%; width: 0%; transition: width 0.3s ease; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 12px;">
                    <span id="progressText">0%</span>
                </div>
            </div>
            <p id="progressMessage" style="margin-top: 10px; text-align: center; color: #666;">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                <span style="margin-left: 10px; margin-right: 10px;"> ইম্পোর্ট করা হচ্ছে </span>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            </p>
        </div>
    </form>


    <div class="import-info mt-5">
        <h3>ইম্পোর্ট নির্দেশাবলী:</h3>
        <ol>
            <li>নমুনা এক্সেল ফাইল ডাউনলোড করুন বা ফরম্যাট দেখতে বিদ্যমান সদস্যদের এক্সপোর্ট করুন</li>
            <li>নিশ্চিত করুন যে আপনার এক্সেল ফাইলে নিম্নলিখিত কলাম সহ হেডার রয়েছে (নমনীয় নামকরণ সমর্থিত):</li>
            <ul>
                <li>আইডি (ঐচ্ছিক, প্রদান না করলে স্বয়ংক্রিয়ভাবে তৈরি হবে)</li>
                <li>আসন</li>
                <li>নাম (আবশ্যক)</li>
                <li>জন্ম তারিখ / DOB (ফরম্যাট: YYYY-MM-DD বা এক্সেল তারিখ ফরম্যাট)</li>
                <li>এনআইডি / জাতীয় পরিচয়পত্র (আবশ্যক, অনন্য হতে হবে)</li>
                <li>লিঙ্গ (পুরুষ/মহিলা/হিজড়া বা male/female/hijra)</li>
                <li>পিতা / Father</li>
                <li>মাতা / Mother</li>
                <li>পেশা / Occupation</li>
                <li>ঠিকানা / Address</li>
                <li>জেলা / Zila / District</li>
                <li>উপজেলা / Upazila / Sub-District</li>
                <li>সিটি কর্পোরেশন / City Corporation / City</li>
                <li>ওয়ার্ড / Word / Ward</li>
                <li>এলাকা / Area</li>
                <li>এলাকা নম্বর / Area Number / Area No</li>
            </ul>
            <li>সর্বোচ্চ ফাইল আকার: ১০ এমবি</li>
            <li>ফাইল ফরম্যাট: এক্সেল (.xlsx, .xls) বা CSV (.csv)</li>
            <li>ইম্পোর্ট স্বয়ংক্রিয়ভাবে কলাম হেডার সনাক্ত করবে, তাই কলামের ক্রম গুরুত্বপূর্ণ নয়</li>
        </ol>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[enctype="multipart/form-data"]');
    const importBtn = document.getElementById('importBtn');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const progressMessage = document.getElementById('progressMessage');

    if (form && importBtn) {
        form.addEventListener('submit', function(e) {
            // Disable the submit button
            importBtn.disabled = true;
            importBtn.textContent = 'ইম্পোর্ট করা হচ্ছে...';
            importBtn.style.opacity = '0.6';
            importBtn.style.cursor = 'not-allowed';

            // Show progress container
            progressContainer.style.display = 'block';

            // Animate progress bar to 100%
            let progress = 0;
            const interval = setInterval(function() {
                progress += 2; // Increment by 2% each interval
                
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                }
                
                progressBar.style.width = progress + '%';
                progressText.textContent = Math.round(progress) + '%';
            }, 50); // Update every 50ms for smooth animation (takes ~2.5 seconds to reach 100%)
        });
    }
});
</script>
@endpush

