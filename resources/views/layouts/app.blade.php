<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Mon Site Laravel</h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>                
                @if(session('user'))
                    <li><a href="{{ route('reservations.index') }}">Réservations</a></li>
                    <li><a href="{{ route('ouvrages') }}">Ouvrages</a></li>
                    <li><a href="{{ route('auteurs.index') }}">Auteurs</a></li>
                    @if(session('user.role') == 'gestionnaire')
                    <li><a href="{{ route('users.list') }}">Utilisateurs</a></li>
                    @endif
                    <li><a href="{{ route('editeurs.index') }}">Editeurs</a></li>
                    <div>
                    <li class="nav-item">
                        <a href="#" class="nav-link" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Déconnexion
                        </a>
                    </li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                        @csrf
                    </form>
                    @else
                        <li><a href="{{ route('Connexion') }}">Connexion</a></li>
                    @endif
                </div>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @if(session('user'))
            <p> Connecté en tant que {{ session('user')['nom']}} {{ session('user')['prenom']}}</p>
            </br>
        @endif
        
        <p>&copy; 2025 - Mon Site Laravel</p>
    </footer>
</body>
</html>

