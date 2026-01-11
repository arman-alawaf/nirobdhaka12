@extends('layouts.auth')

@section('title', 'সদস্য সম্পাদনা করুন - নিরব')

@section('container-class', 'container-form')

@section('content')
    <h1>সদস্য সম্পাদনা করুন</h1>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="ashon">আসন</label>
                <input type="text" id="ashon" name="ashon" value="{{ old('ashon', $member->ashon) }}">
                @error('ashon')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">নাম <span style="color: red;">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $member->name) }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="dob">জন্ম তারিখ</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob', $member->dob ? $member->dob->format('Y-m-d') : '') }}">
                @error('dob')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nid">এনআইডি <span style="color: red;">*</span></label>
                <input type="text" id="nid" name="nid" value="{{ old('nid', $member->nid) }}" required>
                @error('nid')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="gender">লিঙ্গ</label>
                <select id="gender" name="gender">
                    <option value="">লিঙ্গ নির্বাচন করুন</option>
                    <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>পুরুষ</option>
                    <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>মহিলা</option>
                    <option value="hijra" {{ old('gender', $member->gender) == 'hijra' ? 'selected' : '' }}>হিজড়া</option>
                </select>
                @error('gender')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="occupation">পেশা</label>
                <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $member->occupation) }}">
                @error('occupation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="fother">পিতার নাম</label>
                <input type="text" id="fother" name="fother" value="{{ old('fother', $member->fother) }}">
                @error('fother')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mother">মাতার নাম</label>
                <input type="text" id="mother" name="mother" value="{{ old('mother', $member->mother) }}">
                @error('mother')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">ঠিকানা</label>
            <textarea id="address" name="address">{{ old('address', $member->address) }}</textarea>
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="zila">জেলা</label>
                <input type="text" id="zila" name="zila" value="{{ old('zila', $member->zila) }}">
                @error('zila')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="upazila">উপজেলা</label>
                <input type="text" id="upazila" name="upazila" value="{{ old('upazila', $member->upazila) }}">
                @error('upazila')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="city_corporation">সিটি কর্পোরেশন</label>
                <input type="text" id="city_corporation" name="city_corporation" value="{{ old('city_corporation', $member->city_corporation) }}">
                @error('city_corporation')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="word">ওয়ার্ড</label>
                <input type="text" id="word" name="word" value="{{ old('word', $member->word) }}">
                @error('word')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="area">এলাকা</label>
                <input type="text" id="area" name="area" value="{{ old('area', $member->area) }}">
                @error('area')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="area_number">এলাকা নম্বর</label>
                <input type="text" id="area_number" name="area_number" value="{{ old('area_number', $member->area_number) }}">
                @error('area_number')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">সদস্য আপডেট করুন</button>
            <a href="{{ route('members.index') }}" class="btn btn-secondary">বাতিল</a>
        </div>
    </form>
@endsection
