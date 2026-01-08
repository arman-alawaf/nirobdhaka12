@extends('layouts.app')

@section('title', 'সদস্য ইম্পোর্ট করুন - নিরব')

@section('container-class', 'container-form')

@section('content')
    <h1>এক্সেল থেকে সদস্য ইম্পোর্ট করুন</h1>

    <div class="import-info">
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
                <li>লিঙ্গ (পুরুষ/মহিলা বা male/female)</li>
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
            <button type="submit" class="btn btn-primary">সদস্য ইম্পোর্ট করুন</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">বাতিল</a>
            <a href="{{ route('members.export') }}" class="btn btn-info">নমুনা এক্সেল ডাউনলোড করুন</a>
        </div>
    </form>
@endsection

