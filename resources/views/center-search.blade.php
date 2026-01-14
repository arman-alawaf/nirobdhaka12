<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>কেন্দ্র অনুসন্ধান - ভোটার নং অনুসন্ধান | সাইফুল আলম নীরব</title>
    
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
            padding: 20px 0;
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
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="bi bi-search me-2"></i>কেন্দ্র অনুসন্ধান</h1>
            <p>ভোটার নং (NID) দিয়ে PDF-এ আপনার তথ্য খুঁজুন</p>
        </div>
        
        <!-- Search Section -->
        <div class="search-section">
            <form id="nidSearchForm" class="search-form">
                <div class="search-input-group">
                    <label for="nidInput"><i class="bi bi-card-text me-2"></i>ভোটার নং (NID) লিখুন</label>
                    <input type="text" id="nidInput" name="nid" placeholder="উদাহরণ: 1234567890123" required>
                </div>
                <button type="submit" class="search-btn">
                    <i class="bi bi-search me-2"></i>অনুসন্ধান করুন
                </button>
            </form>
            <div id="searchStatus" class="search-status"></div>
        </div>
        
        <!-- PDF List Section -->
        <div class="pdf-list-section">
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
                    <button id="prevPage" class="btn btn-sm">
                        <i class="bi bi-chevron-left"></i> পূর্ববর্তী
                    </button>
                    <span>
                        পাতা: <input type="number" id="pageNum" value="1" min="1"> / <span id="pageCount">0</span>
                    </span>
                    <button id="nextPage" class="btn btn-sm">
                        পরবর্তী <i class="bi bi-chevron-right"></i>
                    </button>
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
        
        // Global variables
        let currentPdf = null;
        let currentPage = 1;
        let pdfDoc = null;
        let scale = 1.0;
        const scaleDelta = 0.2;
        let pdfListData = []; // Store PDF data with titles
        
        // Load PDF list on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPdfList();
            
            // Setup search form
            document.getElementById('nidSearchForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const nid = document.getElementById('nidInput').value.trim();
                if (nid) {
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
                    return;
                }
                
                let found = false;
                const searchTexts = ['ভোটার নং', 'ভোটার নম্বর', 'NID', 'nid', 'নং'];
                const nidPattern = new RegExp(nid.replace(/\s/g, ''), 'i');
                
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
                                
                                // Remove extra spaces and normalize
                                pageText = pageText.replace(/\s+/g, ' ').trim();
                                
                                // Check if page contains search text and NID
                                const hasSearchText = searchTexts.some(text => pageText.includes(text));
                                const hasNid = nidPattern.test(pageText) || pageText.includes(nid);
                                
                                if (hasSearchText && hasNid) {
                                    found = true;
                                    const pdfTitle = pdf.title || pdf.name;
                                    statusDiv.className = 'search-status success';
                                    statusDiv.innerHTML = `<i class="bi bi-check-circle me-2"></i>পাওয়া গেছে! PDF: ${pdf.name}, পাতা: ${pageNum}`;
                                    
                                    // Open PDF at the found page with title
                                    setTimeout(() => {
                                        openPdfAtPage(pdf.path, pdf.name, pageNum, pdfTitle);
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
            }
        }
        
        // Open PDF in modal
        function openPdf(pdfPath, pdfName, pdfTitle = null) {
            // If title not provided, try to find it from pdfListData
            if (!pdfTitle) {
                const pdfData = pdfListData.find(p => p.name === pdfName || p.path === pdfPath);
                pdfTitle = pdfData ? (pdfData.title || pdfData.name) : pdfName;
            }
            openPdfAtPage(pdfPath, pdfName, 1, pdfTitle);
        }
        
        // Open PDF at specific page
        async function openPdfAtPage(pdfPath, pdfName, pageNum = 1, pdfTitle = null) {
            const modal = new bootstrap.Modal(document.getElementById('pdfViewerModal'));
            
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
                
                const viewer = document.getElementById('pdfViewer');
                viewer.innerHTML = '';
                viewer.appendChild(canvas);
                
                document.getElementById('pageNum').value = pageNum;
                document.getElementById('zoomLevel').textContent = Math.round(scale * 100) + '%';
            } catch (error) {
                console.error('Error rendering page:', error);
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
        });
    </script>
</body>
</html>

