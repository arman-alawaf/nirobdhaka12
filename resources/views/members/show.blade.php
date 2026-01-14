@extends('layouts.auth')

@section('title', 'সদস্য দেখুন - নিরব')

@section('container-class', 'container-form')

@section('content')
    <h1>
        <span>সদস্যের বিবরণ</span>
        <div class="btn-group">
            <a href="{{ route('members.edit', $member) }}" class="btn btn-success">সম্পাদনা</a>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">তালিকায় ফিরে যান</a>
        </div>
    </h1>

    <div class="detail-section">
        <div class="section-title">ব্যক্তিগত তথ্য</div>
        <div class="detail-row">
            <div class="detail-label">আইডি:</div>
            <div class="detail-value">{{ $member->id }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">আসন:</div>
            <div class="detail-value">{{ $member->ashon ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">SL:</div>
            <div class="detail-value">{{ $member->sl ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">নাম:</div>
            <div class="detail-value">{{ $member->name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">এনআইডি:</div>
            <div class="detail-value">{{ $member->nid }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">জন্ম তারিখ:</div>
            <div class="detail-value">{{ $member->dob ? $member->dob->format('Y-m-d') : 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">লিঙ্গ:</div>
            <div class="detail-value">{{ $member->gender == 'male' ? 'পুরুষ' : ($member->gender == 'female' ? 'মহিলা' : ($member->gender == 'hijra' ? 'হিজড়া' : ($member->gender ?? 'N/A'))) }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">পেশা:</div>
            <div class="detail-value">{{ $member->occupation ?? 'N/A' }}</div>
        </div>
    </div>

    <div class="detail-section">
        <div class="section-title">পারিবারিক তথ্য</div>
        <div class="detail-row">
            <div class="detail-label">পিতার নাম:</div>
            <div class="detail-value">{{ $member->fother ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">মাতার নাম:</div>
            <div class="detail-value">{{ $member->mother ?? 'N/A' }}</div>
        </div>
    </div>

    <div class="detail-section">
        <div class="section-title">ঠিকানার তথ্য</div>
        <div class="detail-row">
            <div class="detail-label">ঠিকানা:</div>
            <div class="detail-value">{{ $member->address ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">জেলা:</div>
            <div class="detail-value">{{ $member->zila ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">উপজেলা:</div>
            <div class="detail-value">{{ $member->upazila ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">সিটি কর্পোরেশন:</div>
            <div class="detail-value">{{ $member->city_corporation ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">ওয়ার্ড:</div>
            <div class="detail-value">{{ $member->word ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">এলাকা:</div>
            <div class="detail-value">{{ $member->area ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">এলাকা নম্বর:</div>
            <div class="detail-value">{{ $member->area_number ?? 'N/A' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Center:</div>
            <div class="detail-value">{{ $member->center ?? 'N/A' }}</div>
        </div>
    </div>

    <div class="detail-section">
        <div class="section-title">সিস্টেম তথ্য</div>
        <div class="detail-row">
            <div class="detail-label">তৈরি হয়েছে:</div>
            <div class="detail-value">{{ $member->created_at->format('Y-m-d H:i:s') }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">আপডেট হয়েছে:</div>
            <div class="detail-value">{{ $member->updated_at->format('Y-m-d H:i:s') }}</div>
        </div>
    </div>
@endsection
