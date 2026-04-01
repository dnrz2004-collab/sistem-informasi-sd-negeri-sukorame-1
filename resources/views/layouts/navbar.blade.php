<nav class="navbar">
    <div class="navbar-left">
        <h3>Dashboard</h3>
    </div>

    <div class="navbar-right">
        <span>{{ auth()->user()->name ?? 'User' }}</span>
    </div>
</nav>