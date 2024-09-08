<div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <a href="{{ $href }}">
        <div class="card card-statistic-1">
            <div class="card-icon bg-{{ $color }}">
                <i class="fas fa-{{ $icon }}"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ $label }}</h4>
                </div>
                <div class="card-body">
                    {{ $value }}
                </div>
            </div>
        </div>
    </a>
</div>
