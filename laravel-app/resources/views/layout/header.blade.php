<header>
    <nav class="navbar navbar-expand-sm bg-dark">
        <div class="container-fluid">
          <!-- Links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a 
                class="nav-link {{ request()->is('/') ? 'active' : '' }}" 
                href="/">Home
              </a>
            </li>
            <li class="nav-item">
              <a 
              class="nav-link {{ request()->is('about') ? 'active' : '' }}" 
                href="about">
                About
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('pro') }}">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('posts') }}">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact">Contact</a>
            </li>
          </ul>
        </div>      
      </nav>
</header>