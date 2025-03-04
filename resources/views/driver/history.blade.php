<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Historique des Courses | WSSlni</title>
    @vite(['resources/css/app.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Barre de navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-indigo-600">GrandTaxiGo</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/driver/profile" class="text-indigo-600 hover:text-indigo-800 transition">Mon Profil</a>
                        <a href="/driver/courses" class="text-indigo-600 font-medium underline hover:text-indigo-800 transition">Mes Courses</a>
                        <a href="/driver/disponibilite" class="text-indigo-600 hover:text-indigo-800 transition">Disponibilité</a>
                        <a href="/driver/statistiques" class="text-indigo-600 hover:text-indigo-800 transition">Statistiques</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- En-tête de page -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Historique des Courses</h2>
                    <p class="text-gray-600">Consultez toutes vos courses passées et futures</p>
                </div>
            </div>

            <!-- Tableau des réservations -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Passager</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trajet</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date et heure</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(Auth::user()->driver)
                            @foreach(Auth::user()->driver->reservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('/storage/'.$reservation->passenger->photo) }}" alt="Amina Khalid">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $reservation->passenger->fname.' '.$reservation->passenger->lname }}</div>
                                            <div class="text-sm text-gray-500">{{ $reservation->passenger->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 mb-1">{{ $reservation->trajet->startPlace }} → {{ $reservation->trajet->destination }}</div>
                                    <div class="text-xs text-gray-500"><a target="__blink" href="https://www.google.com/maps?q={{ $reservation->trajet->latitude }},{{ $reservation->trajet->longtitude }}">Open Location</a></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ explode(' ', $reservation->created_at)[0] }}</div>
                                    <div class="text-sm text-gray-500">{{ explode(' ', $reservation->created_at)[1] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $reservation->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($reservation->status == 'pending')
                                    <a href="/driver/reservation/accept/{{ $reservation->id }}" class="text-green-600 hover:text-green-900 mr-3">
                                        <i class="fas fa-check-circle"></i> Accepter
                                    </a>
                                    <a href="/driver/reservation/reject/{{ $reservation->id }}" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-times-circle"></i> Refuser
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    @vite(['resources/js/livelocation.js'])
</body>
</html>