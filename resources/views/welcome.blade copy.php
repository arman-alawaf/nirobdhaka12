<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Member Search - Nirob</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/members.css') }}">
    <style>
      .modal-dialog {
        max-width: 90%;
      }
      .modal-body {
        max-height: 70vh;
        overflow-y: auto;
      }
      #searchResults {
        margin-top: 20px;
      }
      .loading-spinner {
        text-align: center;
        padding: 20px;
      }
    </style>
  </head>
  <body>

  <div class="container py-5">
    <div class="row">
      <div class="col-md-12 text-center">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  সদস্য খুঁজুন (Search Members)
</button>

      </div>
    </div>
  </div>

  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">সদস্য খুঁজুন (Search Members)</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Filter Form -->
        <div class="filter-section">
          <form id="searchForm" method="POST" action="{{ route('members.search') }}">
            @csrf
            <div class="filter-row">
              <div class="form-group">
                <label>জন্ম তারিখ (DOB)</label>
                <input type="date" name="dob" id="dob" value="" placeholder="YYYY-MM-DD">
              </div>
              <div class="form-group">
                <label>নাম (Name)</label>
                <input type="text" name="name" id="name" value="" placeholder="নাম লিখুন...">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">খুঁজুন (Search)</button>
            <button type="button" class="btn btn-info" id="resetBtn">রিসেট (Reset)</button>
          </form>
        </div>

        <!-- Search Results -->
        <div id="searchResults">
          <div class="text-center text-muted">
            অনুগ্রহ করে অনুসন্ধান করুন (Please search to see results)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন (Close)</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
      // Set up CSRF token for AJAX requests
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      
      // Handle form submission
      document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        const formData = new FormData(this);
        const resultsDiv = document.getElementById('searchResults');
        
        // Show loading
        resultsDiv.innerHTML = '<div class="loading-spinner"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
        
        // Make AJAX request
        fetch('{{ route("members.search") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            displayResults(data.members, data.count);
          } else {
            resultsDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          resultsDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
        });
      });
      
      // Reset button handler
      document.getElementById('resetBtn').addEventListener('click', function() {
        document.getElementById('searchForm').reset();
        document.getElementById('searchResults').innerHTML = '<div class="text-center text-muted">অনুগ্রহ করে অনুসন্ধান করুন (Please search to see results)</div>';
      });
      
      // Display search results
      function displayResults(members, count) {
        const resultsDiv = document.getElementById('searchResults');
        
        if (members.length === 0) {
          resultsDiv.innerHTML = '<div class="alert alert-info">কোন সদস্য পাওয়া যায়নি। (No members found.)</div>';
          return;
        }
        
        let html = `<div class="alert alert-success">${count} টি সদস্য পাওয়া গেছে (${count} members found)</div>`;
        html += '<div class="table-container"><table class="table table-striped table-bordered">';
        html += '<thead><tr>';
        html += '<th>আইডি</th><th>আসন</th><th>নাম</th><th>জন্ম তারিখ</th><th>এনআইডি</th><th>লিঙ্গ</th>';
        html += '<th>পিতা</th><th>মাতা</th><th>পেশা</th><th>ঠিকানা</th><th>জেলা</th><th>উপজেলা</th>';
        html += '<th>সিটি কর্পোরেশন</th><th>ওয়ার্ড</th><th>এলাকা</th><th>এলাকা নম্বর</th>';
        html += '</tr></thead><tbody>';
        
        members.forEach(member => {
          html += '<tr>';
          html += `<td>${member.id}</td>`;
          html += `<td>${member.ashon}</td>`;
          html += `<td>${member.name}</td>`;
          html += `<td>${member.dob}</td>`;
          html += `<td>${member.nid}</td>`;
          html += `<td>${member.gender}</td>`;
          html += `<td>${member.fother}</td>`;
          html += `<td>${member.mother}</td>`;
          html += `<td>${member.occupation}</td>`;
          html += `<td>${member.address}</td>`;
          html += `<td>${member.zila}</td>`;
          html += `<td>${member.upazila}</td>`;
          html += `<td>${member.city_corporation}</td>`;
          html += `<td>${member.word}</td>`;
          html += `<td>${member.area}</td>`;
          html += `<td>${member.area_number}</td>`;
          html += '</tr>';
        });
        
        html += '</tbody></table></div>';
        resultsDiv.innerHTML = html;
      }
    </script>
  </body>
</html>