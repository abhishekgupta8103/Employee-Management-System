
<div class="card shadow-sm h-100">
    <div class="card-body">
        <h5 class="card-title">{{ $name }}</h5>

        <p class="card-text">{{ $role }}</p>

        <span class="badge {{ $status === 'Active' ? 'bg-success' : 'bg-secondary' }}">
            {{ $status }}
        </span>
    </div>
</div>
