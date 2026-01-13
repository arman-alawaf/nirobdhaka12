@extends('layouts.auth')

@section('title', 'সদস্য ব্যবস্থাপনা - নিরব')

@section('content')
    <h1>
        <span>সদস্য - {{ $members->total() }}</span>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            
            <a href="{{ route('members.export') }}" class="btn btn-success">এক্সেল এক্সপোর্ট করুন</a>
            <a href="{{ route('members.import') }}" class="btn btn-info">এক্সেল ইম্পোর্ট করুন</a>
            <a href="{{ route('members.create') }}" class="btn btn-primary">নতুন সদস্য যোগ করুন</a>
            @if(auth()->user()->email === 'arman.p2c@gmail.com')
                @if($members->total() > 0)
                    <form action="{{ route('members.deleteAll') }}" method="POST" style="display: inline;" onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি সব সদস্য মুছে ফেলতে চান? এই কাজটি পূর্বাবস্থায় ফিরিয়ে আনা যাবে না।');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">সব ডেটা মুছুন</button>
                    </form>
                @endif
            @endif
        </div>
    </h1>

    <div class="filter-section">
        <form method="GET" action="{{ route('members.index') }}">
            <div class="filter-row">
                <div class="form-group">
                    <label>জন্ম তারিখ (DOB)</label>
                    <input type="date" name="dob" value="{{ request('dob') }}" placeholder="YYYY-MM-DD">
                </div>
                <div class="form-group">
                    <label>নাম (Name)</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="নাম লিখুন...">
                </div>
                <div class="form-group">
                    <label>এলাকা নম্বর (Area Number)</label>
                    <input type="text" name="area_number" value="{{ request('area_number') }}" placeholder="এলাকা নম্বর লিখুন...">
                </div>
                <div class="form-group">
                    <label>ওয়ার্ড (Word)</label>
                    <input type="text" name="word" value="{{ request('word') }}" placeholder="ওয়ার্ড লিখুন...">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('members.index') }}" class="btn btn-info">Reset</a>
        </form>
    </div> 

    <div class="table-container">
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>আইডি</th>
                    <th>আসন</th>
                    <th>নাম</th>
                    <th>জন্ম তারিখ</th>
                    <th>এনআইডি</th>
                    <th>লিঙ্গ</th>
                    <th>পিতা</th>
                    <th>মাতা</th>
                    <th>পেশা</th>
                    <th>ঠিকানা</th>
                    <th>জেলা</th>
                    <th>উপজেলা</th>
                    <th>সিটি কর্পোরেশন</th>
                    <th>ওয়ার্ড</th>
                    <th>এলাকা</th>
                    <th>এলাকা নম্বর</th>
                    <th>কর্ম</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->ashon ?? 'N/A' }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->dob ? $member->dob->format('Y-m-d') : 'N/A' }}</td>
                        <td>{{ $member->nid }}</td>
                        <td>{{ $member->gender == 'male' ? 'পুরুষ' : ($member->gender == 'female' ? 'মহিলা' : ($member->gender == 'hijra' ? 'হিজড়া' : ($member->gender ?? 'N/A'))) }}</td>
                        <td>{{ $member->fother ?? 'N/A' }}</td>
                        <td>{{ $member->mother ?? 'N/A' }}</td>
                        <td>{{ $member->occupation ?? 'N/A' }}</td>
                        <td>{{ $member->address ?? 'N/A' }}</td>
                        <td>{{ $member->zila ?? 'N/A' }}</td>
                        <td>{{ $member->upazila ?? 'N/A' }}</td>
                        <td>{{ $member->city_corporation ?? 'N/A' }}</td>
                        <td>{{ $member->word ?? 'N/A' }}</td>
                        <td>{{ $member->area ?? 'N/A' }}</td>
                        <td>{{ $member->area_number ?? 'N/A' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-sm">দেখুন</a>
                                <a href="{{ route('members.edit', $member) }}" class="btn btn-success btn-sm">সম্পাদনা</a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('আপনি কি নিশ্চিত?')">মুছুন</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" style="text-align: center; padding: 20px;">কোন সদস্য পাওয়া যায়নি।</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $members->links() }}
    </div>
@endsection
