@extends('layouts.app')

@section('title', 'Pathology Tests & Health Checkup Packages in Guwahati - Livocare Labs')
@section('meta_description', 'Explore 14+ pathology test packages and profiles at Livocare Labs Guwahati. Aarogyam packages, CBC, LFT, KFT, Lipid, HbA1c, Thyroid & Vitamin tests.')

@section('content')

<!-- Header Banner -->
<section class="page-header-banner">
    <div class="container">
        <div style="max-width: 750px;">
            <div class="badge-tag badge-primary" style="background: rgba(2, 132, 199, 0.3); color: #7dd3fc; margin-bottom: 12px;">Diagnostic Catalog</div>
            <h1 style="color: #ffffff; font-size: clamp(1.85rem, 5.5vw, 2.75rem); margin-bottom: 12px;">Tests & Health Packages</h1>
            <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.6;">
                Select from comprehensive preventive profiles or targeted organ tests. All packages include free home sample collection in Guwahati and verified digital reports.
            </p>
        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="packages-filter-bar">
    <div class="container">
        <form action="{{ route('packages.index') }}" method="GET" class="filter-bar-form">
            <!-- Category Tabs / Filter Pills -->
            <div class="filter-pills-row">
                @foreach($categories as $key => $label)
                    <a href="{{ route('packages.index', array_merge(request()->query(), ['category' => $key])) }}" 
                       class="badge-tag {{ ($category == $key || (!$category && $key == 'all')) ? 'badge-primary' : 'badge-navy' }}"
                       style="text-decoration: none; padding: 8px 16px; font-size: 0.825rem; white-space: nowrap;">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Search Input & Sort -->
            <div class="search-sort-group">
                <input type="text" name="search" id="livePackageSearch" value="{{ $search }}" class="form-control" placeholder="Search test name (e.g. CBC, Liver, Sugar)..." style="padding: 10px 14px;">
                
                <div style="display: flex; gap: 8px; width: 100%;">
                    <select name="sort" onchange="this.form.submit()" class="form-control" style="flex: 1; min-width: 130px; padding: 10px 14px;">
                        <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Most Popular</option>
                        <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    
                    @if($search || ($category && $category !== 'all'))
                        <a href="{{ route('packages.index') }}" class="btn btn-outline btn-sm" title="Clear filters" style="white-space: nowrap;">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Package Cards Catalog -->
<section class="section-padding">
    <div class="container">
        @if($packages->isEmpty())
            <div class="modern-card" style="text-align: center; padding: 60px 20px; border-radius: var(--radius-xl);">
                <div style="font-size: 3rem; margin-bottom: 16px;">🔍</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 8px;">No packages found</h3>
                <p style="color: var(--text-muted); margin-bottom: 24px;">We couldn't find any test matching your query "{{ $search }}".</p>
                <a href="{{ route('packages.index') }}" class="btn btn-primary">Browse All Packages</a>
            </div>
        @else
            <div class="packages-grid">
                @foreach($packages as $pkg)
                    <div class="package-card package-item-card {{ $pkg->is_featured ? 'featured' : '' }}"
                         data-name="{{ $pkg->name }}"
                         data-desc="{{ $pkg->short_description }}"
                         data-category="{{ $pkg->category }}">
                        <div>
                            <div class="pkg-header">
                                <div>
                                    <span class="badge-tag {{ $pkg->badge === 'Bestseller' ? 'badge-coral' : 'badge-primary' }}" style="font-size: 0.72rem; margin-bottom: 6px;">
                                        {{ $pkg->badge ?? $pkg->category_label }}
                                    </span>
                                    <h3 class="pkg-title">
                                        <a href="{{ route('package.show', $pkg->slug) }}" style="color: inherit;">
                                            {{ $pkg->name }}
                                        </a>
                                    </h3>
                                </div>
                                <span class="pkg-tests-badge">{{ $pkg->test_count }} Tests</span>
                            </div>

                            <p class="pkg-desc">{{ $pkg->short_description }}</p>

                            <div class="pkg-params-box">
                                <div class="pkg-params-title">Includes:</div>
                                <ul class="pkg-params-list">
                                    @if(is_array($pkg->parameters))
                                        @foreach(array_slice($pkg->parameters, 0, 4) as $p)
                                            <li>
                                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                <span>{{ $p }}</span>
                                            </li>
                                        @endforeach
                                        @if(count($pkg->parameters) > 4)
                                            <li style="color: var(--primary); font-weight: 600;">
                                                + {{ count($pkg->parameters) - 4 }} more parameters
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>

                            <div class="pkg-meta-row">
                                <span>🩸 {{ $pkg->sample_type }}</span>
                                <span>⏳ {{ $pkg->fasting_required ? 'Fasting Req.' : 'No Fasting' }}</span>
                                <span>📄 {{ $pkg->report_time }}</span>
                            </div>
                        </div>

                        <div>
                            <div class="pkg-price-row">
                                <span class="price-current">₹{{ number_format($pkg->discounted_price) }}</span>
                                <span class="price-original">₹{{ number_format($pkg->original_price) }}</span>
                                <span class="price-discount-tag">{{ $pkg->discount_percent }}% OFF</span>
                            </div>

                            <div class="pkg-actions">
                                <button type="button" class="btn btn-outline btn-sm" 
                                    data-inspect-package
                                    data-pkg-id="{{ $pkg->id }}"
                                    data-pkg-name="{{ $pkg->name }}"
                                    data-pkg-count="{{ $pkg->test_count }}"
                                    data-pkg-price="{{ number_format($pkg->discounted_price) }}"
                                    data-pkg-params="{{ json_encode($pkg->parameters) }}">
                                    Parameters
                                </button>
                                <a href="{{ route('booking.create', ['package_id' => $pkg->id]) }}" class="btn btn-primary btn-sm">
                                    Book Pickup
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 40px; display: flex; justify-content: center;">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
