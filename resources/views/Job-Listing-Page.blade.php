@extends('dashboard')
@section('content')
<div class="job-listing-page">
    <div class="search-panel" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/techday_3baaef0ed6feb9849178.webp') }}');">
        <div class="search-panel-content">
            <div class="greeting-section">
                <h1 class="greeting-text">Hi there, <span class="user-name">{{ Auth::user()->name }}</span><span class="hand-icon"><x-waving-hand /></span></h1>
            </div>

<style>
.hand-icon {
    display: inline-flex;
    align-items: center;
    margin-left: 20px;
}
</style>            <h2 class="search-title">Discover Your Next Job Opportunity</h2>

            @if(auth()->user()->hasAllRoles("Admin"))
            <div class="admin-actions">
                <a href="{{ route('admin.addjob') }}" class="add-job-btn">+ Add a Job</a>
            </div>
            @endif

            <div class="job-search">
                <div class="search-bar">
                    <input type="text" id="job-search-input" placeholder="Search for your dream job...">
                    <button id="search-button" class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
                <div id="search-count" class="search-stats">0 searches found</div>
            </div>
        </div>
    </div>
    
    <div class="job-listings-container">
        <div class="job-listings-header">
            <h3>Latest Opportunities</h3>
        </div>
        
        <div class="job-listings-grid" id="job-list">
            @foreach ($jobs as $job)
            <div class="job-card" data-title="{{ $job->title }}">
                <div class="card-header">
                    <div class="company-logo">
                        <img src="{{ asset("storage/{$job->logo}") }}" alt="Company Logo">
                        {{-- <img src="{{ asset("storage/company_logos/logo1.png") }}" alt=""> --}}
                    </div>
                    <div class="company-info">
                        <span class="company-name">{{ $job->company_name }}</span>
                        <span class="job-title">{{ $job->title }}</span>
                        <div class="job-meta">
                            <span class="job-type">{{ $job->type }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Job Description</h4>
                    <p>{{ $job->description }}</p>
                </div>
                <div class="card-footer">
                    <button class="apply-btn">Apply Now</button>
                    @if (Auth::user()->hasPermissionTo('delete job listing') || $job->user_id == Auth::user()->id)
                    <form action="{{ route('job.delete', $job->job_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?');" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn"><x-delete-button /></button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    .job-listing-page {
        font-family: 'Inter', sans-serif;
        color: #333;
        background-color: #f8fafc;
        min-height: 100vh;
        width: 100vw;
    }
    
    .search-panel {
        width: 100%;
        padding: 80px 20px;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .search-panel-content {
        max-width: 1200px;
        width: 100%;
        padding: 0 20px;
    }
    
    .greeting-section {
        margin-bottom: 15px;
    }
    
    .greeting-text {
        font-size: 2.2rem;
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        margin: 0;
    }
    
    .user-name {
        color: #60a5fa;
        margin-left: 5px;
    }
    
    .search-title {
        font-size: 1.8rem;
        color: white;
        font-weight: 500;
        margin-bottom: 30px;
    }
    
    .admin-actions {
        margin-bottom: 30px;
    }
    
    .add-job-btn {
        background-color: #3b82f6;
        color: white;
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
    }
    
    .add-job-btn:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .job-search {
        max-width: 700px;
        margin: 0 auto;
    }
    
    .search-bar {
        display: flex;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }
    
    .search-bar input {
        flex: 1;
        padding: 16px 24px;
        border: none;
        outline: none;
        font-size: 1rem;
    }
    
    .search-button {
        background: #3b82f6;
        border: none;
        padding: 0 24px;
        cursor: pointer;
        transition: background 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .search-button:hover {
        background: #2563eb;
    }
    
    .search-button svg {
        width: 20px;
        height: 20px;
        stroke: white;
    }
    
    .search-stats {
        color: #e5e7eb;
        margin-top: 15px;
        font-size: 0.9rem;
    }
    
    .job-listings-container {
        max-width: 1200px;
        margin: -40px auto 60px;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }
    
    .job-listings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .job-listings-header h3 {
        font-size: 1.5rem;
        color: #1e293b;
        font-weight: 600;
    }
    
    .job-listings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
        gap: 25px;
    }
    
    .job-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }
    
    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    
    .job-card.featured {
        border-left: 4px solid #3b82f6;
    }
    
    .featured-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #3b82f6;
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .card-header {
        display: flex;
        padding: 25px;
        padding-bottom: 0;
        align-items: flex-start;
    }
    
    .company-logo {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        margin-right: 20px;
        flex-shrink: 0;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .company-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    
    .company-info {
        flex: 1;
        text-align: left;
    }
    
    .company-name {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
        display: block;
        margin-bottom: 5px;
    }
    
    .job-title {
        font-size: 1.25rem;
        color: #1e293b;
        font-weight: 600;
        display: block;
        margin-bottom: 10px;
    }
    
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 5px;
    }
    
    .job-meta span {
        font-size: 0.85rem;
        color: #64748b;
        background: #f1f5f9;
        padding: 4px 10px;
        border-radius: 50px;
    }
    
    .card-body {
        padding: 20px 25px;
        text-align: left;
    }
    
    .card-body h4 {
        font-size: 1rem;
        color: #1e293b;
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .card-body p {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
        border-top: 1px solid #f1f5f9;
    }
    
    .apply-btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .apply-btn:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }
    
    .delete-form {
        margin-left: auto;
    }
    
    .delete-btn {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
        transition: transform 0.2s ease;
    }
    
    .delete-btn:hover {
        transform: scale(1.1);
    }
    
    @media (max-width: 768px) {
        .job-listings-grid {
            grid-template-columns: 1fr;
        }
        
        .search-panel {
            padding: 60px 20px;
        }
        
        .greeting-text {
            font-size: 1.8rem;
        }
        
        .search-title {
            font-size: 1.4rem;
        }
        
        .card-header {
            flex-direction: column;
        }
        
        .company-logo {
            margin-bottom: 15px;
        }
    }
</style>

<script>
    document.getElementById('job-search-input').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let jobCards = document.querySelectorAll('.job-card');
        let count = 0;
        let searchCount = document.getElementById('search-count');

        searchCount.textContent = '0 searches found';

        jobCards.forEach(function(card) {
            let title = card.getAttribute('data-title').toLowerCase();
            if (title.includes(filter)) {
                card.style.display = '';
                count++;
            } else {
                card.style.display = 'none';
            }
        });

        if (filter === '') {
            searchCount.style.display = 'none';
        } else {
            searchCount.style.display = 'block';
            searchCount.textContent = count + ' searches found';
        }
    });
</script>
@endsection
